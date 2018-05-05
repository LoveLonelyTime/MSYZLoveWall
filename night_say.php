<?php
session_start();
include "setting/database.php";
date_default_timezone_set('Asia/Shanghai');
if(!empty($_GET["date"])){
	$now = $_GET["date"];
}else{
	$now = time();
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<link rel="shortcut icon" href=" /favicon.ico"/>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
		<!-- Baidu -->
		<?php include "template/baidu.html"; ?>
		<!-- Google AD -->
		<?php include "template/google.html"; ?>
		<title>密山一中表白墙 深夜说</title>
	</head>
	<body class="bg-light">
		<?php
			define("INDEX_NIGHT_SAY","INDEX_NIGHT_SAY");
			include "template/header.php";
		?>
		<?php
			$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
			if($connection){
				mysql_set_charset('utf8');
				mysql_select_db(DATABASE_NAME, $connection);
				mysql_query("SET time_zone = '+8:00'");
				$date = date("Y-m-d",$now);
				$result = mysql_query("SELECT * FROM night_say WHERE to_days(date) = to_days('$date')");
		?>
		<nav class="mt-3">
			<ul class="pagination justify-content-center">
				<li class="page-item"><a class="page-link" href="?date=<?php echo $now - 3600*24; ?>">上一天</a></li>
				<li class="page-item disabled"><a class="page-link" href="javascropt:void(0)"><?php echo date("m月d日",$now); ?></a></li>
				<li class="page-item"><a class="page-link" href="?date=<?php echo $now + 3600*24; ?>">下一天</a></li>
			</ul>
		</nav>
		<main class="container">
			<?php
			if(mysql_num_rows($result) == 0){
			?>
			<h1 class="text-center">该日还没有任何内容,你可以为我们投稿</h1>
			<?php
			}else{
				$row = mysql_fetch_array($result);
			?>
			<div class="my-3 p-3 bg-white rounded box-shadow" style="box-shadow:0 .25rem .75rem rgba(0, 0, 0, .05);">
				<div class="border-bottom border-gray pb-2 mb-0">
					<?php echo $row["content"]; ?>
				</div>
				<div class="media-body pb-3 mb-0 small lh-125">
					<?php
					$id = $row["id"];
					$comment_result = mysql_query("SELECT night_say_comment.user_id,night_say_comment.content,user.username,user.header FROM night_say_comment LEFT JOIN user ON user.id = night_say_comment.user_id WHERE night_say_comment.night_say_id = $id");
					while($comment_row = mysql_fetch_array($comment_result)){
					?>
					<div class="mt-1">
						<a href="/user.php?id=<?php echo $comment_row["user_id"]; ?>">
							<img src="<?php echo $comment_row["header"]; ?>" alt="Header" class="rounded-circle" width="30" height="30"/>
							<span><?php echo $comment_row["username"]; ?></span>
						</a>
						<span>：<?php echo $comment_row["content"]; ?></span>
					</div>
					<?php
					}
					?>
				</div>
				<form class="form-row">
					<div class="col">
						<input type="text" class="form-control" id="<?php echo $row["id"]; ?>CommentInput" placeholder="快来评论一番"/>
					</div>
					<div class="col-auto">
						<button type="button" class="btn btn-outline-primary" onclick="doComment(<?php echo $row["id"]; ?>)">评论</button>
					</div>
				</form>
			</div>
			<?php
			}
			?>
		</main>
		<?php
		}
		?>
		<?php
		include "template/footer.html";
		?>
		<div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="resultModalTitle">发布失败</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
					</div>
				</div>
			</div>
		</div>
		<!-- JQuery JavaScript -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<!-- Popper JavaScript -->
		<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<!-- Login JavaScript -->
		<script>
			var login = <?php if(isset($_SESSION["user"])){echo "true";}else{echo "false";} ?>;
		</script>
		<!-- Index JavaScript -->
		<script src="/js/night_say.js"></script>
		<!-- Font Awesome JavaScript -->
		<script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
</html>
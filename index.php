<?php
session_start();
include "setting/database.php";
define("PAGE_SIZE",10);
define("PAGINATION_SIZE",5);

function getUserByID($id){
	return mysql_fetch_array(mysql_query("SELECT * FROM user WHERE id = $id"));
}

function getUserByUsername($username){
	return mysql_fetch_array(mysql_query("SELECT * FROM user WHERE username = '$username'"));
}

function isUserExistByUsername($username){
	return mysql_num_rows(mysql_query("SELECT * FROM user WHERE username = '$username'")) != 0;
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
		<!-- JQuery UI CSS -->
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
		<!-- Simditor CSS -->
		<link rel="stylesheet" href="/css/simditor.css"/>
		<!-- Index CSS -->
		<link rel="stylesheet" href="/css/index.css"/>
		<!-- Baidu -->
		<?php include "template/baidu.html"; ?>
		<title>密山一中表白墙 Love For You</title>
	</head>
	<body class="bg-light">
		<?php
		define("INDEX_LOVE_WALL","INDEX_LOVE_WALL");
		include "template/header.php";
		?>
		<main class="container">
			<div class="my-3 p-3 bg-white rounded box-shadow" id="collapsePublish">
				<button class="btn btn-outline-primary btn-block" type="button" data-toggle="collapse" data-target="#publishForm" aria-expanded="false" aria-controls="publishForm">我要表白</button>
				<form class="collapse" id="publishForm">
					<div class="form-group">
						<label for="objectInput">你要表白的对象：</label>
						<input type="text" id="objectInput" class="form-control" aria-describedby="objectHelp"/>
						<small id="objectHelp" class="form-text text-muted">“@用户名”将自动替换成站内用户，支持通过用户名、真实姓名查找，也可输入其他内容</small>
					</div>
					<div class="form-group">
						<label for="editor">表白内容：</label>
						<textarea id="editor" placeholder="你想说什么？" autofocus></textarea>
					</div>
					<div class="custom-control custom-checkbox mt-3">
						<input type="checkbox" class="custom-control-input" id="anonymousCheck" aria-describedby="anonymousHelp"/>
						<label class="custom-control-label" for="anonymousCheck">匿名</label>
						<small id="anonymousHelp" class="form-text text-muted">匿名之后该条表白不属于你且无法删除</small>
					</div>
					<div class="form-group mt-3">
						<button type="button" class="btn btn-outline-primary btn-block" onclick="doPublish()">一键表白</button>
					</div>
				</form>
			</div>
			<?php
			$page = 1;
			if(!empty($_GET["page"])){
				$page = $_GET["page"];
			}
			$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
			if($connection){
				mysql_set_charset('utf8');
				mysql_select_db(DATABASE_NAME, $connection);
				$result = mysql_query("SELECT * FROM love_note ORDER BY date DESC LIMIT " . ($page-1)*PAGE_SIZE . "," . PAGE_SIZE);
				while($row = mysql_fetch_array($result)){
			?>
			<div class="my-3 p-3 bg-white rounded box-shadow">
				<h6 class="border-bottom border-gray pb-2 mb-0">
					<div class="row">
						<div class="col">
							<?php
							if(!empty($row["user_id"])){
								$user = getUserByID($row["user_id"]);
							?>
							<a href="/user.php?id=<?php echo $user["id"]; ?>">
								<img src="<?php echo $user["header"]; ?>" alt="Header" class="rounded-circle" width="30" height="30"/>
								<span><?php echo $user["username"]; ?></span>
							</a>
							<?php
							}else{
							?>
							<img src="/img/anonymous_header.jpg" alt="Header" class="rounded-circle" width="30" height="30"/>
							<span>匿名用户</span>
							<?php
							}
							?>
							<i class="fas fa-heartbeat text-danger"></i>
							<?php
							if(substr($row["object"], 0, 1) == "@"){
								if(isUserExistByUsername(substr($row["object"],1, strlen($row["object"])-1))){
									$object = getUserByUsername(substr($row["object"],1, strlen($row["object"])-1));
							?>
							<a href="/user.php?id=<?php echo $object["id"]; ?>">
								<img src="<?php echo $object["header"]; ?>" alt="Header" class="rounded-circle" width="30" height="30"/>
								<span><?php echo $object["username"]; ?></span>
							</a>
							<?php
								}else{
							?>
							<span><?php echo $row["object"]; ?></span>
							<?php
								}
							}else{
							?>
							<span><?php echo $row["object"]; ?></span>
							<?php
							}
							?>
						</div>
						<div class="col">
							<div class="text-right text-muted"><?php echo $row["date"]; ?></div>
						</div>
					</div>
				</h6>
				<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
					<?php echo $row["content"]; ?>
				</div>
				<div class="media-body pb-3 mb-0 small lh-125">
					<?php
					$id = $row["id"];
					$comment_result = mysql_query("SELECT love_note_comment.user_id,love_note_comment.content,user.username,user.header FROM love_note_comment LEFT JOIN user ON user.id = love_note_comment.user_id WHERE love_note_comment.love_note_id = $id");
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
			}
			mysql_close($connection);
			?>
		</main>
		<?php
		$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
		if($connection){
			mysql_set_charset('utf8');
			mysql_select_db(DATABASE_NAME, $connection);
			$total_data = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM love_note"))[0];
			$total_page =ceil($total_data/PAGE_SIZE);
			$page_offset=(PAGINATION_SIZE-1)/2;
		?>
		<nav>
			<ul class="pagination justify-content-center">
				<?php
				if($page > 1){
				?>
				<li class="page-item">
					<a class="page-link" href="?page=<?php echo $page - 1; ?>" tabindex="-1">上一页</a>
				</li>
				<?php
				}else{
				?>
				<li class="page-item disabled">
					<a class="page-link" href="javascript:void(0)" tabindex="-1">上一页</a>
				</li>
				<?php
				}
				?>
				<?php
				$start=1;
				$end = $total_page;
				if($total_page > PAGINATION_SIZE) {
					if($page > $page_offset + 1){
					?>
					<li class="page-item disabled"><a class="page-link" href="javascript:void(0)">...</a></li>
					<?php
					}
					if($page > $page_offset){
						$start = $page - $page_offset;
						$end = $total_page > $page + $page_offset ? $page + $page_offset : $total_page;
					}else{
						$start = 1;
						$end = $total_page > PAGINATION_SIZE ? PAGINATION_SIZE : $total_page;
					}
					if($page + $page_offset > $total_page){
						$start = $start - ($page + $page_offset - $end);
					}
				}
				for($i = $start ; $i <= $end ; $i++){
					if($page==$i){ 
				?>
				<li class="page-item disabled"><a class="page-link" href="javascript:void(0)"><?php echo $i; ?></a></li>
				<?php
					}else{  
				?>
				<li class="page-item"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
				<?php
					}
				}
				if($total_page > PAGINATION_SIZE && $total_page > $page + $page_offset){
				?>
				<li class="page-item disabled"><a class="page-link" href="javascript:void(0)">...</a></li>
				<?php
				}
				if($page <$total_page){
				?>
				<li class="page-item">
					<a class="page-link" href="?page=<?php echo $page + 1; ?>">下一页</a>
				</li>
				<?php
				}else{
				?>
				<li class="page-item disabled">
					<a class="page-link" href="javascript:void(0)">下一页</a>
				</li>
				<?php
				}
				?>
			</ul>
		</nav>
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
		<!-- JQuery UI JavaScript -->
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
		<!-- Module JavaScript -->
		<script src="/js/module.js"></script>
		<!-- Hotkeys JavaScript -->
		<script src="/js/hotkeys.js"></script>
		<!-- Uploader JavaScript -->
		<script src="/js/uploader.js"></script>
		<!-- Simditor JavaScript -->
		<script src="/js/simditor.js"></script>
		<!-- Login JavaScript -->
		<script>
			var login = <?php if(isset($_SESSION["user"])){echo "true";}else{echo "false";} ?>;
		</script>
		<!-- Index JavaScript -->
		<script src="/js/index.js"></script>
		<!-- Font Awesome JavaScript -->
		<script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
</html>
<?php
session_start();
include "setting/database.php";
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
		<!-- Simditor CSS -->
		<link rel="stylesheet" href="/css/simditor.css"/>
		<!-- Baidu -->
		<?php include "template/baidu.html"; ?>
		<title>密山一中表白墙 深夜说</title>
	</head>
	<body class="bg-light">
		<?php
			define("INDEX_NIGHT_SAY","INDEX_NIGHT_SAY");
			include "template/header.php";
		?>
		<main class="container">
			<?php
			if(isset($_SESSION["user"])){
				$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
				if($connection){
					mysql_set_charset('utf8');
					mysql_select_db(DATABASE_NAME, $connection);
					$id = $_SESSION["user"];
					$result = mysql_query("SELECT * FROM user WHERE id = $id");
					if(mysql_num_rows($result)!=0){
						$row = mysql_fetch_array($result);
						if($row["admin"] == 1){
							$result = mysql_query("SELECT * FROM night_say WHERE to_days(date) = to_days(now())");
							if(mysql_num_rows($result)!=0){											
			?>
			<h1 class="text-center">今天已发布内容如下</h1>
			<div class="my-3 p-3 bg-white rounded" style="box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);">
			<?php echo mysql_fetch_array($result)["content"]; ?>
			</div>
			<?php
							}else{
			?>
				<h1 class="text-center">发布深夜说</h1>
				<form>
					<textarea id="editor" placeholder="你想说什么？" autofocus></textarea>
					<button type="button" class="btn btn-primary btn-lg btn-block mt-3" onclick="doPublish()">发布</button>
				</form>
			<?php
							}
						}else{
			?>
			<h1 class="text-center">无权访问</h1>
			<?php
						}
					}else{
			?>
			<h1 class="text-center">无权访问</h1>
			<?php
					}
				}
			}else{
			?>
			<h1 class="text-center">无权访问</h1>
			<?php
			}
			?>
		</main>
		<?php
		include "template/footer.html";
		?>
		<!-- JQuery JavaScript -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<!-- Popper JavaScript -->
		<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<!-- Module JavaScript -->
		<script src="/js/module.js"></script>
		<!-- Hotkeys JavaScript -->
		<script src="/js/hotkeys.js"></script>
		<!-- Uploader JavaScript -->
		<script src="/js/uploader.js"></script>
		<!-- Simditor JavaScript -->
		<script src="/js/simditor.js"></script>
		<!--Night Say Edit JavaScript -->
		<script src="/js/night_say_edit.js"></script>
		<!-- Font Awesome JavaScript -->
		<script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
</html>
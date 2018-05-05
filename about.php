<?php
session_start();
include "setting/database.php";
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<link rel="shortcut icon" href=" /favicon.ico"/> 
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
		<!-- Google AD -->
		<?php include "template/google.html"; ?>
		<title>密山一中表白墙 关于我们</title>
	</head>
	<body>
		<?php
		define("INDEX_ABOUT","INDEX_ABOUT");
		include "template/header.php";
		?>
		<div>
			<img style="max-width:100%;overflow:hidden;" src="/img/bg.jpg" alt="Background">
		</div>
		<main class="container">
			<div class="m-3 pt-5">
				<h2>关于我们</h2>
				<p class="text-muted">
				密山一中表白墙（MSYZLoveWall）是年轻人情感文化社区，该网站于2017年12月05日创建，本站的特色是表白墙和深夜说功能。<br/>
				表白墙：主要以各种表白为主<br/>
				深夜说：夜晚情感话题<br/>
				密山一中表白墙开设已经几个月，截止目前，本站的浏览量已超过2000。
				</p>
			</div>
			<hr/>
			<div class="m-3 pt-5">
				<h2>大事记</h2>
				<p class="text-muted">
				2017年<br/>
				2017年12月05日，密山一中表白墙正式成立。<br/>
				2018年<br/>
				2018年2月21日，密山一中表白墙重大更新。
				</p>
			</div>
			<hr/>
			<div class="m-3 pt-5">
				<h2>联系合作</h2>
				<p class="text-muted">
				广告投放：<br/>
				联系QQ：1390751361<br/>
				(谢绝诱导/弹窗类广告)
				</p>
			</div>
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
		<!-- Font Awesome JavaScript -->
		<script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
</html>
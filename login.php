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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
		<!-- Login CSS -->
		<link rel="stylesheet" href="/css/login.css"/>
		<title>密山一中表白墙 用户登录</title>
	</head>
	<body class="bg-light">
		<?php
		include "template/header.php";
		?>
		<main class="text-center mt-5">
			<form class="form-signin">
				<img src="/img/logo.svg" width="70" height="70" alt="Logo"/>
				<h1 class="h3 mb-3 font-weight-normal">登录</h1>
				<span class="text-danger" id="errorText"></span>
				<input type="text" id="usernameInput" class="form-control" placeholder="用户名" autofocus="autofocus"/>
				<input type="password" id="passwordInput" class="form-control" placeholder="密码"/>
				<button class="btn btn-lg btn-outline-primary btn-block" type="button" onclick="doLogin()">登录</button>
				<ul class="list-inline">
					<li class="list-inline-item"><a href="/regist.php">没有帐号？立即注册</a></li>
					<li class="list-inline-item"><a href="#">忘记密码</a></li>
				</ul>
			</form>
		</main>
		<?php
		include "template/footer.php";
		?>
		<!-- JQuery JavaScript -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<!-- Popper JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<!-- Login JavaScript -->
		<script src="/js/login.js"></script>
		<!-- Font Awesome JavaScript -->
		<script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
</html>
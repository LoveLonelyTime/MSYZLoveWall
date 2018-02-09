<!doctype html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
		<style>
		.form-signin {
			width: 100%;
			max-width: 330px;
			padding: 15px;
			margin: 0 auto;
		}
		.form-signin .form-control {
			position: relative;
			box-sizing: border-box;
			height: auto;
			padding: 10px;
			font-size: 16px;
		}
		.form-signin .form-control:focus {
			z-index: 2;
		}
		.form-signin input[type="email"]{
			margin-bottom: -1px;
			border-bottom-right-radius: 0;
			border-bottom-left-radius: 0;
		}
		.form-signin input[type="password"]{
			margin-bottom: 10px;
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		}
		</style>
		<title>密山一中表白墙 用户登录</title>
	</head>
	<body class="bg-light">
		<?php
		include "template/header.php";
		?>
		<main class="text-center mt-5">
			<form class="form-signin">
				<img src="img/logo.png" width="70" height="70" alt="Logo"/>
				<h1 class="h3 mb-3 font-weight-normal">登录</h1>
				<span class="text-danger">错误</span>
				<input type="text" id="usernameInput" class="form-control" placeholder="用户名" autofocus="autofocus"/>
				<input type="password" id="passwordInput" class="form-control" placeholder="密码"/>
				<button class="btn btn-lg btn-outline-primary btn-block" type="button" onclick="doLogin()">登录</button>
			</form>
		</main>
		<?php
		include "template/footer.php";
		?>
		<!-- JQuery JavaScript -->
		<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
		<!-- Popper JavaScript -->
		<script src="https://cdn.bootcss.com/popper.js/1.13.0/popper.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<!-- Login JavaScript -->
		<script src="js/login.js"></script>
		<!-- Font Awesome JavaScript -->
		<script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
</html>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
		<title>密山一中表白墙 用户注册</title>
	</head>
	<body class="bg-light">
		<?php
		include "template/header.php";
		?>
		<main class="container mt-5" style="max-width:50em;">
			<h1>欢迎注册密山一中表白墙</h1>
			<h3 class="text-muted">Love For You</h3>
			<form>
				<h4>创建你的个人账户</h4>
				<div class="form-group">
					<label for="usernameInput">用户名</label>
					<input type="text" class="form-control" id="usernameInput" aria-describedby="usernameHelp" placeholder="请输入你的用户名" autofocus="autofocus"/>
					<small id="usernameHelp" class="form-text text-muted">用户名的长度在0到50位之间，只能由中文、英文、数字和下划线组成，这将成为你唯一的登录凭证，请牢记</small>
				</div>
				<div class="form-group">
					<label for="QQInput">QQ号</label>
					<input type="text" class="form-control" id="QQInput" aria-describedby="QQHelp" placeholder="请输入你的QQ号"/>
					<small id="QQHelp" class="form-text text-muted">这是我们联系你的唯一方式，请务必认真填写</small>
				</div>
				<div class="form-group">
					<label for="passwordInput">密码</label>
					<input type="password" class="form-control" id="passwordInput" aria-describedby="passwordHelp" placeholder="请输入你的密码"/>
					<small id="passwordHelp" class="form-text text-muted">密码的长度在6位到50位之间，只能由数字、英文字母、下划线组成</small>
				</div>
				<div class="form-group">
					<label for="confirmPasswordInput">确认密码</label>
					<input type="password" class="form-control" id="confirmPasswordInput" aria-describedby="confirmPasswordHelp" placeholder="请再输入一遍你的密码"/>
					<small id="confirmPasswordHelp" class="form-text text-muted">确保你的密码输入正确</small>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-outline-primary btn-block btn-lg" onclick="doRegist()">立即注册</button>
				</div>
			</form>
		</main>
		<?php
		include "template/footer.php";
		?>
		<div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="resultModalTitle"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div id="resultModalContent" class="modal-body"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- JQuery JavaScript -->
		<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
		<!-- Popper JavaScript -->
		<script src="https://cdn.bootcss.com/popper.js/1.13.0/popper.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<!-- Regist JavaScript -->
		<script src="js/regist.js"></script>
		<!-- Font Awesome JavaScript -->
		<script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
</html>
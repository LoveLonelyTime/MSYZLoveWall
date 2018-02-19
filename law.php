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
		<!-- Baidu -->
		<?php include "template/baidu.html"; ?>
		<title>密山一中表白墙 法律声明</title>
	</head>
	<body class="bg-light">
		<?php
			include "template/header.php";
		?>
		<main class="container">
			<h1>服务条款</h1>
			<hr/>
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
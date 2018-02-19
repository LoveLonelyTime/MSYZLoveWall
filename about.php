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
		<!-- Index CSS -->
		<link rel="stylesheet" href="/css/index.css"/>
		<!-- Baidu -->
		<?php include "template/baidu.html"; ?>
		<title>密山一中表白墙 关于我们</title>
	</head>
	<body class="bg-light">
		<?php
			define("INDEX_ABOUT","INDEX_ABOUT");
			include "template/header.php";
		?>
		<main class="container">
			
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
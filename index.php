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
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
		<!-- Simditor CSS -->
		<link rel="stylesheet" href="/css/simditor.css"/>
		<!-- Index CSS -->
		<link rel="stylesheet" href="/css/index.css"/>
		<title>密山一中表白墙 Love For You</title>
	</head>
	<body class="bg-light">
		<?php
		define("INDEX_LOVE_WALL","INDEX_LOVE_WALL");
		include "template/header.php";
		?>
		<main class="container">
			<div class="my-3 p-3 bg-white rounded box-shadow">
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="openPublishModal()">打开发布对话框</button>
			</div>
		</main>
		<?php
		include "template/footer.php";
		?>
		<!-- Modal -->
		<div class="modal fade" id="publishModal" tabindex="-1" role="dialog" aria-labelledby="publishModalTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="publishModalTitle">发布表白</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<textarea id="editor" placeholder="Balabala" autofocus></textarea>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
						<button type="button" class="btn btn-primary" onclick="doPublish()">发布</button>
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
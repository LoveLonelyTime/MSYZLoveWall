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
			<?php
			$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
			if($connection){
				mysql_set_charset('utf8');
				mysql_select_db(DATABASE_NAME, $connection);
				$result = mysql_query("SELECT * FROM love_note ORDER BY date");
				while($row = mysql_fetch_array($result)){
			?>
			<div class="my-3 p-3 bg-white rounded box-shadow">
				<h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6>
			</div>
			<?php
				}
			}
			mysql_close($connection);
			?>
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
						<div class="alert alert-danger" role="alert" style="display:none;">
							发布失败
							<button type="button" class="close" onclick="closeAlert()">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form>
							<div class="form-group">
								<label for="objectInput">你要表白的对象：</label>
							</div>
							<textarea id="editor" placeholder="你想说什么？" autofocus></textarea>
							<div class="custom-control custom-checkbox mt-3">
								<input type="checkbox" class="custom-control-input" id="anonymousCheck">
								<label class="custom-control-label" for="anonymousCheck">是否匿名，匿名之后该条表白不属于你且无法删除</label>
							</div>
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
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<!-- Popper JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
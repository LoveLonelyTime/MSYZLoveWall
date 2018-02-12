<?php
session_start();
include "setting/database.php";
function outputUserCenter($id){
	$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
	if($connection){
		mysql_set_charset('utf8');
		mysql_select_db(DATABASE_NAME, $connection);
		$result = mysql_query("SELECT * FROM user WHERE id = $id");
		if(mysql_num_rows($result)!=0){
			$row = mysql_fetch_array($result);
			$username = $row["username"];
			$header = $row["header"];
			$signature = $row["signature"];
			$sex = $row["sex"];
			$QQ = $row["QQ"];
			$grade = $row["grade"];
			$class = $row["class"];
			$real_name = $row["real_name"];
?>
<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
		<div class="col-auto">
		<a href="javascript:showChangeHeaderModal()"><img src=<?php echo $header; ?> alt="Header" class="border" id="headerImage" width="150" height="150" data-toggle="tooltip" data-placement="top" title="点击更换头像"/></a>
		</div>
		<div class="col">
			<h3>
			<?php
			echo $username;
			if($sex == 0){
			?>
			<i class="fas fa-venus-mars text-muted"></i>
			<?php
			}else if($sex == 1){
			?>	
			<i class="fas fa-mars text-primary"></i>
			<?php
			}else if($sex == 2){
			?>	
			<i class="fas fa-venus text-danger"></i>
			<?php
			}
			?>
			</h3>
			<h6 class="text-muted">
			<?php 
			if(!empty($signature)){
				echo $signature;
			}else{
				echo "这个人很懒，什么都没留下";
			}
			?>
			</h6>
		</div>
	</div>
	<ul class="nav nav-tabs mt-3">
		<li class="nav-item">
			<a class="nav-link active" href="javascript:void(0)">个人资料</a>
		</li>
	</ul>
	<div class="border-right border-bottom border-left p-3">
		<div>
			<h6><i class="fas fa-tag text-success"></i> QQ号</h6>
			<span class="pl-3"><?php echo $QQ; ?></span>
		</div>
		<div>
			<h6><i class="fas fa-tag text-success"></i> 年级</h6>
			<span class="pl-3">
			<?php
			if($grade == 0){
			?>
			保密
			<?php
			}else if($grade == 1){
			?>
			高一
			<?php
			}else if($grade == 2){
			?>
			高二
			<?php	
			}else if($grade == 3){
			?>
			高三
			<?php	
			}
			?>
			</span>
		</div>
		<div>
			<h6><i class="fas fa-tag text-success"></i> 班级</h6>
			<span class="pl-3">
			<?php
			if($class == 0){
			?>
			保密
			<?php	
			}else{
				echo $class."班";
			}
			?>
			</span>
		</div>
		<div>
			<h6><i class="fas fa-tag text-success"></i> 真实姓名</h6>
			<span class="pl-3">
			<?php
			if(empty($real_name)){
			?>
			保密
			<?php	
			}else{
				echo $real_name;
			}
			?>
			</span>
		</div>
	</div>
</div>
<?php
		}else{
?>
<h1 class="text-center">没有id为<?php echo $id; ?>的用户</h1>
<?php
		}
	}
	mysql_close($connection);
}
function outputUser($id){
	$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
	if($connection){
		mysql_set_charset('utf8');
		mysql_select_db(DATABASE_NAME, $connection);
		$result = mysql_query("SELECT * FROM user WHERE id = $id");
		if(mysql_num_rows($result)!=0){
			$row = mysql_fetch_array($result);
			$username = $row["username"];
			$header = $row["header"];
			$signature = $row["signature"];
			$sex = $row["sex"];
			$QQ = $row["QQ"];
			$grade = $row["grade"];
			$class = $row["class"];
			$real_name = $row["real_name"];
?>
<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
		<div class="col-auto">
			<img src=<?php echo $header; ?> alt="Header" class="border" id="headerImage" width="150" height="150"/>
		</div>
		<div class="col">
			<h3>
			<?php
			echo $username;
			if($sex == 0){
			?>
			<i class="fas fa-venus-mars text-muted"></i>
			<?php
			}else if($sex == 1){
			?>	
			<i class="fas fa-mars text-primary"></i>
			<?php
			}else if($sex == 2){
			?>	
			<i class="fas fa-venus text-danger"></i>
			<?php
			}
			?>
			</h3>
			<h6 class="text-muted">
			<?php 
			if(!empty($signature)){
				echo $signature;
			}else{
				echo "这个人很懒，什么都没留下";
			}
			?>
			</h6>
		</div>
	</div>
	<ul class="nav nav-tabs mt-3">
		<li class="nav-item">
			<a class="nav-link active" href="javascript:void(0)">个人资料</a>
		</li>
	</ul>
	<div class="border-right border-bottom border-left p-3">
		<div>
			<h6><i class="fas fa-tag text-success"></i> QQ号</h6>
			<span class="pl-3"><?php echo $QQ; ?></span>
		</div>
		<div>
			<h6><i class="fas fa-tag text-success"></i> 年级</h6>
			<span class="pl-3">
			<?php
			if($grade == 0){
			?>
			保密
			<?php
			}else if($grade == 1){
			?>
			高一
			<?php
			}else if($grade == 2){
			?>
			高二
			<?php	
			}else if($grade == 3){
			?>
			高三
			<?php	
			}
			?>
			</span>
		</div>
		<div>
			<h6><i class="fas fa-tag text-success"></i> 班级</h6>
			<span class="pl-3">
			<?php
			if($class == 0){
			?>
			保密
			<?php	
			}else{
				echo $class."班";
			}
			?>
			</span>
		</div>
		<div>
			<h6><i class="fas fa-tag text-success"></i> 真实姓名</h6>
			<span class="pl-3">
			<?php
			if(empty($real_name)){
			?>
			保密
			<?php	
			}else{
				echo $real_name;
			}
			?>
			</span>
		</div>
	</div>
</div>
<?php
		}else{
?>
<h1 class="text-center">没有id为<?php echo $id; ?>的用户</h1>
<?php
		}
	}
	mysql_close($connection);
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
		<!-- User CSS -->
		<link rel="stylesheet" href="/css/user.css"/>
		<title>密山一中表白墙 用户中心</title>
	</head>
	<body class="bg-light">
		<?php
		include "template/header.php";
		?>
		<main class="container">
		<?php
		if(!empty($_GET["id"])){
			if(isset($_SESSION["user"]) && $_SESSION["user"] === $_GET["id"]){
				outputUserCenter($_SESSION["user"]);
			}else{
				outputUser($_GET["id"]);
			}
		}else{
			if(isset($_SESSION["user"])){
				outputUserCenter($_SESSION["user"]);
			}else{
		?>
		<h1 class="text-center">你没有指定用户id</h1>
		<?php
			}
		}
		?>
		</main>
		<?php
		include "template/footer.php";
		?>
		<div class="modal fade" id="changeHeaderModal" tabindex="-1" role="dialog" aria-labelledby="changeHeaderModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="changeHeaderModalTitle">更换头像</h5>
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
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="upload-file"/>
								<label class="custom-file-label" for="upload-file">选择图片</label>
							</div>
						</form>
						<img src="/img/default_image.png" alt="showHeader" width="250" height="250" class="border" style="display:none;" id="showHeaderImg"/>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
						<button type="button" class="btn btn-primary" onclick="doChangeHeader()">更换</button>
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
		<!-- Uploader JavaScript -->
		<script src="/js/uploader.js"></script>
		<!-- User JavaScript -->
		<script src="/js/user.js"></script>
		<!-- Font Awesome JavaScript -->
		<script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
</html>
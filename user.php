<?php
session_start();
function outputUserCenter($id){
	
}
function outputUser($id){
	$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
	if($connection){
		mysql_set_charset('utf8');
		mysql_select_db("msyzlovewall", $connection);
		$result = mysql_query("SELECT username,header FROM user WHERE id = $id");
		if(mysql_num_rows($result)!=0){
			$row = mysql_fetch_array($result);
			$username = $row["username"];
			$header = $row["header"];
?>
<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
		<div class="col-auto">
			<img src=<?php echo $header; ?> alt="Header" class="border" id="headerImage" width="150" height="150"/>
		</div>
		<div class="col">
			<h3><?php echo $username; ?></h3>
			<h6 class="text-muted">
			<?php 
			if(array_key_exists("signature",$row)){
				echo $row["signature"];
			}else{
				echo "这个人很懒，什么都没留下";
			}
			?>
			</h6>
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
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
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
		<!-- JQuery JavaScript -->
		<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
		<!-- Popper JavaScript -->
		<script src="https://cdn.bootcss.com/popper.js/1.13.0/popper.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<!-- Font Awesome JavaScript -->
		<script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
</html>
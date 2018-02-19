<?php
session_start();
include "../setting/database.php";
header('Content-Type:application/json');
if(isset($_SESSION["user"])){
	$content = $_POST["content"];
	$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
	if($connection){
		mysql_set_charset('utf8');
		mysql_select_db(DATABASE_NAME, $connection);
		$id = $_SESSION["user"];
		$result = mysql_query("SELECT * FROM user WHERE id = $id");
		if(mysql_num_rows($result)!=0){
			$row = mysql_fetch_array($result);
			if($row["admin"] == 1){
				if(!empty($content)){
					mysql_query("INSERT INTO night_say (content,date) VALUES ('$content',now())");
					echo json_encode(array("result" => "success"));
				}else{
					echo json_encode(array("result" => "error","description" => "内容为空"));
				}
			}else{
				echo json_encode(array("result" => "error","description" => "没有限权"));
			}
		}else{
			echo json_encode(array("result" => "error","description" => "没有限权"));
		}
	}else{
		echo json_encode(array("result" => "error","description" => "未登录"));
	}
}else{
	echo json_encode(array("result" => "error","description" => "未登录"));
}
?>
<?php
session_start();
include "../setting/database.php";
header('Content-Type:application/json');
if(isset($_SESSION["user"])){
	$html = $_POST["html"];
	$anonymous = $_POST["anonymous"];
	if(!empty($html)){
		$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
		if($connection){
			mysql_set_charset('utf8');
			mysql_select_db(DATABASE_NAME, $connection);
			if((!empty($anonymous)) && $anonymous == "true"){
				mysql_query("INSERT INTO love_note (content) VALUES ('$html')");
			}else{
				$id = $_SESSION["user"];
				mysql_query("INSERT INTO love_note (content,user_id) VALUES ('$html',$id)");
			}
			echo json_encode(array("result" => "success"));
		}else{
			echo json_encode(array("result" => "error","description" => "数据库连接失败"));
		}
		mysql_close($connection);
	}else{
		echo json_encode(array("result" => "error","description" => "内容为空"));
	}
}else{
	echo json_encode(array("result" => "error","description" => "未登录"));
}
?>
<?php
session_start();
include "../setting/database.php";
header('Content-Type:application/json');
if(isset($_SESSION["user"])){
	$content = $_POST["content"];
	$night_say_id = $_POST["night_say_id"];
	if((!empty($content)) && (!empty($night_say_id))){
		$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
		if($connection){
			mysql_set_charset('utf8');
			mysql_select_db(DATABASE_NAME, $connection);
			mysql_query("SET time_zone = '+8:00'");
			$id = $_SESSION["user"];
			mysql_query("INSERT INTO night_say_comment (content,user_id,night_say_id) VALUES ('$content',$id,'$night_say_id')");
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
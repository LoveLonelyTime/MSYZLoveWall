<?php
session_start();
include "../setting/database.php";
header('Content-Type:application/json');
function validateUsername($value){
	if(strlen($value) > 0 && strlen($value) <50){
		if(preg_match("/^[\x{4E00}-\x{9FA5}A-Za-z0-9_]+$/u",$value)){
			return true;
		}else{
			echo json_encode(array("result" => "input_error","field" => "username","description" => "用户名只能由中文、英文、数字和下划线组成"));
			return false;
		}
	}else{
		echo json_encode(array("result" => "input_error","field" => "username","description" => "用户名的长度应在0到50位之间"));
		return false;
	}
}
function validatePassword($value){
	if(strlen($value) > 6 && strlen($value) <50){
		if(preg_match("/^\w+$/",$value)){
			return true;
		}else{
			echo json_encode(array("result" => "input_error","field" => "password","description" => "密码只能由数字、英文字母、下划线组成"));
			return false;
		}
	}else{
		echo json_encode(array("result" => "input_error","field" => "password","description" => "密码的长度应在6到50位之间"));
		return false;
	}
}
$username = $_POST["username"];
$password = $_POST["password"];

if(validateUsername($username) && validatePassword($password)){
	$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
	if($connection){
		mysql_set_charset('utf8');
		mysql_select_db("msyzlovewall", $connection);
		$md5_password = md5($password);
		$result = mysql_query("SELECT id,password FROM user WHERE username = '$username'");
		$row = mysql_fetch_array($result);
		if($row["password"] === $md5_password){
			$_SESSION["user"] = $row["id"];
			echo json_encode(array("result" => "success"));
		}else{
			echo json_encode(array("result" => "error","description" => "该用户不存在或密码错误"));
		}
	}else{
		echo json_encode(array("result" => "error","description" => "数据库连接失败"));
	}
	mysql_close($connection);
}
?>
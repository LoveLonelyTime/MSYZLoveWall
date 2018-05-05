<?php
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
function validateQQ($value){
	if(preg_match("/^[1-9]\d{4,10}$/",$value)){
		return true;
	}else{
		echo json_encode(array("result" => "input_error","field" => "QQ","description" => "你输入的QQ不合格格式"));
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
function checkUsernameUnique($value){
	$result = mysql_query("SELECT * FROM user WHERE username = '$value'");
	if(mysql_num_rows($result)==0){
		return true;
	}else{
		return false;
	}
}
$username = $_POST["username"];
$password = $_POST["password"];
$QQ = $_POST["QQ"];
if(validateUsername($username) && validateQQ($QQ) && validatePassword($password)){
	$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
	if($connection){
		mysql_set_charset('utf8');
		mysql_select_db(DATABASE_NAME, $connection);
		mysql_query("SET time_zone = '+8:00'");
		if(checkUsernameUnique($username)){
			$md5_password = md5($password);
			if(mysql_query("INSERT INTO user (username,password,QQ) VALUES ('$username','$md5_password', '$QQ')")){
				echo json_encode(array("result" => "success"));
			}else{
				echo json_encode(array("result" => "error","description" => "数据库连接失败"));
			}
		}else{
			echo json_encode(array("result" => "input_error","field" => "username","description" => "该用户名已被注册"));
		}
	}else{
		echo json_encode(array("result" => "error","description" => "数据库连接失败"));
	}
	mysql_close($connection);
}
?>
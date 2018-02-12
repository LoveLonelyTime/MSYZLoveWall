<?php
session_start();
include "../setting/database.php";
header('Content-Type:application/json');

function validateQQ($value){
	if(preg_match("/^[1-9]\d{4,10}$/",$value)){
		return true;
	}else{
		echo json_encode(array("result" => "input_error","field" => "QQ","description" => "你输入的QQ不合格格式"));
		return false;
	}
}

function validateGrade($value){
	if(preg_match("/^[1-9]\d{4,10}$/",$value)){
		return true;
	}else{
		echo json_encode(array("result" => "input_error","field" => "grade","description" => "年级不符合格式"));
		return false;
	}
}

function validateGrade($value){
	if(preg_match("/^[1-9]\d{4,10}$/",$value)){
		return true;
	}else{
		echo json_encode(array("result" => "input_error","field" => "grade","description" => "班级不符合格式"));
		return false;
	}
}

if(isset($_SESSION["user"])){
	$category = $_POST["category"];
	$newInformation = $_POST["newInformation"];
	$id = $_SESSION["user"];
	if((!empty($category)) && (!empty($newInformation))){
		$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
		if($connection){
			mysql_set_charset('utf8');
			mysql_select_db(DATABASE_NAME, $connection);
			if($category == "header"){
				mysql_query("UPDATE user SET header = '$newInformation' WHERE id = $id");
				echo json_encode(array("result" => "success"));
			}else if($category == "QQ"){
				if(validateQQ($newInformation)){
					mysql_query("UPDATE user SET QQ = '$newInformation' WHERE id = $id");
					echo json_encode(array("result" => "success"));
				}
			}else if($category == "grade"){
				
			}else if($category == "class"){
				
			}else if($category == "real_name"){
				
			}
		}else{
			echo json_encode(array("result" => "error","description" => "数据库连接失败"));
		}
		mysql_close($connection);
	}else{
		echo json_encode(array("result" => "error","description" => "信息为空"));
	}
}else{
	echo json_encode(array("result" => "error","description" => "未登录"));
}
?>
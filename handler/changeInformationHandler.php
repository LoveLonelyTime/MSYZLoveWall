<?php
session_start();
include "../setting/database.php";
header('Content-Type:application/json');

function validateQQ($value){
	if(preg_match("/^[1-9]\d{4,10}$/",$value)){
		return true;
	}else{
		echo json_encode(array("result" => "input_error","field" => "QQ","description" => "QQ不合格格式"));
		return false;
	}
}

function validateGrade($value){
	if($value >= 0 && $value <= 3){
		return true;
	}else{
		echo json_encode(array("result" => "input_error","field" => "grade","description" => "年级不符合格式"));
		return false;
	}
}

function validateClass($value){
	if($value >= 0 && $value <= 20){
		return true;
	}else{
		echo json_encode(array("result" => "input_error","field" => "class","description" => "班级不符合格式"));
		return false;
	}
}

function validateSex($value){
	if($value >= 0 && $value <= 2){
		return true;
	}else{
		echo json_encode(array("result" => "input_error","field" => "sex","description" => "性别不符合格式"));
		return false;
	}
}

if(isset($_SESSION["user"])){
	$category = $_POST["category"];
	$newInformation = $_POST["newInformation"];
	$id = $_SESSION["user"];
	if(!empty($category)){
		$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
		if($connection){
			mysql_set_charset('utf8');
			mysql_select_db(DATABASE_NAME, $connection);
			mysql_query("SET time_zone = '+8:00'");
			if($category == "header"){
				if(!empty($newInformation)){
					mysql_query("UPDATE user SET header = '$newInformation' WHERE id = $id");
					echo json_encode(array("result" => "success"));
				}else{
					echo json_encode(array("result" => "input_error","field" => "header","description" => "头像地址为空"));
				}
			}else if($category == "QQ"){
				if(validateQQ($newInformation)){
					mysql_query("UPDATE user SET QQ = '$newInformation' WHERE id = $id");
					echo json_encode(array("result" => "success"));
				}
			}else if($category == "grade"){
				if(validateGrade($newInformation)){
					mysql_query("UPDATE user SET grade = $newInformation WHERE id = $id");
					echo json_encode(array("result" => "success"));
				}
			}else if($category == "class"){
				if(validateClass($newInformation)){
					mysql_query("UPDATE user SET class = $newInformation WHERE id = $id");
					echo json_encode(array("result" => "success"));
				}
			}else if($category == "real_name"){
				if(!empty($newInformation)){
					mysql_query("UPDATE user SET real_name = '$newInformation' WHERE id = $id");
					echo json_encode(array("result" => "success"));
				}else{
					mysql_query("UPDATE user SET real_name = NULL WHERE id = $id");
					echo json_encode(array("result" => "success"));
				}
			}else if($category == "sex"){
				if(validateSex($newInformation)){
					mysql_query("UPDATE user SET sex = $newInformation WHERE id = $id");
					echo json_encode(array("result" => "success"));
				}
			}else if($category == "signature"){
				if(!empty($newInformation)){
					mysql_query("UPDATE user SET signature = '$newInformation' WHERE id = $id");
					echo json_encode(array("result" => "success"));
				}else{
					mysql_query("UPDATE user SET signature = NULL WHERE id = $id");
					echo json_encode(array("result" => "success"));
				}
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
<?php
session_start();
header('Content-Type:application/json');
if(isset($_SESSION["user"])){
	if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg")) || ($_FILES["file"]["type"] == "image/png") && ($_FILES["file"]["size"] < 100000)){
		if ($_FILES["file"]["error"] > 0){
			echo json_encode(array("success" => "false","msg" => "图片错误"));
		}else{
			if(file_exists("../uimg/" . $_FILES["file"]["name"])){
				echo json_encode(array("success" => "true","file_path" => "/uimg/" . $_FILES["file"]["name"]));
			}else{
				move_uploaded_file($_FILES["file"]["tmp_name"],"../uimg/" . $_FILES["file"]["name"]);
				echo json_encode(array("success" => "true","file_path" => "/uimg/" . $_FILES["file"]["name"]));
			}
		}
	}else{
		echo json_encode(array("success" => "false","msg" => "非法的图片，或图片大小超过100KB"));
	}
}else{
	echo json_encode(array("success" => "false","msg" => "未登录"));
}
?>
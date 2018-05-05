<?php
include "../setting/database.php";
header('Content-Type:application/json');
$term = $_GET["term"];
if(!empty($term)){
	$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
	if($connection){
		mysql_set_charset('utf8');
		mysql_select_db(DATABASE_NAME, $connection);
		mysql_query("SET time_zone = '+8:00'");
		$result = mysql_query("SELECT username,header,signature,real_name FROM user WHERE username LIKE '%$term%' OR real_name LIKE '%$term%'");
		$array = array();
		while($row = mysql_fetch_array($result)){
			array_push($array,array("username" => $row["username"],"header" => $row["header"],"signature" => empty($row["signature"])?"这个人很懒，什么都没留下":$row["signature"],"real_name" => empty($row["real_name"])?"保密":$row["real_name"]));
		}
		echo json_encode($array);
	}
}
?>
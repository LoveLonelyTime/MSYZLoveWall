<?php
include "../setting/database.php";
header('Content-Type:application/json');
$term = $_GET["term"];
if(!empty($term)){
	$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
	if($connection){
		mysql_set_charset('utf8');
		mysql_select_db(DATABASE_NAME, $connection);
		$result = mysql_query("SELECT username,header,signature FROM user WHERE username LIKE '%$term%'");
		$array = array();
		while($row = mysql_fetch_array($result)){
			array_push($array,array("username" => $row["username"],"header" => $row["header"],"signature" => $row["signature"]));
		}
		echo json_encode($array);
	}
}
?>
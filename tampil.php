<?php
include "db_connection.php"; 

$user=$_GET['u'];  // username yang gambarnya mo ditampilkan

$query = "SELECT PHOTO FROM user_detail as ud JOIN user as u ON ud.user_id = u.guid WHERE username = '$user'";
$data = mysql_query($query);
$data = mysql_fetch_array($data);
if($data){
	$content = $data[0];
	header('Content-Type: image/png');
	echo $content;
}else{
	$content = "";
	echo $content;
}
?>
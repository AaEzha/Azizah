<?php
include "db_connection.php"; 

$user=$_GET['u'];  // username yang gambarnya mo ditampilkan

$email = ambildata($user,'user_detail','EMAIL');

$query = "SELECT PHOTO,MIME_PHOTO FROM user_detail as ud JOIN user as u ON ud.user_id = u.guid WHERE email = '$email'";
$data = mysql_query($query);
$data = mysql_fetch_array($data);
if($data){
	$content = $data[0];
	header("Content-Type: ".$data[1]);
	echo $content;
}else{
	$content = "";
	echo $content;
}
?>
<?php session_start(); include 'db_connection.php';

if(isset($_GET['L']) and isset($_GET['D'])){
	$email = $_GET['L'];
	$iduser = $_GET['D'];

	$q = mysql_query("select * from user_detail where EMAIL='$email' and USER_ID='$iduser'");
	$c = mysql_num_rows($q);
	if($c==1){
		mysql_query("update user set VERIFIED='1' where GUID='$iduser'");
		eksyen('You are now authorized to login','index.php');
	}else{
		eksyen('Sorry, you are not authorized','index.php');
	}
}else{
	eksyen('Sorry, you are not authorized','index.php');
}
?>
<?php
	session_start();
	include("db_connection.php");
	$username = $_SESSION['username'];
	mysql_query("update user set ISLOGIN='0', LASTLOGIN=now() where username='$username'");
	session_destroy();
	header("location:index.php");
?>
<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "internship";
$con = mysql_connect($host, $username, $password) or die ("Failed");
mysql_select_db($database) or die ("Database not exist");
include 'fungsi.php';
?>
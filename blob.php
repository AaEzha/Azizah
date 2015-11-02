<?php
include "db_connection.php"; 
$id = $_GET['i'];
$mime = $_GET['mime'];
$file = $_GET['file'];
$q = mysql_query("select * from internship_registration ir
				  join user_detail ud
				  on ud.GUID=ir.USER_DETAIL_ID
				  where ir.GUID='$id'");
$d = mysql_fetch_array($q);
header("Content-Type:" . $d[$mime]);
echo $d[$file];
?>
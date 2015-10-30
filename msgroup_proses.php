<?php
include("db_connection.php");

$username = mysql_real_escape_string($_POST['username']);
$group_name = mysql_real_escape_string($_POST['group_name']);

echo "Username: ".$username."<br/>";
echo "Group : ".$group_name;

$query_username_guid = mysql_query("SELECT u.USERNAME, ud.GUID FROM user as u JOIN user_detail as ud ON u.guid = ud.user_id WHERE USERNAME = '$username'");
while($row = mysql_fetch_array($query_username_guid)){
	$user_id=$row['GUID'];
}

$query_group_guid = mysql_query("SELECT GUID FROM ms_group WHERE GROUP_NAME = '$group_name'");
while($row = mysql_fetch_array($query_group_guid)){
	$msgroup_guid=$row['GUID'];
}

$query_insert_member_of_group = mysql_query("INSERT INTO `member_of_group`
	(`GUID`, `MS_GROUP_ID`, `USER_DETAIL_ID`, `DTMCRT`, `USRCRT`, `DTMUPD`, `USRUPD`) 
	VALUES (uuid(),'$msgroup_guid','$user_id',CURRENT_DATE,'admin',CURRENT_DATE,'admin')");

if(!$query_insert_member_of_group){
	echo die("Error inserting record".mysql_error());
}
else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Success inserting record');
	window.location.href='msgroup.php'; 
		</SCRIPT>");
}

?>
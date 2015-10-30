<?php include("db_connection.php"); 
if(!isset($_POST['yourname'])){
	eksyen('','index.php');
}else{
	$yourname = mysql_real_escape_string($_POST['yourname']);
	$youremail = mysql_real_escape_string($_POST['youremail']);
	$yourcomment = mysql_real_escape_string($_POST['yourcomment']);

	$q = mysql_query("insert into guestbook(GUID,FIRSTNAME,EMAIL,COMMENT) values(uuid(),'$yourname','$youremail','$yourcomment')");
	if ($q) {
		eksyen('Success!','index.php');
	} else {
		eksyen('Error!','index.php');
	}
	
}
?>
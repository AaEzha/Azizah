<!doctype html>
<html>
<?php
include("db_connection.php");
session_start();

    


if(isset($_POST['name'])){
    $name = mysql_real_escape_string($_POST['name']);
    $email = mysql_real_escape_string($_POST['email']);
    $comment = mysql_real_escape_string($_POST['comment']);
    $q = mysql_query("insert into guestbook(guid,firstname,email,comment,dtmcrt,usrcrt) values(uuid(),'$name','$email','$comment',now(),'$name')");
    if($q){
        echo "<script>alert('Thank you. We will shortly contact you back');</script><meta http-equiv='refresh' content='0;index.php'>";
    }else{
        echo "<script>alert('Error. We will shortly fix this');</script><meta http-equiv='refresh' content='0;index.php'>";
    }
}
	
if(isset($_POST['btn_cmd_Reset'])){
    header("location:index.php");
}

?>
</html>
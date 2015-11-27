<?php session_start();
include 'db_connection.php';
$idprojek = $_GET['projek'];

$qqget = mysql_query("SELECT * FROM program WHERE GUID='$idprojek'");
$dqget = mysql_fetch_array($qqget);

echo "<a href='?p=detail&i=".$dqget['GUID']."' class='btn btn-primary btn-sm' target='_blank'>Detail</a>";
?>
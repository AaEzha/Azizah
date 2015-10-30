<?php session_start();
include 'db_connection.php';
$idtopik = $_GET['topik'];

$tgl = date('d');
if ($tgl>="1" and $tgl<="7") {
	$qw = "WEEK1";
	$week = "1";
} elseif ($tgl>="8" and $tgl<="14") {
	$qw = "WEEK2";
	$week = "2";
} elseif ($tgl>="15" and $tgl<="21") {
	$qw = "WEEK3";
	$week = "3";
} elseif ($tgl>="22" and $tgl<="28") {
	$qw = "WEEK4";
	$week = "4";
} elseif ($tgl>="29" and $tgl<="31") {
	$qw = "WEEK5";
	$week = "5";
}

$qqget = mysql_query("SELECT * FROM quota WHERE TOPIC_ID='$idtopik' and YEAR='".date('Y')."' and MONTH='".date('m')."'");
$dqget = mysql_fetch_array($qqget);
$data = "WEEK".$week;

echo $dqget[$data]?$dqget[$data]:0;
?>
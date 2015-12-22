<?php
	session_start();
	include("db_connection.php");

	$n = $_POST['jum'];
	$bulan = $_POST['bulan'];
	$tahun = $_POST['tahun'];

	echo "<h1>Processing data...</h1>";

	for($i=1; $i<=$n; $i++){
		$uid = $_POST['userid'.$i];
		$w1 = $_POST['w1'.$i];
		$w2 = $_POST['w2'.$i];
		$w3 = $_POST['w3'.$i];
		$w4 = $_POST['w4'.$i];
		$w5 = $_POST['w5'.$i];

		$q = mysql_query("update quota set WEEK1='$w1', WEEK2='$w2', WEEK3='$w3', WEEK4='$w4', WEEK5='$w5' where USER_DETAIL_ID='$uid' and MONTH='$bulan' and YEAR='$tahun'");

		if($q){
			echo "Data $i succeeded<br>";
		}else{
			echo "Data $i failed<br>";
		}
	}

	eksyen('','home.php?p=quota');
?>
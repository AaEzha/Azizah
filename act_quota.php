<?php
$today = date('Y-m-d');
$tgl = date('d');
$bln = date('m');
$thn = date('Y');
echo "<p>$today</p>";

if ($tgl>="1" and $tgl<="7") {
	$week = "1";
} elseif ($tgl>="8" and $tgl<="14") {
	$week = "2";
} elseif ($tgl>="15" and $tgl<="21") {
	$week = "3";
} elseif ($tgl>="22" and $tgl<="28") {
	$week = "4";
} elseif ($tgl>="29" and $tgl<="31") {
	$week = "5";
}
echo $week;
?>
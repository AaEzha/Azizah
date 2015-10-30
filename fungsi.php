<?php
date_default_timezone_set("Asia/Jakarta");
function sesi($grup){
	if($_SESSION['grup'] != $grup){
		echo '<script>window.location.assign("inside.php");</script>';
	}
}

function cekbok($a,$b){
	if($a==$b){
		return "checked";
	}
}

function tabel(){
	echo "\n<script>$(document).ready(function(){ $('#tbl,#tbl2,#tbl3').dataTable();});</script>";
}

function yakin(){
	echo "onClick=\"return confirm('Apakah Anda yakin akan melakukan aksi ini?');\" ";
}

function eksyen($teks=false,$tujuan){ // buat pindah halaman
	if($teks){
		die("<script>alert('$teks');</script>
	     <meta http-equiv='refresh' content='0;$tujuan'>");
	}else{
		die("<meta http-equiv='refresh' content='0;$tujuan'>");
	}
}

function getdata($tabel,$dimana,$kolom){
	$a = mysql_query("select * from $tabel where $dimana");
	$b = mysql_fetch_array($a);
	return $b[$kolom];
}

function ambildata($guid,$tabel,$kolom,$where=null){
	if($where==null){
		$a = mysql_query("select * from $tabel where GUID='$guid'");
	}else{
		$a = mysql_query("select * from $tabel where $where");
	}
	$b = mysql_fetch_array($a);
	return $b[$kolom];
}

function data_user($guid,$kolom){
	$a = mysql_query("select * from user where GUID='$guid'");
	$b = mysql_fetch_array($a);
	return $b[$kolom];
}


function data_user_detail($guid,$kolom){
	$a = mysql_query("select * from user_detail where GUID='$guid'");
	$b = mysql_fetch_array($a);
	return $b[$kolom];
}

function data_user_detail_user($guid,$kolom){
	$a = mysql_query("select * from user_detail where USER_ID='$guid'");
	$b = mysql_fetch_array($a);
	return $b[$kolom];
}

function data_mog_user_detail($guid,$kolom){
	$a = mysql_query("select * from member_of_group where USER_DETAIL_ID='$guid'");
	$b = mysql_fetch_array($a);
	return $b[$kolom];
}

function data_group_name($guid,$kolom){
	$a = mysql_query("select * from ms_group where GUID='$guid'");
	$b = mysql_fetch_array($a);
	return $b[$kolom];
}

function group_name($uid,$kolom){
	$iduser = data_user($uid,'GUID');
	$iduserdetail = data_user_detail_user($iduser,'GUID');
	$idmog = data_mog_user_detail($iduserdetail,'MS_GROUP_ID');
	$grup = data_group_name($idmog,'GROUP_NAME');
	return $grup;
}
?>
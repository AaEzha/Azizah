<?php
date_default_timezone_set("Asia/Jakarta");

define("URL","http://www.teknomatika.org/intra-gmf"); // tanpa garis miring dibelakang

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

function bulandariangka($bln){
	switch ($bln) {
		case '01':
			$a = "January";
			break;
		case '02':
			$a = "February";
			break;
		case '03':
			$a = "March";
			break;
		case '04':
			$a = "April";
			break;
		case '05':
			$a = "May";
			break;
		case '06':
			$a = "June";
			break;
		case '07':
			$a = "July";
			break;
		case '08':
			$a = "August";
			break;
		case '09':
			$a = "September";
			break;
		case '10':
			$a = "October";
			break;
		case '11':
			$a = "November";
			break;
		case '12':
			$a = "December";
			break;
		
		default:
			$a = "";
			break;
	}

	return $a;
}

function konvert($tabel,$id,$kolom){
	$q = mysql_query("select $kolom from $tabel where GUID='$id'");
	$d = mysql_fetch_array($q);
	return $d[$kolom];
}

function konvert2($tabel,$key,$val,$kolom){
	$q = mysql_query("select $kolom from $tabel where $key='$val'");
	$d = mysql_fetch_array($q);
	return $d[$kolom];
}

function tabel(){
	echo "\n<script>$(document).ready(function(){ $('#tbl,#tbl2,#tbl3').dataTable();});</script>";
}

function angka(){
	echo 'onkeypress="return isNumber(event)"';
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

function time_ago( $date )
{
    if( empty( $date ) )
    {
        return "No date provided";
    }

    $periods = array("detik", "menit", "jam", "hari", "minggu", "bulan", "tahun", "dekade");

    $lengths = array("60","60","24","7","4.35","12","10");

    $now = time();

    $unix_date = strtotime( $date );

    // check validity of date

    if( empty( $unix_date ) )
    {
        return "Bad date";
    }

    // is it future date or past date

    if( $now > $unix_date )
    {
        $difference = $now - $unix_date;
        $tense = "yang lalu";
    }
    else
    {
        $difference = $unix_date - $now;
        $tense = "dari sekarang";
    }

    for( $j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++ )
    {
        $difference /= $lengths[$j];
    }

    $difference = round( $difference );

    if( $difference != 1 )
    {
        //$periods[$j].= "s";
        $periods[$j].= "";
    }

    return "$difference $periods[$j] {$tense}";
}

function findweek($tgl,$op){
	if($tgl>=1 and $tgl<=7){
		$a = "WEEK1";
		$b = "1";
		$c = "WEEK2";
		$d = "";
	}elseif($tgl>=8 and $tgl<=14){
		$a = "WEEK2";
		$b = "2";
		$c = "WEEK3";
		$d = "WEEK1";
	}elseif($tgl>=15 and $tgl<=21){
		$a = "WEEK3";
		$b = "3";
		$c = "WEEK4";
		$d = "WEEK2";
	}elseif($tgl>=22 and $tgl<=28){
		$a = "WEEK4";
		$b = "4";
		if(date('m')==02){
			if(checkdate(date('m'), $tgl+1, date('Y'))){
				$c = "WEEK5";
			}else{
				$c = "WEEK1";
			}
		}else{
			$c = "WEEK5";
		}
		$d = "WEEK3";
	}elseif($tgl>=29 and $tgl<=31){
		$a = "WEEK5";
		$b = "5";
		$c = "WEEK1";
		$d = "WEEK4";
	}
	switch ($op) {
		case 'long':
			return $a;
			break;
		case 'short':
			return $b;
			break;
		case 'sesudah':
			return $c;
			break;
		case 'sebelum':
			return $d;
			break;
	}
}

function cekquota($idtopik){
	$tgl = date('d');
	$bln = date('m');
	$thn = date('Y');

	$qck = mysql_query("select * from quota where TOPIC_ID='$idtopik' and YEAR='$thn'");
	$jck = mysql_num_rows($qck);
	// jika berganti tahun
	if($jck<1){
		$qta = mysql_query("select WEEK5 from quota where TOPIC_ID='$idtopik' and YEAR='$thn' and MONTH='12'");
		$dta = mysql_fetch_array($qta);
		$dweek5 = $dta['WEEK5'];
		mysql_query("insert into quota(GUID,TOPIC_ID,YEAR,MONTH,WEEK1,DTMCRT,USRCRT) values(uuid(),'$idtopik','$thn'+1,'01','$dweek5',now(),'$_SESSION[username]')");
		echo "<script>alert('Quota update tahunan')</script>";
	}else{
		$qcb = mysql_query("select * from quota where TOPIC_ID='$idtopik' and YEAR='$thn' and MONTH='$bln'");
		$jcb = mysql_num_rows($qcb);
		// jika berganti bulan
		if($jcb<1){
			$qba = mysql_query("select WEEK5 from quota where TOPIC_ID='$idtopik' and YEAR='$thn' and MONTH='$bln'");
			$dba = mysql_fetch_array($qba);
			$dweek5 = $dba['WEEK5'];
			mysql_query("insert into quota(GUID,TOPIC_ID,YEAR,MONTH,WEEK1,DTMCRT,USRCRT) values(uuid(),'$idtopik','$thn','$bln'+1,'$dweek5',now(),'$_SESSION[username]')");
			echo "<script>alert('Quota update bulanan')</script>";
		}else{
			$minggu = findweek($tgl,"long");
			$wik = findweek($tgl,"sebelum"); // minggu sebelumnya
			$qcw = mysql_query("select $minggu as minggunya, $wik as minggunya2 from quota where TOPIC_ID='$idtopik' and YEAR='$thn' and MONTH='$bln'");
			$dcw = mysql_fetch_array($qcw);
			// jika berganti minggu
			if($dcw['minggunya'] == NULL){
				$datanya = $dcw['minggunya2'];
				mysql_query("update quota set $minggu='$datanya' where TOPIC_ID='$idtopik' and YEAR='$thn' and MONTH='$bln'");
				echo "<script>alert('Quota update mingguan')</script>";
			}
			
		}
	}
}

function cekquotatopik(){
	$q = mysql_query("
					select a.TOPIC_ID as topiknya from quota a
					join internship_registration b on b.MASTER_TOPIC_ID=a.TOPIC_ID
					where b.STATUS='IN PROGRESS'
					group by a.TOPIC_ID
					");
	while($d = mysql_fetch_array($q)){
		cekquota($d['topiknya']);
	}
}

function cekgrade($n){
	if($n>=1 and $n<=24){
		$g = "F";
	}elseif($n>=25 and $n<=29){
		$g = "E-";
	}elseif($n>=30 and $n<=34){
		$g = "E";
	}elseif($n>=35 and $n<=39){
		$g = "E+";
	}elseif($n>=40 and $n<=44){
		$g = "D-";
	}elseif($n>=45 and $n<=49){
		$g = "D";
	}elseif($n>=50 and $n<=54){
		$g = "D+";
	}elseif($n>=55 and $n<=59){
		$g = "C-";
	}elseif($n>=60 and $n<=64){
		$g = "C";
	}elseif($n>=65 and $n<=69){
		$g = "C+";
	}elseif($n>=70 and $n<=74){
		$g = "B-";
	}elseif($n>=75 and $n<=79){
		$g = "B";
	}elseif($n>=80 and $n<=84){
		$g = "B+";
	}elseif($n>=85 and $n<=89){
		$g = "A-";
	}elseif($n>=90 and $n<=94){
		$g = "A";
	}elseif($n>=95 and $n<=99){
		$g = "A+";
	}elseif($n==100){
		$g = "I";
	}else{
		$g = FALSE;
	}
	return $g;
}

function totgrade($n)
{
	$tot = $n/14;
	if($tot<=100 and $tot>=91){
		$g = "A";
	}elseif($tot<=90 and $tot>=61){
		$g = "B";
	}elseif($tot<=60 and $tot>=41){
		$g = "C";
	}elseif($tot<=40 and $tot>=21){
		$g = "D";
	}elseif($tot<=20 and $tot>=0){
		$g = "E";
	}else{
		$g = FALSE;
	}
	return $g;
}

function cektesti($id){
	$q = mysql_query("select * from testimonial where INTERN_ID='$id'");
	$jq = mysql_num_rows($q);
	if($jq>=1){
		return TRUE;
	}else{
		return FALSE;
	}
}

function ambiltesti($id){
	$q = mysql_query("select * from testimonial where INTERN_ID='$id'");
	$d = mysql_fetch_array($q);
	return $d['TESTIMONY'];
}

function tanggal($tgl){
	$date = new DateTime($tgl);
	return $date->format('D, d M Y');	// ('D, d M Y H:i:s');
}

function TanggalIndo($date){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);
 
	$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
	return($result);
}
?>
<?php
	session_start();
	include("db_connection.php");

	$username = mysql_real_escape_string($_POST['username']);
	$passwords = mysql_real_escape_string($_POST['password']);
	$password  = md5($passwords);

	// cek login
	$q = mysql_query("select guid as iduser, username, password, verified from user where username='$username' and password='$password'");
	$c = mysql_num_rows($q);

	if($c==1){
		// ambil sesinya
		$d = mysql_fetch_array($q);

		// cek verified
		if($d['verified']=='0'){
			eksyen('Sorry, you are not authorized','index.php');
		}
		
		$_SESSION['iduser'] = $d['iduser'];
		$_SESSION['username'] = $d['username'];
		$_username = $d['username'];

		// ambil data user_detail
		$qud = mysql_query("select firstname,guid as iddetail from user_detail where user_id='$d[iduser]'");
		$dud = mysql_fetch_array($qud);
		$_SESSION['firstname'] = $dud['firstname'];
		$_SESSION['iddetail'] = $dud['iddetail'];

		// ambil grup user
		$qg = mysql_query("select mg.group_name
							from ms_group as mg
							join member_of_group as mog
							join user_detail as ud
							on mg.guid = mog.ms_group_id
							and ud.guid = mog.user_detail_id
							where ud.user_id = '$_SESSION[iduser]'");
		$dqg = mysql_fetch_array($qg);
		$_SESSION['grup'] = $dqg['group_name'];

		// update status login & last login
		mysql_query("update user set ISLOGIN='1', LASTLOGIN=now() where username='$username'");

		// teks
		echo '<script>window.location.assign("home.php");</script>';
	}else{
		//teks
		echo '<script>alert("User Not Found");</script>';
		echo '<script>window.location.assign("index.php");</script>';
	}
?>
<?php session_start(); include 'db_connection.php';
if(!isset($_SESSION['bikinsekolah'])){
	eksyen('','index.php');
}

if(isset($_POST['instansi'])){
	$instansi = $_POST['instansi'];
	$nama = $_POST['nama'];
	$jabatan = $_POST['jabatan'];
	$alamat = $_POST['alamat'];
	$a = mysql_query("update institute set INSTITUTE_HEAD='$nama', INSTITUTE_RANK='$jabatan', INSTITUTE_ADDRESS='$alamat', USRUPD='USER', DTMUPD=now() where GUID='$instansi'");
	if($a){
		// ini buat hapus
		unset($_SESSION['bikinsekolah']);
		unset($_SESSION['idsekolah']);
		eksyen('Thank you','index.php');
	}else{
		eksyen('Gagal','add-college.php');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Your College - GMF AeroAsia</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
	<script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.mixitup.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</head>
<body class="container">
<form action="" method="POST" role="form">
	<legend>Tambah Sekolah / Universitas</legend>

	<div class="form-group">
		<label for="chief">Nama Sekolah / Universitas</label>
		<input type="text" class="form-control" id="chief" placeholder="<?=$_SESSION['bikinsekolah'];?>" name="nama" disabled>
		<input type="hidden" name="instansi" id="inputInstansi" class="form-control" value="<?=$_SESSION['idsekolah'];?>">
	</div>

	<div class="form-group">
		<label for="chief">Nama Ketua Yayasan / Pimpinan</label>
		<input type="text" class="form-control" id="chief" placeholder="Nama Ketua Yayasan / Pimpinan" name="nama" required>
	</div>

	<div class="form-group">
		<label for="jabatan">Jabatan Ketua Yayasan / Pimpinan</label>
		<input type="text" class="form-control" id="jabatan" placeholder="Jabatan Ketua Yayasan / Pimpinan" name="jabatan" required>
	</div>

	<div class="form-group">
		<label for="alamat">Alamat Instansi</label>
		<input type="text" class="form-control" id="alamat" placeholder="Alamat Instansi" name="alamat" required>
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>
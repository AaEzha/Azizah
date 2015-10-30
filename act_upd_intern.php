<?php session_start(); include("db_connection.php"); 
if(!isset($_POST['program'])){
	eksyen('','inside.php');
}else{
    $guid = mysql_real_escape_string($_POST['guid']);
    $program = mysql_real_escape_string($_POST['program']);
	$topik = mysql_real_escape_string($_POST['topik']);
    $projek = mysql_real_escape_string($_POST['projek']);
	$mulai = mysql_real_escape_string($_POST['mulai']);
	$selesai = mysql_real_escape_string($_POST['selesai']);
	$iduser = $_SESSION['iduser'];
    $usrcrt = $_SESSION['username'];

	//--------------------------proposal----------------------------------//
    if($_FILES['proposal']['name']!=""){
        $tmp_name  = $_FILES['proposal']['tmp_name']; //nama local temp file di server
        $file_size = $_FILES['proposal']['size']; //ukuran file (dalam bytes)
        $file_type = $_FILES['proposal']['type']; //tipe filenya (langsung detect MIMEnya)
            if($file_type!="application/pdf") eksyen('Improper File Type for Proposal. Use PDF only.','inside.php#mastersetting');
        $fp = fopen($tmp_name, 'r'); // open file (read-only, binary)
        $proposal = fread($fp, $file_size) or die("Tidak dapat membaca source file"); // read file
        $proposal = mysql_real_escape_string($proposal) or die("Tidak dapat membaca source file"); // parse image ke string
        fclose($fp); // tutup file
        mysql_query("update internship_registration set PROPOSAL='$proposal' where GUID='$guid'");
    }
    //--------------------------proposal----------------------------------//

    //--------------------------pengantar----------------------------------//
    if($_FILES['pengantar']['name']!=""){
        $tmp_name  = $_FILES['pengantar']['tmp_name']; //nama local temp file di server
        $file_size = $_FILES['pengantar']['size']; //ukuran file (dalam bytes)
        $file_type = $_FILES['pengantar']['type']; //tipe filenya (langsung detect MIMEnya)
            if($file_type!="application/pdf") eksyen('Improper File Type for Pengantar. Use PDF only.','inside.php#mastersetting');
        $fp = fopen($tmp_name, 'r'); // open file (read-only, binary)
        $pengantar = fread($fp, $file_size) or die("Tidak dapat membaca source file"); // read file
        $pengantar = mysql_real_escape_string($pengantar) or die("Tidak dapat membaca source file"); // parse image ke string
        fclose($fp); // tutup file
        mysql_query("update internship_registration set COVER_LETTER='$pengantar' where GUID='$guid'");
    }
    //--------------------------cv----------------------------------//

    $iduserdetail = $_SESSION['iddetail'];

    // UPDATE into user //
    $q = mysql_query("update internship_registration set MASTER_TOPIC_ID='$topik', PROGRAM_ID='$program', INTERNSHIP_PROJECT_ID='$projek', START_DATE='$mulai', END_DATE='$selesai', DTMUPD=now(), USRUPD='$usrcrt' where GUID='$guid'");
    // OK
    if ($q) {
        eksyen('Pendaftaran Internship berhasil! Tunggu konfirmasinya via email Anda','inside.php');
    } else {
        eksyen('Pendaftaran Internship gagal! Hubungi Administrator','index.php');
    }
    
    
}
?>
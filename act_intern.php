<?php session_start(); include("db_connection.php");
if(!isset($_POST['program'])){
	eksyen('','inside.php');
}else{
	$program = mysql_real_escape_string($_POST['program']);
	$topik = mysql_real_escape_string($_POST['topik']);
    $projek = mysql_real_escape_string($_POST['projek']);
	$mulai = mysql_real_escape_string($_POST['mulai']);
	$selesai = mysql_real_escape_string($_POST['selesai']);
	$iduser = $_SESSION['iduser'];
    $usrcrt = $_SESSION['username'];

	//--------------------------proposal----------------------------------//
    $tmp_name  = $_FILES['proposal']['tmp_name']; //nama local temp file di server
    $file_size = $_FILES['proposal']['size']; //ukuran file (dalam bytes)
    $file_type1 = $_FILES['proposal']['type']; //tipe filenya (langsung detect MIMEnya)
    $tipe = array("application/msword","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/pdf","image/jpeg","image/png","image/gif");
        if(!in_array($file_type1, $tipe)) eksyen('Improper File Type for CV. Use DOC/DOCX/PDF/Image only.','home.php#mastersetting');
    $fp = fopen($tmp_name, 'r'); // open file (read-only, binary)
    $proposal = fread($fp, $file_size) or die("Tidak dapat membaca source file"); // read file
    $proposal = mysql_real_escape_string($proposal) or die("Tidak dapat membaca source file"); // parse image ke string
    fclose($fp); // tutup file
    //--------------------------proposal----------------------------------//

    //--------------------------pengantar----------------------------------//
    $tmp_name  = $_FILES['pengantar']['tmp_name']; //nama local temp file di server
    $file_size = $_FILES['pengantar']['size']; //ukuran file (dalam bytes)
    $file_type2 = $_FILES['pengantar']['type'];
    $tipe = array("application/msword","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/pdf","image/jpeg","image/png","image/gif");
        if(!in_array($file_type2, $tipe)) eksyen('Improper File Type for CV. Use DOC/DOCX/PDF/Image only.','home.php#mastersetting');
    $fp = fopen($tmp_name, 'r'); // open file (read-only, binary)
    $pengantar = fread($fp, $file_size) or die("Tidak dapat membaca source file"); // read file
    $pengantar = mysql_real_escape_string($pengantar) or die("Tidak dapat membaca source file"); // parse image ke string
    fclose($fp); // tutup file
    //--------------------------cv----------------------------------//

    $iduserdetail = $_SESSION['iddetail'];
    $idedu = getdata('user_education',"USER_DETAIL_ID='".$iduserdetail."'",'EDUCATION_LEVEL_ID');

    // insert into user //
    $q = mysql_query("insert into internship_registration(GUID,USER_DETAIL_ID,EDUCATION_LEVEL_ID,MASTER_TOPIC_ID,PROGRAM_ID,INTERNSHIP_PROJECT_ID,START_DATE,END_DATE,PROPOSAL,MIME_PROPOSAL,COVER_LETTER,MIME_COVER_LETTER,DTMCRT,USRCRT) values(uuid(),'$iduserdetail','$idedu','$topik','$program','$projek','$mulai','$selesai','$proposal','$file_type1','$pengantar','$file_type2',now(),'$usrcrt')");
    // OK
    if ($q) {
        eksyen('Pendaftaran Internship berhasil! Tunggu konfirmasinya via email Anda','home.php');
    } else {
        eksyen('Pendaftaran Internship gagal! Hubungi Administrator','home.php');
    }
    
    
}
?>
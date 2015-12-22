<?php session_start(); include("db_connection.php");

// cek ada id atau ngga
if(!isset($_GET['id'])){
	echo "<script>window.close();</script>";
}

$id = $_GET['id']; // internship ID

// cek dulu di table letter
$q = mysql_query("select * from letter where IR_ID='$id' and JENIS='REJECTED'");
$jum = mysql_num_rows($q);
if($jum<1){
	echo "<script>window.close();</script>";
}
$d = mysql_fetch_array($q);

// table internship regis
$qir = mysql_query("select * from internship_registration where GUID='$id'");
$dqir = mysql_fetch_array($qir);

// table user_education
$que = mysql_query("select * from user_education where USER_DETAIL_ID='".$dqir['USER_DETAIL_ID']."'");
$dque = mysql_fetch_array($que);

// table settings -> nama akhir surat
$qts = mysql_query("select * from settings where S_TYPE='letter_pic'");
$dqts = mysql_fetch_array($qts);

ob_start();
?>
<p><img src="images/logo-email.png" style="height:50px"></p>
<p>Kepada Yth:<br>
<?=konvert('institute',$dque['INSTITUTE_ID'],'INSTITUTE_HEAD');?><br>
<?=konvert('institute',$dque['INSTITUTE_ID'],'INSTITUTE_RANK');?><br>
Di tempat</p>

<p><?=date('d F Y');?><br>
<?=$d['NOMOR'];?><br>
<b><i>Re: Permohonan <?=konvert('internship_program',$dqir['PROGRAM_ID'],'PROGRAM');?></i></b></p>

<p>Dengan Hormat,</p>

<p>Menindaklanjuti surat permohonan <?=konvert('internship_program',$dqir['PROGRAM_ID'],'PROGRAM');?> dari <?=konvert('institute',$dque['INSTITUTE_ID'],'INSTITUTE_NAME');?>. Bersama ini kami informasikan bahwa untuk saat ini kami belum dapat menerima/menjawab perihal penerimaan siswa yang Bapak/Ibu ajukan karena beberapa kebijakan.</p>

<p>Demikian kami sampaikan dan terima kasih atas perhatiannya.</p>

<p>Hormati kami,<br>
<b>PT. GMF AeroAsia<br>
<?=$dqts['S_VALUE'];?></b></p>

<p>&nbsp;</p>

<p><b><?=$dqts['S_NAME'];?></b><br>
<i>(Ditandatangani)</i></p>

<?php
$content = ob_get_clean();

// convert in PDF
require_once(dirname(__FILE__).'/pdf/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P', 'A4', 'en');
//      $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('GMF_AeroAsia_Rejection_Letter.pdf','D');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>
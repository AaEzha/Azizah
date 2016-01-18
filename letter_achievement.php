<?php session_start(); include("db_connection.php");

// cek ada id atau ngga
if(!isset($_GET['i'])){
	echo "<script>window.close();</script>";
}

$id = $_GET['i']; // internship ID

// cek dulu di table letter
$q = mysql_query("select * from letter where IR_ID='$id' and JENIS='ACHIEVEMENT'");

$jum = mysql_num_rows($q);
if($jum<1){
	echo "<script>window.close();</script>";
}

$d = mysql_fetch_array($q);

//Buat Biodata
$idintern = ambildata($id,'internship_registration','USER_DETAIL_ID');
$idtopic = ambildata($id,'internship_registration','MASTER_TOPIC_ID');
$ideducation = ambildata('x','user_education','EDUCATION_LEVEL_ID','USER_DETAIL_ID="'.$idintern.'"');
$idinstitute = ambildata('x','user_education','INSTITUTE_ID','USER_DETAIL_ID="'.$idintern.'"');
$idmajor = ambildata('x','user_education','MAJOR_ID','USER_DETAIL_ID="'.$idintern.'"');

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
<h3 align="center">SURAT KETERANGAN</h3>
<p align="center"><b><?=$d['NOMOR'];?></b></p>

<p>Yang bertanda tangan di bawah ini menerangkan bahwa Mahasiswa sebagai berikut:</p>

<table style="width: 100%; border: solid 0px #FFFFFF;  border-collapse:collapse;">
		<tr>
			<td style="width: 20%; border: solid 0px #FFFFFF;">Nama</td>
			<td style="width: 50%; border: solid 0px #FFFFFF;">: <b><?=ambildata($idintern,'user_detail','FIRSTNAME');?> <?=ambildata($idintern,'user_detail','LASTNAME');?></b></td>
		</tr>
		<tr>
			<td style="width: 20%; border: solid 0px #FFFFFF;">NIM/NIS</td>
			<td style="width: 50%; border: solid 0px #FFFFFF;">: <?=ambildata($idintern,'user_detail','NIM_NIS');?></td>
		</tr>
		<tr>
			<td style="width: 20%; border: solid 0px #FFFFFF;">Instansi</td>
			<td style="width: 50%; border: solid 0px #FFFFFF;">: <?=ambildata($idinstitute,'institute','INSTITUTE_NAME');?></td>
		</tr>
		<tr>
			<td style="width: 20%; border: solid 0px #FFFFFF;">Program Studi</td>
			<td style="width: 50%; border: solid 0px #FFFFFF;">: <?=ambildata($idmajor,'major','MAJOR_NAME');?> / <?=ambildata($ideducation,'education_level','EDUCATION_LEVEL_NAME');?></td>
		</tr>
</table>

<p>Telah melakukan <?=konvert('internship_program',$dqir['PROGRAM_ID'],'PROGRAM');?> di Dinas Learning Service PT. GMF AeroAsia  mulai tanggal <?=TanggalIndo($dqir['START_DATE']);?> s.d <?=TanggalIndo($dqir['END_DATE']);?>.</p>

<p>Demikian surat keterangan ini kami buat untuk digunakan sebagaimana mestinya.</p>

<p>Hormati kami,<br>
<b>PT. GMF AeroAsia<br>
<?=$dqts['S_VALUE'];?></b></p>

<p>&nbsp;</p>

<p><b><?=$dqts['S_NAME'];?></b></p>

<?php

$content = ob_get_clean();

// convert in PDF
require_once(dirname(__FILE__).'/pdf/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(20, 15, 15, 15));
//      $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('GMF_AeroAsia_Approval_Letter.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}

?>
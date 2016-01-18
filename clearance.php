<?php session_start(); include("db_connection.php");

// cek ada id atau ngga
if(!isset($_GET['id'])){
	echo "<script>window.close();</script>";
}

$id = $_GET['id']; // internship ID

// cek dulu di table letter
$q = mysql_query("select * from letter where IR_ID='$id' and JENIS='APPROVED'");

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

<p>Merujuk permintaan dari <?=konvert('institute',$dque['INSTITUTE_ID'],'INSTITUTE_NAME');?>, dengan ini diberitahukan bahwa pada prinsipnya kami menyetujui permohonan mahasiswa Bapak/Ibu yaitu:</p>

<ol>
	<li><?=konvert('user_detail',$dqir['USER_DETAIL_ID'],'firstname');?> <?=konvert('user_detail',$dqir['USER_DETAIL_ID'],'lastname');?></li>
</ol>

<p>Untuk melaksanakan <?=konvert('internship_program',$dqir['PROGRAM_ID'],'PROGRAM');?> di area GMF AeroAsia terhitung mulai tanggal <?=TanggalIndo($dqir['START_DATE']);?> s.d <?=TanggalIndo($dqir['END_DATE']);?>.</p>

<p>Guna ketertiban administrasi, mohon yang bersangkutan memperhatikan hal-hal sebagai berikut :</p>

<ol>
	<li>Hadir di GMF pada hari Selasa atau Kamis sebelum tanggal <?=TanggalIndo($dqir['START_DATE']);?> untuk melakukan proses pembuatan ID/Pas Intern GMF.</li>
	<li>Menyerahkan pas foto ukuran 3x4 dengan latar belakang berwarna merah 2 (dua) lembar.</li>
	<li>Menyerahkan pas foto ukuran 4x6 dengan latar belakang berwarna merah 1 (satu) lembar.</li>
	<li>Menyerahkan foto copy Kartu Pelajar/KTP 2 (dua) lembar.</li>
	<li>Khusus untuk mahasiswa membawa foto copy KTP 2 (dua) lembar.</li>
	<li>Siswa diharuskan berpakaian rapi.</li>
	<li>Pihak PT. GMF AeroAsia tidak menyediakan fasilitas (akomodasi) selama <?=konvert('internship_program',$dqir['PROGRAM_ID'],'PROGRAM');?>.</li>
	<li>Pihak PT. GMF AeroAsia tidak memungut biaya pelaksanaan <?=konvert('internship_program',$dqir['PROGRAM_ID'],'PROGRAM');?>.</li>
</ol>

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
    $html2pdf->Output('GMF_AeroAsia_Approval_Letter.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>
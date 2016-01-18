<?php session_start(); include("db_connection.php");

// cek ada id atau ngga
if(!isset($_GET['i'])){
	echo "<script>window.close();</script>";
}

$id = $_GET['i'];
$q = mysql_query("select * from internship_registration ir
				  join user_detail ud
				  on ud.GUID=ir.USER_DETAIL_ID
				  where ir.GUID='$id'");
$d = mysql_fetch_array($q);

$statusnya = $d['STATUS'];

//Buat Biodata
$idintern = ambildata($id,'internship_registration','USER_DETAIL_ID');
$idtopic = ambildata($id,'internship_registration','MASTER_TOPIC_ID');
$ideducation = ambildata('x','user_education','EDUCATION_LEVEL_ID','USER_DETAIL_ID="'.$idintern.'"');
$idinstitute = ambildata('x','user_education','INSTITUTE_ID','USER_DETAIL_ID="'.$idintern.'"');
$idmajor = ambildata('x','user_education','MAJOR_ID','USER_DETAIL_ID="'.$idintern.'"');

// Buat nilai akhir
$qa = mysql_query("select avg(value) as rata, sum(value) as total from assessment where INTERN_ID='$id'");
$dqa = mysql_fetch_array($qa);

// table settings -> nama akhir surat
$qts = mysql_query("select * from settings where S_TYPE='letter_pic'");
$dqts = mysql_fetch_array($qts);

//ob_start();
?>
<p><img src="images/logo-email.png" style="height:50px"></p>
<h1 align="center">Internship Assessment</h1>
<table style="width: 70%; border: solid 1px #FFFFFF; align:center; border-collapse:collapse;" align="center">
		<tr>
			<td style="width: 30%; border: solid 1px #FFFFFF;"></td>
			<td style="width: 20%; border: solid 1px #FFFFFF;">Nama</td>
			<td style="width: 50%; border: solid 1px #FFFFFF;">: <?=ambildata($idintern,'user_detail','FIRSTNAME');?> <?=ambildata($idintern,'user_detail','LASTNAME');?></td>
		</tr>
		<tr>
			<td style="width: 30%; border: solid 1px #FFFFFF;"></td>
			<td style="width: 20%; border: solid 1px #FFFFFF;">NIM/NIS</td>
			<td style="width: 50%; border: solid 1px #FFFFFF;">: <?=ambildata($idintern,'user_detail','NIM_NIS');?></td>
		</tr>
		<tr>
			<td style="width: 30%; border: solid 1px #FFFFFF;"></td>
			<td style="width: 20%; border: solid 1px #FFFFFF;">Instansi</td>
			<td style="width: 50%; border: solid 1px #FFFFFF;">: <?=ambildata($idinstitute,'institute','INSTITUTE_NAME');?></td>
		</tr>
		<tr>
			<td style="width: 30%; border: solid 1px #FFFFFF;"></td>
			<td style="width: 20%; border: solid 1px #FFFFFF;">Program Studi</td>
			<td style="width: 50%; border: solid 1px #FFFFFF;">: <?=ambildata($idmajor,'major','MAJOR_NAME');?> / <?=ambildata($ideducation,'education_level','EDUCATION_LEVEL_NAME');?></td>
		</tr>
</table>
<h3></h3>
		<table style="width: 100%; border: solid 1px #000000; align:center;" align="center">
			<thead>
				<tr>
					<th style="width: 10%; border: solid 1px #000000;">No</th>
					<th style="width: 40%; border: solid 1px #000000;">Elemen Penilaian</th>
					<th style="width: 20%; border: solid 1px #000000;">Penilaian</th>
					<th style="width: 10%; border: solid 1px #000000;">Grade</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$a = "A";
				$q = mysql_query("select * from assessment_element where sequence in('1','2','3') order by sequence asc");
				while($d = mysql_fetch_array($q)){ ?>
				<tr style="background-color:#333; color:#fff">
					<td style="width: 10%; border: solid 1px #000000; text-align:center;"><strong><?=$a;?></strong></td>
					<td style="width: 90%; border: solid 1px #000000;" colspan="3"><strong><?=$d['ASSESSMENT_ELEMENT_NAME'];?></strong></td>
				</tr>
				<?php
				$i = 1;
				$qq = mysql_query("select * from assessment_aspect where ASSESSMENT_ELEMENT_ID='$d[GUID]' order by sequence asc");
				while($dd = mysql_fetch_array($qq)){ ?>
				<tr>
					<td style="width: 10%; border: solid 1px #000000; text-align:center;"><?=$i;?></td>
					<td style="width: 60%; border: solid 1px #000000;"><?=$dd['ASSESSMENT_ASPECT_NAME'];?></td>
					<td style="width: 20%; border: solid 1px #000000; text-align:center;">
						<?php if($dqa['total']!=0){ ?>
							<?=getdata('assessment',"ASSESSMENT_ASPECT_ID='$dd[GUID]' and INTERN_ID='$_GET[i]'","VALUE");?>
						<?php }else{ ?>
						<?=getdata('assessment',"ASSESSMENT_ASPECT_ID='$dd[GUID]' and INTERN_ID='$_GET[i]'","VALUE");?>
						<?php } ?>
					</td>
					<td style="width: 10%; border: solid 1px #000000; text-align:center;"><?=getdata('assessment',"ASSESSMENT_ASPECT_ID='$dd[GUID]' and INTERN_ID='$_GET[i]'","GRADE");?></td>
				</tr>
				<?php $i++; } ?>
				<?php $a++; }
				$a = "D";
				$q = mysql_query("select * from assessment_element where sequence in('4') order by sequence asc");
				while($d = mysql_fetch_array($q)){ ?>
				<tr style="background-color:#333; color:#fff">
					<td style="width: 10%; border: solid 1px #000000; text-align:center;"><strong><?=$a;?></strong></td>
					<td style="width: 90%; border: solid 1px #000000;" colspan="3"><strong><?=$d['ASSESSMENT_ELEMENT_NAME'];?></strong></td>
				</tr>
				<?php
				$i = 1;
				$qq = mysql_query("select * from assessment_aspect where ASSESSMENT_ELEMENT_ID='$d[GUID]' order by sequence asc");
				while($dd = mysql_fetch_array($qq)){ ?>
				<tr>
					<td style="width: 10%; border: solid 1px #000000; text-align:center;"><?=$i;?></td>
					<td style="width: 60%; border: solid 1px #000000;"><?=$dd['ASSESSMENT_ASPECT_NAME'];?></td>
					<td style="width: 20%; border: solid 1px #000000; text-align:center;">
						<?php if($dqa['total']!=0){ ?>
							<?=getdata('assessment',"ASSESSMENT_ASPECT_ID='$dd[GUID]' and INTERN_ID='$_GET[i]'","VALUE");?>
						<?php }else{ ?>
						<?=getdata('assessment',"ASSESSMENT_ASPECT_ID='$dd[GUID]' and INTERN_ID='$_GET[i]'","VALUE");?>
						<?php } ?>
					</td>
					<td style="width: 10%; border: solid 1px #000000; text-align:center;"><?=getdata('assessment',"ASSESSMENT_ASPECT_ID='$dd[GUID]' and INTERN_ID='$_GET[i]'","GRADE");?></td>
				</tr>
				<?php $i++; } ?>
				<?php $a++; } ?>
				<tr>
					<td style="border: solid 1px #000000; text-align:right;" colspan="2"><strong>Jumlah Nilai</strong></td>
					<td style="border: solid 1px #000000; text-align:center;"><?=$dqa['total'];?></td>
					<td rowspan="2" style="border: solid 1px #000000; text-align:center;"><?=totgrade($dqa['total']);?></td>
				</tr>
				<tr>
					<td style="border: solid 1px #000000; text-align:right;" colspan="2"><strong>Rata-rata</strong></td>
					<td style="border: solid 1px #000000; text-align:center;"><?=round($dqa['rata']);?></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="2">
						<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td class="text-center"><span>I</span></td>
								<td><span>= Istimewa</span></td>
							</tr>
							<tr>
								<td class="text-center"><span>A</span></td>
								<td><span>= Baik Sekali</span></td>
							</tr>
							<tr>
								<td class="text-center"><span>B</span></td>
								<td><span>= Baik</span></td>
							</tr>
							<tr>
								<td class="text-center"><span>C</span></td>
								<td><span>= Cukup</span></td>
							</tr>
							<tr>
								<td class="text-center"><span >D</span></td>
								<td><span>= Kurang </span></td>
							</tr>
                        </table> 
					</td>
				</tr>
			</tbody>
		</table>

<table style="width: 70%; border: solid 1px #FFFFFF; align:center; border-collapse:collapse;" align="center">
		<tr>
			<td colspan="2" style="width: 100%; border: solid 1px #FFFFFF;text-align:right;"></td>
		</tr>
		<tr>
			<td style="width: 50%; border: solid 1px #FFFFFF; text-align:center; "></td>
			<td style="width: 50%; border: solid 1px #FFFFFF; text-align:center; "><b>Cengkareng,</b></td>
		</tr>
		<tr>
			<td style="width: 50%; border: solid 1px #FFFFFF; text-align:center; ">Mengetahui,</td>
			<td style="width: 50%; border: solid 1px #FFFFFF; text-align:center; ">PT. GMF AeroAsia</td>
		</tr>
		<tr>
			<td style="width: 50%; border: solid 1px #FFFFFF; text-align:center; "><?=$dqts['S_VALUE'];?></td>
			<td style="width: 50%; border: solid 1px #FFFFFF; text-align:center; ">Pembimbing</td>
		</tr>
		<tr style="height:150px;">
			<td style="width: 50%; border: solid 1px #FFFFFF; text-align:center; "><?=$dqts['S_NAME'];?><br></td>
			<td style="width: 50%; border: solid 1px #FFFFFF; text-align:center; ">__________________________</td>
		</tr>
</table>

<?php
/*
$content = ob_get_clean();

// convert in PDF
require_once(dirname(__FILE__).'/pdf/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P', 'A4', 'en');
//      $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('GMF_AeroAsia_Assessment_Letter.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
*/
?>

<script>window.print();</script>
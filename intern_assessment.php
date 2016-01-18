<?php
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

?>
<script type="text/javascript">
	$(function() {
		$("#sembunyi").hide();
	});
</script>
<h1 class="text-center">Internship Assessment</h1>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-2">
		Nama
	</div>
	<div class="col-md-2">
		: <?=ambildata($idintern,'user_detail','FIRSTNAME');?> <?=ambildata($idintern,'user_detail','LASTNAME');?>
	</div>
	<div class="col-md-4"></div>
</div>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-2">
		NIM/NIS
	</div>
	<div class="col-md-2">
		: <?=ambildata($idintern,'user_detail','NIM_NIS');?>
	</div>
	<div class="col-md-4"></div>
</div>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-2">
		Sekolah/Universitas
	</div>
	<div class="col-md-2">
		: <?=ambildata($idinstitute,'institute','INSTITUTE_NAME');?>
	</div>
	<div class="col-md-4"></div>
</div>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-2">
		Program Studi
	</div>
	<div class="col-md-2">
		: <?=ambildata($idmajor,'major','MAJOR_NAME');?> / <?=ambildata($ideducation,'education_level','EDUCATION_LEVEL_NAME');?>
	</div>
	<div class="col-md-4"></div>
</div>

<?php
if(isset($_POST['aspek']))
{
	$aspek = $_POST['aspek'];
	$nilai = $_POST['nilai'];
	for($x=0; $x<count($aspek); $x++)
	{
		mysql_query("insert into assessment(GUID,INTERN_ID,ASSESSMENT_ASPECT_ID,VALUE,GRADE,DTMCRT,USRCRT) values(uuid(),'$id','$aspek[$x]','$nilai[$x]','".cekgrade($nilai[$x])."',now(),'$_SESSION[namalengkap]')");
	}

	$aspek = $_POST['aspek2'];
	$nilai = $_POST['nilai2'];
	for($x=0; $x<count($aspek); $x++)
	{
		mysql_query("insert into assessment(GUID,INTERN_ID,ASSESSMENT_ASPECT_ID,VALUE,GRADE,DTMCRT,USRCRT) values(uuid(),'$id','$aspek[$x]','$nilai[$x]','-',now(),'$_SESSION[namalengkap]')");
	}

	mysql_query("update internship_registration set STATUS='FINISHED' where GUID='$id'");

	// kirim email
	$_SESSION['namanya'] = $_POST['namanya'];
	$_SESSION['emailnya'] = $_POST['emailnya'];
	include 'email/assessment.php';
	eksyen('Saved!','?p=intern_assessment&i='.$id.'');
}
?>

<div class="row">
<form action="" method="post">
	<input type="hidden" name="namanya" id="inputNamanya" class="form-control" value="<?=ambildata($idintern,'user_detail','FIRSTNAME');?> <?=ambildata($idintern,'user_detail','LASTNAME');?>">
	<input type="hidden" name="emailnya" id="inputEmailnya" class="form-control" value="<?=ambildata($idintern,'user_detail','EMAIL');?>">
	<div class="col-md-offset-2 col-md-8">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="col-md-1 text-center">No</th>
					<th>Elemen Penilaian</th>
					<th class="col-md-2 text-center">Penilaian</th>
					<th class="col-md-1 text-center">Grade</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$a = "A";
				$q = mysql_query("select * from assessment_element where sequence in('1','2','3') order by sequence asc");
				while($d = mysql_fetch_array($q)){ ?>
				<tr style="background-color:#333">
					<td class="text-center"><strong><?=$a;?></strong></td>
					<td colspan="3"><strong><?=$d['ASSESSMENT_ELEMENT_NAME'];?></strong></td>
				</tr>
				<?php
				$i = 1;
				$qq = mysql_query("select * from assessment_aspect where ASSESSMENT_ELEMENT_ID='$d[GUID]' order by sequence asc");
				while($dd = mysql_fetch_array($qq)){ ?>
				<tr>
					<td class="text-center"><?=$i;?></td>
					<td><?=$dd['ASSESSMENT_ASPECT_NAME'];?></td>
					<td class="text-center">
						<input type="hidden" name="aspek[]" id="inputAspek[]" class="form-control" value="<?=$dd['GUID'];?>">
						<?php if($dqa['total']!=0){ ?>
							<?=getdata('assessment',"ASSESSMENT_ASPECT_ID='$dd[GUID]' and INTERN_ID='$_GET[i]'","VALUE");?>
						<?php }else{ ?>
						<input type="text" name="nilai[]" id="input" class="form-control text-center input-sm" value="<?=getdata('assessment',"ASSESSMENT_ASPECT_ID='$dd[GUID]' and INTERN_ID='$_GET[i]'","VALUE");?>" required="required" onkeypress="return isNumber(event)" maxlength="3"<?php if($dqa['total']!=0){ echo " disabled";} ?>>
						<?php } ?>
					</td>
					<td class="text-center"><?=getdata('assessment',"ASSESSMENT_ASPECT_ID='$dd[GUID]' and INTERN_ID='$_GET[i]'","GRADE");?></td>
				</tr>
				<?php $i++; } ?>
				<?php $a++; }
				$a = "D";
				$q = mysql_query("select * from assessment_element where sequence in('4') order by sequence asc");
				while($d = mysql_fetch_array($q)){ ?>
				<tr style="background-color:#333">
					<td class="text-center"><strong><?=$a;?></strong></td>
					<td colspan="3"><strong><?=$d['ASSESSMENT_ELEMENT_NAME'];?></strong></td>
				</tr>
				<?php
				$i = 1;
				$qq = mysql_query("select * from assessment_aspect where ASSESSMENT_ELEMENT_ID='$d[GUID]' order by sequence asc");
				while($dd = mysql_fetch_array($qq)){ ?>
				<tr>
					<td class="text-center"><?=$i;?></td>
					<td><?=$dd['ASSESSMENT_ASPECT_NAME'];?></td>
					<td class="text-center">
						<input type="hidden" name="aspek2[]" id="inputAspek[]" class="form-control" value="<?=$dd['GUID'];?>">
						<?php if($dqa['total']!=0){ ?>
							<?=getdata('assessment',"ASSESSMENT_ASPECT_ID='$dd[GUID]' and INTERN_ID='$_GET[i]'","VALUE");?>
						<?php }else{ ?>
						<input type="text" name="nilai2[]" id="input" class="form-control text-center input-sm" value="<?=getdata('assessment',"ASSESSMENT_ASPECT_ID='$dd[GUID]' and INTERN_ID='$_GET[i]'","VALUE");?>" required="required" onkeypress="return isNumber(event)" maxlength="3"<?php if($dqa['total']!=0){ echo " disabled";} ?>>
						<?php } ?>
					</td>
					<td class="text-center"><?=getdata('assessment',"ASSESSMENT_ASPECT_ID='$dd[GUID]' and INTERN_ID='$_GET[i]'","GRADE");?></td>
				</tr>
				<?php $i++; } ?>
				<?php $a++; } ?>
				<tr>
					<td class="text-right" colspan="2"><strong>Jumlah Nilai</strong></td>
					<td class="text-center"><?=$dqa['total'];?></td>
					<td rowspan="2" align="middle"><?=totgrade($dqa['total']);?></td>
				</tr>
				<tr>
					<td class="text-right" colspan="2"><strong>Rata-rata</strong></td>
					<td class="text-center"><?=round($dqa['rata']);?></td>
				</tr>
				<tr>
					<td colspan="4">
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td width="80%"><span></span></td>
								<td><span>I = Istimewa (90-100)</span></td>
							</tr>
							<tr>
								<td class="text-center"><span></span></td>
								<td><span>A = Baik Sekali</span> (80-89)</td>
							</tr>
							<tr>
								<td class="text-center"><span></span></td>
								<td><span>B = Baik</span> (65-79)</td>
							</tr>
							<tr>
								<td class="text-center"><span></span></td>
								<td><span>C = Cukup</span> (56-64)</td>
							</tr>
							<tr>
								<td class="text-center"><span ></span></td>
								<td><span>D = Kurang </span> (0-55)</td>
							</tr>
                        </table> 
					</td>
				</tr>
			</tbody>
		</table>

		<tr>
            <td height="21" colspan="4" valign="top"><table width="288" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
				<td width="288" align="center"><button class="button button-sp"<?php if($dqa['total']!=0){ echo " disabled";} ?>>Submit</button></form>
                    </span>
					<button class="button button-sp">Reset</button></td>
        </tr>
                    
	</div>
	<button type="submit" id="sembunyi" class="btn btn-primary"<?php if($dqa['total']!=0){ echo " disabled";} ?>>Submit</button>
</form>
</div>
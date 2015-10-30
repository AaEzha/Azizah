<br><h1>On-Going Intern</h1>
<?=tabel();?>
<?php
if(isset($_POST['intern'])){
	$id = $_SESSION['iddetail'];
	$unitid = ambildata($id,'user_detail','UNIT_ID');
	foreach ($_POST['intern'] as $intern) {
		mysql_query("update internship_registration set STATUS='APPROVED', UNIT_ID='$unitid' where GUID='$intern'");
	}
	foreach ($_POST['iduserdetail'] as $iduserdetail) {
		mysql_query("update user_detail set UNIT_ID='$unitid' where GUID='$iduserdetail'");
	}
	eksyen('Saved!','inside.php');
}
?>
<form action="" method="post">
<table class="table table-condensed" id="tbl">
  <thead>
    <tr>
      <th class="col-md-1 text-center">No</th>
      <th class="col-md-2 text-center">Nama</th>
      <th class="col-md-2 text-center">Program</th>
      <th class="text-center">Topik/Referensi</th>
      <th class="col-md-2 text-center">Periode</th>
      <th class="col-md-2 text-center">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $i = 1;
  $id = $_SESSION['iddetail'];
  $unitid = ambildata($id,'user_detail','UNIT_ID');
  $q = mysql_query("select * from internship_registration where STATUS in('APPROVED','IN PROGRESS') and UNIT_ID='$unitid'");
  while($d = mysql_fetch_array($q)){ 
  ?>
    <tr>
      <td class="text-center">
      	<?=$i;?>
      	<input type="hidden" name="iduserdetail[]" id="inputIduserdetail" class="form-control" value="<?=$d['USER_DETAIL_ID'];?>">
      </td>
      <td class="text-center"><?=ambildata($d['USER_DETAIL_ID'],'user_detail','FIRSTNAME');?></td>
      <td class="text-center"><?=ambildata($d['PROGRAM_ID'],'internship_program','PROGRAM');?></td>
      <td class="text-center"><?=ambildata($d['MASTER_TOPIC_ID'],'master_topic','TOPIC_NAME');?></td>
      <td class="text-center"><?=$d['START_DATE'];?> / <?=$d['END_DATE'];?></td>
      <td class="text-center"><input type="checkbox" name="intern[]" value="<?=$d['GUID'];?>"></td>
    </tr>
  <?php $i++; } ?>
  </tbody>
  <tfoot>
  	<tr>
  	  <td colspan="5"></td>
  	  <td><input type="submit" class="btn btn-block btn-success" value="Selesai"></td>
  	</tr>
  </tfoot>
</table>
</form>
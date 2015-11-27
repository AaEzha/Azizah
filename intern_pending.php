<br><h1>Pending Intern</h1>
<?=tabel();?>
<?php
if(isset($_POST['iduserdetail'])){
	$id = $_SESSION['iddetail'];
	$unitid = ambildata($id,'user_detail','UNIT_ID');

  $tgl = date('d');
  $bln = date('m');
  $thn = date('Y');
  if ($tgl>="1" and $tgl<="7") {
    $qw = "WEEK1";
    $week = "1";
  } elseif ($tgl>="8" and $tgl<="14") {
    $qw = "WEEK2";
    $week = "2";
  } elseif ($tgl>="15" and $tgl<="21") {
    $qw = "WEEK3";
    $week = "3";
  } elseif ($tgl>="22" and $tgl<="28") {
    $qw = "WEEK4";
    $week = "4";
  } elseif ($tgl>="29" and $tgl<="31") {
    $qw = "WEEK5";
    $week = "5";
  }

  
  
  $iduserdetail = $_POST['iduserdetail'];
  $topik = $_POST['topik'];

  if(isset($_POST['intern'])){
    $intern = $_POST['intern'];
    for($x=0; $x<count($intern); $x++){
      // cek dulu, quotanya sudah ada atau belum
      $q = mysql_query("select * from quota where ".$qw."is NULL and MONTH='$bln' and YEAR='$thn' and TOPIC_ID='".$topik[$x]."'");

      mysql_query("update internship_registration set DTMUPD=now(), USRUPD='".$_SESSION['username']."', STATUS='APPROVED', UNIT_ID='$unitid' where GUID='".$intern[$x]."'");
      mysql_query("update user_detail set DTMUPD=now(), USRUPD='".$_SESSION['username']."', UNIT_ID='$unitid' where GUID='".$iduserdetail[$x]."'");
      mysql_query("update quota set DTMUPD=now(), USRUPD='".$_SESSION['username']."', ".$qw."=".$qw."-'1' where TOPIC_ID='".$topik[$x]."'");

      // untuk email
      $_SESSION['namanya'] = data_user_detail($iduserdetail[$x],"FIRSTNAME") ." ". data_user_detail($iduserdetail[$x],"LASTNAME");
      $_SESSION['emailnya'] = data_user_detail($iduserdetail[$x],"EMAIL");
      include 'email/clearance.php';
    }
  }
  
  if(isset($_POST['rijek'])){
    $rijek = $_POST['rijek'];
    for($y=0; $y<count($rijek); $y++){
      mysql_query("update internship_registration set DTMUPD=now(), USRUPD='".$_SESSION['username']."', STATUS='REJECTED', UNIT_ID='$unitid' where GUID='".$rijek[$y]."'");

      // untuk email
      $_SESSION['namanya'] = data_user_detail($iduserdetail[$y],"FIRSTNAME") ." ". data_user_detail($iduserdetail[$y],"LASTNAME");
      $_SESSION['emailnya'] = data_user_detail($iduserdetail[$y],"EMAIL");
      include 'email/rejection.php';
    }
  }
/*
	foreach ($_POST['intern'] as $intern) {
		mysql_query("update internship_registration set STATUS='APPROVED', UNIT_ID='$unitid' where GUID='$intern'");
	}
	foreach ($_POST['iduserdetail'] as $iduserdetail) {
		mysql_query("update user_detail set UNIT_ID='$unitid' where GUID='$iduserdetail'");
	}
*/
	eksyen('Saved!','home.php#internship');
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
      <th class="col-md-1 text-center">Accept</th>
      <th class="col-md-1 text-center">Reject</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $i = 1;
  $q = mysql_query("select * from internship_registration where STATUS='PENDING'");
  while($d = mysql_fetch_array($q)){ 
  ?>
    <tr>
      <td class="text-center">
      	<?=$i;?>
      	<input type="hidden" name="iduserdetail[]" id="inputIduserdetail" class="form-control" value="<?=$d['USER_DETAIL_ID'];?>">
        <input type="hidden" name="topik[]" id="inputTopik[]" class="form-control" value="<?=$d['MASTER_TOPIC_ID'];?>">
      </td>
      <td class="text-center"><?=ambildata($d['USER_DETAIL_ID'],'user_detail','FIRSTNAME');?></td>
      <td class="text-center"><?=ambildata($d['PROGRAM_ID'],'internship_program','PROGRAM');?></td>
      <td class="text-center"><?=ambildata($d['MASTER_TOPIC_ID'],'master_topic','TOPIC_NAME');?></td>
      <td class="text-center"><?=$d['START_DATE'];?> / <?=$d['END_DATE'];?></td>
      <td class="text-center"><input type="checkbox" name="intern[]" value="<?=$d['GUID'];?>"></td>
      <td class="text-center"><input type="checkbox" name="rijek[]" value="<?=$d['GUID'];?>"></td>
    </tr>
  <?php $i++; } ?>
  </tbody>
  <tfoot>
  	<tr>
  	  <td colspan="5"></td>
  	  <td colspan="2"><input type="submit" class="btn btn-block btn-info" value="Pilih"></td>
  	</tr>
  </tfoot>
</table>
</form>
<?php
// cek kondisi start/finish
if(isset($_GET['a']) and isset($_GET['x']))
{
  $idinter  = $_GET['i'];
  $aksi     = $_GET['a'];
  $auth     = $_GET['x'];
  $idhash   = md5($idinter);

  // cek kesamaan auth dan idhash
  if($idhash != $auth)
  {
    eksyen('No Trespassing!','?p=intern');
  }
  else
  {
    if($aksi == md5("start"))
    {
      mysql_query("update internship_registration set STATUS='IN PROGRESS', DTMUPD=now(), USRUPD='".$_SESSION['firstname']."' where GUID='$idinter'");
      eksyen('It is starting!','?p=intern');
    }
    elseif($aksi == md5("finish"))
    {
      // update status internship
      mysql_query("update internship_registration set STATUS='DONE', DTMUPD=now(), USRUPD='".$_SESSION['firstname']."' where GUID='$idinter'");

      // update quota
      $dq = mysql_query("select * from internship_registration where GUID='$idinter'");
      $ddq = mysql_fetch_array($dq);
      $idtopik = $ddq['MASTER_TOPIC_ID'];
      $weeksekarang = findweek(date('d'),'long');
      $angkaweek = findweek(date('d'),'short');
      $bln = date('m');
      $thn = date('Y');
      $qw = getdata("quota","TOPIC_ID='$idtopik' and YEAR='$thn' and MONTH='$bln'","WEEK".$angkaweek);
      $sql = "update quota set ".$weeksekarang."='$qw'+1 where TOPIC_ID='$idtopik' and YEAR='$thn' and MONTH='$bln'";
      mysql_query($sql);

      // kirim email finish
      $_SESSION['namanya'] = data_user_detail($ddq['USER_DETAIL_ID'],"FIRSTNAME");
      $_SESSION['emailnya'] = data_user_detail($ddq['USER_DETAIL_ID'],"EMAIL");
      include 'email/finish.php';
      eksyen('It is finished! ','?p=intern');
    }
    else
    {
      eksyen('No Trespassing!','?p=intern');
    }
  }
}
?>

<h1>Internship History</h1>
<?=tabel();?>
<table class="table table-condensed" id="tbl">
  <thead>
    <tr>
      <th class="col-md-1 text-center">No</th>
      <th class="col-md-2 text-center">Nama</th>
      <th class="col-md-2 text-center">Program</th>
      <th class="text-center">Topik/Referensi</th>
      <th class="col-md-2 text-center">Periode</th>
      <th class="col-md-1 text-center">Status</th>
      <th class="col-md-2 text-center">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $i = 1;
  if($_SESSION['grup']=="LCU"){
    $id = $_SESSION['iddetail'];
    $unitid = ambildata($id,'user_detail','UNIT_ID');
    $q = mysql_query("select * from internship_registration where UNIT_ID='$unitid' order by DTMUPD desc");
  }elseif($_SESSION['grup']=="ADMIN"){
    $q = mysql_query("select * from internship_registration order by DTMUPD desc");
  }
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
      <td class="text-center"><?=$d['STATUS'];?></td>
      <td class="text-center">
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <a href="?p=intern_detail&i=<?=$d['GUID'];?>" class="btn btn-info btn-sm" title="Internship Detail">Detail</a>
          <?php if($_SESSION['grup']=="LCU"){ ?>
            <?php if($d['STATUS']=="APPROVED"){ ?>
            <a href="?p=intern&i=<?=$d['GUID'];?>&a=<?=md5('start');?>&x=<?=md5($d['GUID']);?>" class="btn btn-primary btn-sm" title="Start Internship">Start</a>
            <?php } ?>
            <?php if($d['STATUS']=="IN PROGRESS"){ ?>
            <a href="?p=intern_assessment&i=<?=$d['GUID'];?>" class="btn btn-primary btn-sm" title="Fill in the Assessment">Assessment</a>
            <?php } ?>
            <?php if($d['STATUS']=="FINISHED"){ ?>
            <a href="?p=intern&i=<?=$d['GUID'];?>&a=<?=md5('finish');?>&x=<?=md5($d['GUID']);?>" class="btn btn-success btn-sm" title="Finish Internship" <?php if(cektesti($d['GUID'])==FALSE){ echo "disabled"; }else{ echo "/"; } ?>>Finish</a>
            <?php } ?>
          <?php } ?>
        </div>
      </td>
    </tr>
  <?php $i++; } ?>
  </tbody>
</table>
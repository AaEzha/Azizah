<br><h1>Percakapan</h1>
<?php $id = $_GET['i']; $unit = $_GET['u']; ?>
<?php
if(isset($_POST['internid'])){
	$internid = mysql_real_escape_string($_POST['internid']);
	$pesan = mysql_real_escape_string($_POST['pesan']);
	$userid = mysql_real_escape_string($_POST['internid']);
	$uid = $_SESSION['iddetail'];
	$q = mysql_query("insert into message(GUID,UNIT_ID,INTERN_ID,SENDER_ID,MESSAGE,DTMCRT) values(uuid(),'$unit','$id','$uid','$pesan',now())");
	eksyen('','inside.php');
}
?>
<form class="form-horizontal" action="" method="post">
	<input type="hidden" name="internid" id="inputInternid" class="form-control" value="<?=$id;?>">
  <div class="form-group">
    <label for="inputPesan" class="col-sm-2 control-label">Pesan</label>
    <div class="col-sm-5">
      <textarea name="pesan" id="inputPesan" class="form-control" rows="3" required="required"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
<h3>Histori Percakapan</h3>
<div class="col-md-12">
<?php
$q = mysql_query("select * from message where INTERN_ID='$id' order by DTMCRT desc");
while($d = mysql_fetch_array($q)){
?>
	<div class="col-md-2">
		<?=ambildata($d['SENDER_ID'],'user_detail','FIRSTNAME');?> <?=ambildata($d['SENDER_ID'],'user_detail','LASTNAME');?>
		<br>
		<?=$d['DTMCRT'];?>
	</div>
	<div>
		<code><?=$d['MESSAGE'];?></code>
		<hr>
	</div>
<?php } ?>
</div>

<p>&nbsp;</p><p>&nbsp;</p>
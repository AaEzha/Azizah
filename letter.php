<?php
$q = mysql_query("select * from settings where S_TYPE='letter_pic'");
$d = mysql_fetch_array($q);
$j = mysql_num_rows($q);
if($j==0){
	mysql_query("insert into settings(S_TYPE,S_NAME,S_VALUE) values('letter_pic','','')");
	eksyen('','?p=letter');
}

if(isset($_POST['nama'])){
	$tipe = mysql_real_escape_string($_POST['tipe']);
	$nama = mysql_real_escape_string($_POST['nama']);
	$rank = mysql_real_escape_string($_POST['rank']);
	mysql_query("update settings set S_NAME='$nama', S_VALUE='$rank' where S_TYPE='$tipe'");
	eksyen('','?p=letter');
}
?>

	<h1>Letter <small>Configuration</small></h1>
	<form class="form-horizontal" action="" method="post">
	  <input type="hidden" name="tipe" value="letter_pic">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">PIC Name</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control input-sm" name="nama" placeholder="PIC Name" maxlength="35" value="<?=$d['S_NAME'];?>">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">PIC Rank</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control input-sm" name="rank" placeholder="PIC Rank" maxlength="35" value="<?=$d['S_VALUE'];?>">
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-success">Save</button>
	      <button type="reset" class="btn btn-default">Reset</button>
	    </div>
	  </div>
	</form>
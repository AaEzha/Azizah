<?php
if(isset($_GET['i'])){
	$i = $_GET['i'];
	$q = mysql_query("select * from guestbook where GUID='$i'");
	$d = mysql_fetch_array($q);
}else{
	eksyen('','home.php');
}

if(isset($_POST['subjek']))
{
	$_SESSION['emailnya'] = $d['EMAIL'];
	$_SESSION['namanya'] = $d['FIRSTNAME'];
	$_SESSION['judulnya'] = mysql_real_escape_string($_POST['subjek']);
	$_SESSION['teks'] = mysql_real_escape_string($_POST['teks']);
	$_SESSION['namap'] = $_SESSION['firstname'];
	$_SESSION['emailp'] = data_user_detail($_SESSION['iddetail'],'EMAIL');
	mysql_query("update guestbook set REPLY='1' where GUID='$i'");
	require 'email/guestbook.php';
	eksyen('Email sent!','home.php#comment');
}
?>
<h1>Reply Guestbook</h1>
<div class="col-md-8">
	<form action="" method="POST" role="form">

		<div class="form-group">
			<label for="subjek">Email Subject</label>
			<input type="text" class="form-control" id="subjek" name="subjek" placeholder="Email Subject" required>
		</div>

		<div class="form-group">
			<label for="inputTeks">Email Text</label>
			<textarea name="teks" id="inputTeks" class="form-control" rows="3" required="required"></textarea>
		</div>

		

		<button type="submit" class="btn btn-primary">Send</button>
	</form>
</div>
<div class="col-md-4">
	<div class="panel panel-info">
		  <div class="panel-heading">
				<h3 class="panel-title"><?=$d['FIRSTNAME'];?> <small>(<?=$d['EMAIL'];?>)</small></h3>
		  </div>
		  <div class="panel-body">
				<span style="color:#000000"><?=$d['COMMENT'];?></span>
		  </div>
		  <div class="panel-footer">
				<span style="color:#000000"><?=time_ago($d['DTMCRT']);?></span>
		  </div>
	</div>
</div>
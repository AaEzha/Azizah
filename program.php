<?php
if(!isset($_GET['act'])){
?>
	<h1>Program <small>| <a href="?p=program&act=add">Add Program</a></small></h1>
	<div class="row">
		<div class="col-md-12">
			<?php tabel();?>
			<table class="table " id="tbl">
			  <thead>
			    <tr>
			      <th class="col-md-1 text-center">No</th>
			      <th>Program Name</th>
			      <th class="col-md-2 text-center">Unit</th>
			      <th class="col-md-2 text-center">#</th>
			    </tr>
			  </thead>
			  <tbody>
			    <?php
			    $i = 1;
			    $qc = mysql_query("select * from program order by date(dtmcrt) desc");
			    while($dc = mysql_fetch_array($qc)){
			    ?>
			    <tr>
			      <td class="text-center"><?=$i;?></td>
			      <td><?php echo $dc['PROGRAM_NAME'];?></td>
			      <td class="text-center"><?php echo getdata('unit',"GUID='".$dc['UNIT_ID']."'",'UNIT_NAME');?></td>
			      <td class="text-center">
			      	<a type="button" class="btn btn-xs btn-primary" href="?p=program&act=edit&guid=<?php echo $dc['GUID'];?>">Edit</a>
			      	<a type="button" class="btn btn-xs btn-danger" href="?p=program&act=delete&guid=<?php echo $dc['GUID'];?>" <?php yakin();?>>Delete</a>
			      </td>
			    </tr>
			    <?php $i++; } ?>
			  </tbody>
			</table>
		</div>
	</div>
<?php
}else{
	echo "<script type='text/javascript' src='js/tinymce/tinymce.min.js'></script><script>tinymce.init({selector:'#detail,#need'});</script>";
	$act = $_GET['act'];
	switch ($act) {
		case 'add':
		if(isset($_POST['code'])){
			$user = $_SESSION['username'];
			$code = mysql_real_escape_string($_POST['code']);
			$detail = mysql_real_escape_string($_POST['detail']);
			$need = mysql_real_escape_string($_POST['need']);
			$mulai = mysql_real_escape_string($_POST['mulai']);
			$selesai = mysql_real_escape_string($_POST['selesai']);
			$q = mysql_query("insert into program(GUID,PROGRAM_NAME,PROGRAM_DETAIL,PROGRAM_NEED,PROGRAM_START
				,PROGRAM_END,DTMCRT,USRCRT) values(uuid(),'$code','$detail','$need','$mulai','$selesai',now(),'$user')");
			if($q){
				eksyen('','?p=program');
			}else{
				eksyen('Error!','?p=program');
			}
		}
?>
	<h1>Add Program <small>| <a href="?p=program">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Program Name</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="code" placeholder="Program Name" maxlength="35" required>
	    </div>
	    <div class="col-sm-2">
	      <input type="text" class="form-control" id="tgls" name="mulai" placeholder="Start Date" maxlength="10" required>
	    </div>
	    <div class="col-sm-2">
	      <input type="text" class="form-control" id="tglf" name="selesai" placeholder="Start Date" maxlength="10" required>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Program Detail</label>
	    <div class="col-sm-8">
	      <textarea name="detail" id="detail" class="form-control" rows="3"></textarea>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Program Need</label>
	    <div class="col-sm-8">
	      <textarea name="need" id="need" class="form-control" rows="3"></textarea>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-success">Save</button>
	      <button type="reset" class="btn btn-warning">Reset</button>
	    </div>
	  </div>
	</form>
<?php
			break;

		case 'edit':
		if(!isset($_GET['guid']) or $_GET['guid']==''){
			eksyen('','?p=program');
		}
		$guid = $_GET['guid'];
		$a = mysql_query("select * from program where guid='$guid'");
			$c = mysql_num_rows($a);
			if($c<1){
				eksyen('','?p=program');
			}
		$d = mysql_fetch_array($a);

		if(isset($_POST['code'])){
			$user = $_SESSION['username'];
			$code = mysql_real_escape_string($_POST['code']);
			$detail = mysql_real_escape_string($_POST['detail']);
			$need = mysql_real_escape_string($_POST['need']);
			$mulai = mysql_real_escape_string($_POST['mulai']);
			$selesai = mysql_real_escape_string($_POST['selesai']);
			$q = mysql_query("update program set PROGRAM_NAME='$code', PROGRAM_DETAIL='$detail', PROGRAM_NEED='$need', PROGRAM_START='$mulai', PROGRAM_END='$selesai', DTMUPD=now(), USRUPD='$user' where GUID='$guid'");
			if($q){
				eksyen('','?p=program');
			}else{
				eksyen('Error!','?p=program');
			}
		}
?>
	<h1>Edit Program <small>| <a href="?p=program">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Program Name</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="code" placeholder="Program Name" maxlength="35" value="<?=$d['PROGRAM_NAME'];?>">
	    </div>
	    <div class="col-sm-2">
	      <input type="text" class="form-control" id="tgls" name="mulai" placeholder="Start Date" maxlength="10" value="<?=$d['PROGRAM_START'];?>">
	    </div>
	    <div class="col-sm-2">
	      <input type="text" class="form-control" id="tglf" name="selesai" placeholder="Start Date" maxlength="10" value="<?=$d['PROGRAM_END'];?>">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Program Detail</label>
	    <div class="col-sm-8">
	      <textarea name="detail" id="detail" class="form-control" rows="3"><?=$d['PROGRAM_DETAIL'];?></textarea>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Program Need</label>
	    <div class="col-sm-8">
	      <textarea name="need" id="need" class="form-control" rows="3"><?=$d['PROGRAM_NEED'];?></textarea>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-success">Save</button>
	      <button type="reset" class="btn btn-default">Reset</button>
	    </div>
	  </div>
	</form>
<?php	
			break;

		case 'delete':
			$guid = mysql_real_escape_string($_GET['guid']);
			if($guid==""){
				eksyen('','?p=program');
			}else{
				mysql_query("delete from program where guid='$guid'");
				eksyen('','?p=program');
			}
			break;
		
		default:
			# code...
			break;
	}
}
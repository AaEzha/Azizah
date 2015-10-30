<?php
if(!isset($_GET['act'])){
	if(!isset($_SESSION['asid'])){
		$_SESSION['asid'] = $_GET['asid'];
		$asid = $_SESSION['asid'];
	}else{
		$asid = $_SESSION['asid'];
	}
	
?>
	<h1>Aspect <small>| <a href="?p=aspect&act=add">Add Aspect</a></small></h1>
	<p>
		<a class="btn btn-primary">Assessment Element : <?php echo ambildata($asid,'assessment_element','ASSESSMENT_ELEMENT_NAME');?></a> 
		<a class="btn btn-warning" href="?p=assesment">Back to Assessment Element</a>
	</p>
	<div class="row">
		<div class="col-md-12">
			<?php tabel();?>
			<table class="table " id="tbl">
			  <thead>
			    <tr>
			      <th class="col-md-1 text-center">No</th>
			      <th>Assessment Aspects</th>
			      <th class="col-md-2 text-center">#</th>
			    </tr>
			  </thead>
			  <tbody>
			    <?php
			    $i = 1;
			    $qc = mysql_query("select * from assessment_aspect where assessment_element_id='$asid' order by SEQUENCE asc");
			    while($dc = mysql_fetch_array($qc)){
			    ?>
			    <tr>
			      <td class="text-center"><?php echo $dc['SEQUENCE'];?></td>
			      <td><?php echo $dc['ASSESSMENT_ASPECT_NAME'];?></td>
			      <td class="text-center">
			      	<a type="button" class="btn btn-xs btn-primary" href="?p=aspect&act=edit&guid=<?php echo $dc['GUID'];?>">Edit</a>
			      	<a type="button" class="btn btn-xs btn-danger" href="?p=aspect&act=delete&guid=<?php echo $dc['GUID'];?>" <?php yakin();?>>Delete</a>
			      </td>
			    </tr>
			    <?php } ?>
			  </tbody>
			</table>
		</div>
	</div>
<?php
}else{
	$act = $_GET['act'];
	switch ($act) {
		case 'add':
		if(isset($_POST['code'])){
			$user = $_SESSION['username'];
			$asid = $_SESSION['asid'];
			$code = mysql_real_escape_string($_POST['code']);
			$seq = mysql_real_escape_string($_POST['seq']);
			$q = mysql_query("insert into assessment_aspect(GUID,ASSESSMENT_ELEMENT_ID,ASSESSMENT_ASPECT_NAME,SEQUENCE,DTMCRT,USRCRT) values(uuid(),'$asid','$code','$seq',now(),'$user')");
			if($q){
				eksyen('','?p=aspect');
			}else{
				eksyen('Error!','?p=aspect');
			}
		}
?>
	<h1>Add Aspect <small>| <a href="?p=aspect">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Aspect Name</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="code" placeholder="Aspect Name" maxlength="255">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Sequence</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control" name="seq" placeholder="Sequence" maxlength="2" required>
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
			eksyen('','?p=aspect');
		}
		$guid = $_GET['guid'];
		$a = mysql_query("select * from assessment_aspect where guid='$guid'");
			$c = mysql_num_rows($a);
			if($c<1){
				eksyen('','?p=aspect');
			}
		$d = mysql_fetch_array($a);

		if(isset($_POST['code'])){
			$user = $_SESSION['username'];
			$code = mysql_real_escape_string($_POST['code']);
			$seq = mysql_real_escape_string($_POST['seq']);
			$asid = $_SESSION['asid'];
			$q = mysql_query("update assessment_aspect set ASSESSMENT_ASPECT_NAME='$code', SEQUENCE='$seq', DTMUPD=now(), USRUPD='$user' where GUID='$guid'");
			if($q){
				eksyen('','?p=aspect');
			}else{
				eksyen('Error!','?p=aspect');
			}
		}
?>
	<h1>Edit Aspect <small>| <a href="?p=aspect">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Aspect Name</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="code" placeholder="Aspect Name" maxlength="255" value="<?=$d['ASSESSMENT_ASPECT_NAME'];?>" required>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Sequence</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control" name="seq" placeholder="Sequence" maxlength="2" value="<?=$d['SEQUENCE'];?>" required>
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

		case 'delete':
			$guid = mysql_real_escape_string($_GET['guid']);
			if($guid==""){
				eksyen('','?p=aspect');
			}else{
				mysql_query("delete from assessment_aspect where GUID='$guid'");
				eksyen('','?p=aspect');
			}
			break;
		
		default:
			# code...
			break;
	}
}
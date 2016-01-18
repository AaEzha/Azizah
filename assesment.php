<?php
if(!isset($_GET['act'])){
	unset($_SESSION['asid']);
?>
	<h1>Assessment <small>| <a href="?p=assesment&act=add">Add Assessment</a></small></h1>
	<div class="row">
		<div class="col-md-12">
			<?php tabel();?>
			<table class="table " id="tbl">
			  <thead>
			    <tr>
			      <th class="col-md-1 text-center">No</th>
			      <th>Assessment Element</th>
			      <th class="col-md-3 text-center">Assessment Aspects</th>
			      <th class="col-md-2 text-center">#</th>
			    </tr>
			  </thead>
			  <tbody>
			    <?php
			    $i = 1;
			    $qc = mysql_query("select * from assessment_element order by SEQUENCE asc");
			    while($dc = mysql_fetch_array($qc)){
			    ?>
			    <tr>
			      <td class="text-center"><?php echo $dc['SEQUENCE'];?></td>
			      <td><?php echo $dc['ASSESSMENT_ELEMENT_NAME'];?></td>
			      <td class="text-center"><a href="?p=aspect&asid=<?php echo $dc['GUID'];?>" class="btn btn-info btn-xs btn-block">Add/Remove</a></td>
			      <td class="text-center">
			      	<a type="button" class="btn btn-xs btn-primary" href="?p=assesment&act=edit&guid=<?php echo $dc['GUID'];?>">Edit</a>
			      	<a type="button" class="btn btn-xs btn-danger" href="?p=assesment&act=delete&guid=<?php echo $dc['GUID'];?>" <?php yakin();?>>Delete</a>
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
			$code = mysql_real_escape_string($_POST['code']);
			$seq = mysql_real_escape_string($_POST['seq']);
			$q = mysql_query("insert into assessment_element(GUID,ASSESSMENT_ELEMENT_NAME,SEQUENCE,DTMCRT,USRCRT) values(uuid(),'$code','$seq',now(),'$user')");
			if($q){
				eksyen('','?p=assesment');
			}else{
				eksyen('Error!','?p=assesment');
			}
		}
?>
	<h1>Add Assessment <small>| <a href="?p=assesment">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Assessment Name</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="code" placeholder="Assessment Name" maxlength="255">
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
			eksyen('','?p=assesment');
		}
		$guid = $_GET['guid'];
		$a = mysql_query("select * from assessment_element where guid='$guid'");
			$c = mysql_num_rows($a);
			if($c<1){
				eksyen('','?p=assesment');
			}
		$d = mysql_fetch_array($a);

		if(isset($_POST['code'])){
			$user = $_SESSION['username'];
			$code = mysql_real_escape_string($_POST['code']);
			$seq = mysql_real_escape_string($_POST['seq']);
			$q = mysql_query("update assessment_element set ASSESSMENT_ELEMENT_NAME='$code', SEQUENCE='$seq', DTMUPD=now(), USRUPD='$user' where GUID='$guid'");
			if($q){
				eksyen('','?p=assesment');
			}else{
				eksyen('Error!','?p=assesment');
			}
		}
?>
	<h1>Edit Assessment <small>| <a href="?p=assesment">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Assessment Name</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="code" placeholder="Assessment Name" maxlength="255" value="<?=$d['ASSESSMENT_ELEMENT_NAME'];?>" required>
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
				eksyen('','?p=assesment');
			}else{
				mysql_query("delete from assessment_aspect where ASSESSMENT_ELEMENT_ID='$guid'");
				mysql_query("delete from assessment_element where GUID='$guid'");
				eksyen('','?p=assesment');
			}
			break;
		
		default:
			# code...
			break;
	}
}


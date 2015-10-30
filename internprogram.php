<?php
if(!isset($_GET['act'])){
?>
	<h1>Internship Program <small>| <a href="?p=internprogram&act=add">Add Program</a></small></h1>
	<div class="row">
		<div class="col-md-12">
			<?php tabel();?>
			<table class="table " id="tbl">
			  <thead>
			    <tr>
			      <th class="col-md-1 text-center">No</th>
			      <th>Internship Program</th>
			      <th class="col-md-2 text-center">#</th>
			    </tr>
			  </thead>
			  <tbody>
			    <?php
			    $i = 1;
			    $qc = mysql_query("select * from internship_program order by PROGRAM asc");
			    while($dc = mysql_fetch_array($qc)){
			    ?>
			    <tr>
			      <td class="text-center"><?=$i;?></td>
			      <td><?php echo $dc['PROGRAM'];?></td>
			      <td class="text-center">
			      	<a type="button" class="btn btn-xs btn-primary" href="?p=internprogram&act=edit&guid=<?php echo $dc['GUID'];?>">Edit</a>
			      	<a type="button" class="btn btn-xs btn-danger" href="?p=internprogram&act=delete&guid=<?php echo $dc['GUID'];?>" <?php yakin();?>>Delete</a>
			      </td>
			    </tr>
			    <?php $i++; } ?>
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
			$q = mysql_query("insert into internship_program(GUID,PROGRAM,DTMCRT,USRCRT) values(uuid(),'$code',now(),'$user')");
			if($q){
				eksyen('','?p=internprogram');
			}else{
				eksyen('Error!','?p=internprogram');
			}
		}
?>
	<h1>Add Internship Program <small>| <a href="?p=internprogram">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Program Name</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="code" placeholder="Program Name" maxlength="100" autofocus>
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
			eksyen('','?p=internprogram');
		}
		$guid = $_GET['guid'];
		$a = mysql_query("select * from internship_program where guid='$guid'");
			$c = mysql_num_rows($a);
			if($c<1){
				eksyen('','?p=internprogram');
			}
		$d = mysql_fetch_array($a);

		if(isset($_POST['code'])){
			$user = $_SESSION['username'];
			$code = mysql_real_escape_string($_POST['code']);
			$q = mysql_query("update internship_program set PROGRAM='$code', DTMUPD=now(), USRUPD='$user' where GUID='$guid'");
			if($q){
				eksyen('','?p=internprogram');
			}else{
				eksyen('Error!','?p=internprogram');
			}
		}
?>
	<h1>Edit Internship Program <small>| <a href="?p=internprogram">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Program Name</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="code" placeholder="Program Name" maxlength="100" value="<?=$d['PROGRAM'];?>" autofocus>
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
				eksyen('','?p=internprogram');
			}else{
				mysql_query("delete from internship_program where guid='$guid'");
				eksyen('','?p=internprogram');
			}
			break;
		
		default:
			# code...
			break;
	}
}
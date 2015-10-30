<?php
if(!isset($_GET['act'])){
?>
	<h1>Topic <small>| <a href="?p=topic&act=add">Add Topic</a></small></h1>
	<div class="row">
		<div class="col-md-12">
			<?php tabel();?>
			<table class="table " id="tbl">
			  <thead>
			    <tr>
			      <th class="col-md-1 text-center">No</th>
			      <th>Topic Name</th>
			      <th class="col-md-2 text-center">#</th>
			    </tr>
			  </thead>
			  <tbody>
			    <?php
			    $i = 1;
			    $qc = mysql_query("select * from master_topic order by date(dtmcrt) desc");
			    while($dc = mysql_fetch_array($qc)){
			    ?>
			    <tr>
			      <td class="text-center"><?=$i;?></td>
			      <td><?php echo $dc['TOPIC_NAME'];?></td>
			      <td class="text-center">
			      	<a type="button" class="btn btn-xs btn-primary" href="?p=topic&act=edit&guid=<?php echo $dc['GUID'];?>">Edit</a>
			      	<a type="button" class="btn btn-xs btn-danger" href="?p=topic&act=delete&guid=<?php echo $dc['GUID'];?>" <?php yakin();?>>Delete</a>
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
			$q = mysql_query("insert into master_topic(GUID,TOPIC_NAME,DTMCRT,USRCRT) values(uuid(),'$code',now(),'$user')");
			if($q){
				eksyen('','?p=topic');
			}else{
				eksyen('Error!','?p=topic');
			}
		}
?>
	<h1>Add Topic <small>| <a href="?p=topic">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Topic Name</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="code" placeholder="Topic Name" maxlength="100" autofocus>
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
			eksyen('','?p=topic');
		}
		$guid = $_GET['guid'];
		$a = mysql_query("select * from master_topic where guid='$guid'");
			$c = mysql_num_rows($a);
			if($c<1){
				eksyen('','?p=topic');
			}
		$d = mysql_fetch_array($a);

		if(isset($_POST['code'])){
			$user = $_SESSION['username'];
			$code = mysql_real_escape_string($_POST['code']);
			$q = mysql_query("update master_topic set TOPIC_NAME='$code', DTMUPD=now(), USRUPD='$user' where GUID='$guid'");
			if($q){
				eksyen('','?p=topic');
			}else{
				eksyen('Error!','?p=topic');
			}
		}
?>
	<h1>Edit Topic <small>| <a href="?p=topic">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Topic Name</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="code" placeholder="Topic Name" maxlength="100" value="<?=$d['TOPIC_NAME'];?>" autofocus>
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
				eksyen('','?p=topic');
			}else{
				mysql_query("delete from master_topic where guid='$guid'");
				eksyen('','?p=topic');
			}
			break;
		
		default:
			# code...
			break;
	}
}
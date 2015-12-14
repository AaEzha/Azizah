<?php
if(!isset($_GET['act'])){
?>
	<h1>Major <small>| <a href="?p=major&act=add">Add Major</a></small></h1>
	<div class="row">
		<div class="col-md-12">
			<?php tabel();?>
			<table class="table " id="tbl">
			  <thead>
			    <tr>
			      <th class="col-md-1 text-center">No</th>
			      <th>Major Name</th>
			      <th class="col-md-2 text-center">#</th>
			    </tr>
			  </thead>
			  <tbody>
			    <?php
			    $i = 1;
			    $qc = mysql_query("select * from major order by date(dtmcrt) desc");
			    while($dc = mysql_fetch_array($qc)){
			    ?>
			    <tr>
			      <td class="text-center"><?=$i;?></td>
			      <td><?php echo $dc['MAJOR_NAME'];?></td>
			      <td class="text-center">
			      	<a type="button" class="btn btn-xs btn-primary" href="?p=major&act=edit&guid=<?php echo $dc['GUID'];?>">Edit</a>
			      	<a type="button" class="btn btn-xs btn-danger" href="?p=major&act=delete&guid=<?php echo $dc['GUID'];?>" <?php yakin();?>>Delete</a>
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

			// filterisasi
			$b = trim($code);
		    $b = explode(" ", $b);
		    $kecil = "";
		    foreach ($b as $b){
		        $kecil .= strtolower($b);
		    }
		    
			$q = mysql_query("insert into major(GUID,MAJOR_NAME,MAJOR_NAME2,DTMCRT,USRCRT) values(uuid(),'$code','$kecil',now(),'$user')");
			if($q){
				eksyen('','?p=major');
			}else{
				eksyen('Error!','?p=major');
			}
		}
?>
	<h1>Add Major <small>| <a href="?p=major">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Major Name</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="code" placeholder="Major Name" maxlength="5">
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
			eksyen('','?p=major');
		}
		$guid = $_GET['guid'];
		$a = mysql_query("select * from major where guid='$guid'");
			$c = mysql_num_rows($a);
			if($c<1){
				eksyen('','?p=major');
			}
		$d = mysql_fetch_array($a);

		if(isset($_POST['code'])){
			$user = $_SESSION['username'];
			$code = mysql_real_escape_string($_POST['code']);
			$q = mysql_query("update major set MAJOR_NAME='$code', DTMUPD=now(), USRUPD='$user' where GUID='$guid'");
			if($q){
				eksyen('','?p=major');
			}else{
				eksyen('Error!','?p=major');
			}
		}
?>
	<h1>Edit Major <small>| <a href="?p=major">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Major Name</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="code" placeholder="Major Name" maxlength="5" value="<?=$d['MAJOR_NAME'];?>">
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
				eksyen('','?p=major');
			}else{
				mysql_query("delete from major where guid='$guid'");
				eksyen('','?p=major');
			}
			break;
		
		default:
			# code...
			break;
	}
}
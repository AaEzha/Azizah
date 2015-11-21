<?php
if(!isset($_GET['act'])){
?>
	<h1>Institute <small>| <a href="?p=institute&act=add">Add Institute</a></small></h1>
	<div class="row">
		<div class="col-md-12">
			<?php tabel();?>
			<table class="table " id="tbl">
			  <thead>
			    <tr>
			      <th class="col-md-1 text-center">No</th>
			      <th>Institute Name</th>
			      <th class="col-md-2 text-center">Nickname</th>
			      <th class="col-md-2 text-center">Type</th>
			      <th class="col-md-1 text-center">Detail</th>
			      <th class="col-md-2 text-center">#</th>
			    </tr>
			  </thead>
			  <tbody>
			    <?php
			    $i = 1;
			    $qc = mysql_query("select * from institute order by date(dtmcrt) desc");
			    while($dc = mysql_fetch_array($qc)){
			    ?>
			    <tr>
			      <td class="text-center"><?=$i;?></td>
			      <td><?php echo $dc['INSTITUTE_NAME'];?></td>
			      <td><?php echo $dc['INSTITUTE_NICK'];?></td>
			      <td><?php echo ($dc['INSTITUTE_TYPE'] == "SM") ? "Sekolah" : "Perguruan Tinggi" ;?></td>
			      <td class="text-center"><?php echo ($dc['INSTITUTE_HEAD']=="") ? "(!)":"OK";?></td>
			      <td class="text-center">
			      	<a type="button" class="btn btn-xs btn-primary" href="?p=institute&act=edit&guid=<?php echo $dc['GUID'];?>">Edit</a>
			      	<a type="button" class="btn btn-xs btn-danger" href="?p=institute&act=delete&guid=<?php echo $dc['GUID'];?>" <?php yakin();?>>Delete</a>
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
			$nick = mysql_real_escape_string($_POST['nick']);
			$type = mysql_real_escape_string($_POST['type']);
			$head = mysql_real_escape_string($_POST['head']);
			$addr = mysql_real_escape_string($_POST['addr']);
			$q = mysql_query("insert into institute(GUID,INSTITUTE_NAME,INSTITUTE_TYPE,INSTITUTE_NICK,INSTITUTE_HEAD,INSTITUTE_ADDRESS,DTMCRT,USRCRT) values(uuid(),'$code','$type','$nick','$head','$addr',now(),'$user')");
			if($q){
				eksyen('','?p=institute');
			}else{
				eksyen('Error!','?p=institute');
			}
		}
?>
	<h1>Add Institute <small>| <a href="?p=institute">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Institute Name</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control input-sm" name="code" placeholder="Institute Name" maxlength="45" required>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Institute Nickname</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control input-sm" name="nick" placeholder="Institute Nickname" maxlength="4" required>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Institute Type</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control input-sm" name="type" placeholder="SM / PT" maxlength="3" required>
	      <p class="help-block">Pilihan : SM (untuk sekolah), PT (untuk perguruan tinggi)</p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Institute Head Master</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control input-sm" name="head" placeholder="Institute Head Master" maxlength="50" >
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Institute Address</label>
	    <div class="col-sm-8">
	      <input type="text" class="form-control input-sm" name="addr" placeholder="Institute Address" >
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-success btn-sm">Save</button>
	      <button type="reset" class="btn btn-default btn-sm">Reset</button>
	    </div>
	  </div>
	</form>
<?php
			break;

		case 'edit':
		if(!isset($_GET['guid']) or $_GET['guid']==''){
			eksyen('','?p=institute');
		}
		$guid = $_GET['guid'];
		$a = mysql_query("select * from institute where guid='$guid'");
			$c = mysql_num_rows($a);
			if($c<1){
				eksyen('','?p=institute');
			}
		$d = mysql_fetch_array($a);

		if(isset($_POST['code'])){
			$user = $_SESSION['username'];
			$code = mysql_real_escape_string($_POST['code']);
			$nick = mysql_real_escape_string($_POST['nick']);
			$type = mysql_real_escape_string($_POST['type']);
			$head = mysql_real_escape_string($_POST['head']);
			$addr = mysql_real_escape_string($_POST['addr']);
			$q = mysql_query("update institute set INSTITUTE_NAME='$code', INSTITUTE_NICK='$nick', INSTITUTE_TYPE='$type', INSTITUTE_HEAD='$head', INSTITUTE_ADDRESS='$addr', DTMUPD=now(), USRUPD='$user' where GUID='$guid'");
			if($q){
				eksyen('','?p=institute');
			}else{
				eksyen('Error!','?p=institute');
			}
		}
?>
	<h1>Edit Institute <small>| <a href="?p=institute">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Institute Name</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="code" placeholder="Institute Name" maxlength="5" value="<?=$d['INSTITUTE_NAME'];?>" required>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Institute Nickname</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control input-sm" name="nick" placeholder="Institute Nickname" maxlength="4" value="<?=$d['INSTITUTE_NICK'];?>" required>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Institute Type</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control input-sm" name="type" placeholder="SM / PT" maxlength="3" value="<?=$d['INSTITUTE_TYPE'];?>" required>
	      <p class="help-block">Pilihan : SM (untuk sekolah), PT (untuk perguruan tinggi)</p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Institute Head Master</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control input-sm" name="head" placeholder="Institute Head Master" maxlength="50" value="<?=$d['INSTITUTE_HEAD'];?>">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Institute Address</label>
	    <div class="col-sm-8">
	      <input type="text" class="form-control input-sm" name="addr" placeholder="Institute Address" value="<?=$d['INSTITUTE_ADDRESS'];?>">
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
				eksyen('','?p=institute');
			}else{
				mysql_query("delete from institute where guid='$guid'");
				eksyen('','?p=institute');
			}
			break;
		
		default:
			# code...
			break;
	}
}
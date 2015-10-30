<?php
if(!isset($_GET['act'])){
?>
	<h1>Unit <small>| <a href="?p=unit&act=add">Add Unit</a></small></h1>
	<div class="row">
		<div class="col-md-12">
			<?php tabel();?>
			<table class="table " id="tbl">
			  <thead>
			    <tr>
			      <th class="col-md-1 text-center">Code</th>
			      <th class="col-md-2">Name</th>
			      <th class="col-md-4">Description</th>
			      <th class="col-md-3">Leader</th>
			      <th class="col-md-2 text-center">#</th>
			    </tr>
			  </thead>
			  <tbody>
			    <?php
			    $qc = mysql_query("select * from unit order by date(dtmcrt) desc");
			    while($dc = mysql_fetch_array($qc)){
			    	$unitid = $dc['GUID'];
			    	$qu = mysql_query("select * from unit_leader where UNIT_ID='$unitid'");
			    	$du = mysql_fetch_array($qu);
			    ?>
			    <tr>
			      <td class="text-center"><?php echo $dc['UNIT_CODE'];?></td>
			      <td><?php echo $dc['UNIT_NAME'];?></td>
			      <td><?php echo $dc['UNIT_DESC'];?></td>
			      <td><?=data_user_detail($du['USER_DETAIL_ID'],'FIRSTNAME');?> <?=data_user_detail($du['USER_DETAIL_ID'],'LASTNAME');?> (<?php echo $du['START'];?>-<?php echo $du['END'];?>)</td>
			      <td class="text-center">
			      	<a type="button" class="btn btn-xs btn-primary" href="?p=unit&act=edit&guid=<?php echo $dc['GUID'];?>">Edit</a>
			      	<a type="button" class="btn btn-xs btn-danger" href="?p=unit&act=delete&guid=<?php echo $dc['GUID'];?>" <?php yakin();?>>Delete</a>
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
			$nama = mysql_real_escape_string($_POST['nama']);
			$desc = mysql_real_escape_string($_POST['desc']);
			$leader = mysql_real_escape_string($_POST['leader']);
			$start = mysql_real_escape_string($_POST['start']);
			$end = mysql_real_escape_string($_POST['end']);
			// uuid
			$uui = mysql_query("select uuid() as uuid");
			$uuid = mysql_fetch_array($uui);
			$uuid = $uuid['uuid'];
			// end uuid
			$q = mysql_query("insert into unit(GUID,UNIT_CODE,UNIT_NAME,UNIT_DESC,DTMCRT,USRCRT) values('$uuid','$code','$nama','$desc',now(),'$user')");
			if($q){
				mysql_query("insert into unit_leader(GUID,UNIT_ID,USER_DETAIL_ID,START,END,DTMCRT,USRCRT) values(uuid(),'$uuid','$leader','$start','$end',now(),'$user')");
				mysql_query("update user_detail set UNIT_ID='$uuid' where GUID='$leader'");
				eksyen('','?p=unit');
			}else{
				eksyen('Error!','?p=unit');
			}
		}
?>
	<h1>Add Unit <small>| <a href="?p=unit">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Code</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control" name="code" placeholder="Code" maxlength="5" required>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Name</label>
	    <div class="col-sm-5">
	      <input type="text" class="form-control" name="nama" placeholder="Name" maxlength="50" required>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Description</label>
	    <div class="col-sm-5">
	      <input type="text" class="form-control" name="desc" placeholder="Description" maxlength="255">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Leader</label>
	    <div class="col-sm-5">
	      <select name="leader" id="inputLeader" class="form-control" required="required">
	      <?php
	      $q = mysql_query("select ud.guid,firstname,lastname from user_detail ud
	      					join ms_group mg
	      					join member_of_group mog
	      					on ud.guid=mog.user_detail_id
	      					and mg.guid=mog.ms_group_id
	      					where mg.group_name='LCU'
	      					and ud.guid not in(
	      						select user_detail_id from unit_leader
	      					)");
	      while($d = mysql_fetch_array($q)){ ?>
	      	<option value="<?=$d['guid'];?>"><?=$d['firstname'];?> <?=$d['lastname'];?></option>
	      <?php } ?>
	      </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Start</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control" name="start" placeholder="Year" maxlength="4" onkeypress="return isNumber(event)" required>
	    </div>
	    <label class="col-sm-1 control-label">End</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control" name="end" placeholder="Year" maxlength="4" onkeypress="return isNumber(event)" required>
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
			eksyen('','?p=unit');
		}
		$guid = $_GET['guid'];
		$a = mysql_query("select * from unit where guid='$guid'");
			$c = mysql_num_rows($a);
			if($c<1){
				eksyen('','?p=unit');
			}
		$d = mysql_fetch_array($a);

		$x = mysql_query("select * from unit_leader where unit_id='$guid'");
		$dx = mysql_fetch_array($x);
		$udi = $dx['USER_DETAIL_ID'];

		if(isset($_POST['code'])){
			$user = $_SESSION['username'];
			$code = mysql_real_escape_string($_POST['code']);
			$nama = mysql_real_escape_string($_POST['nama']);
			$desc = mysql_real_escape_string($_POST['desc']);
			$unitleader = mysql_real_escape_string($_POST['unitleader']);
			$leader = mysql_real_escape_string($_POST['leader']);
			$start = mysql_real_escape_string($_POST['start']);
			$end = mysql_real_escape_string($_POST['end']);
			$q = mysql_query("update unit set UNIT_CODE='$code', UNIT_NAME='$nama', UNIT_DESC='$desc', DTMUPD=now(), USRUPD='$user' where GUID='$guid'");
			if($q){
				mysql_query("update unit_leader set UNIT_ID='$guid', USER_DETAIL_ID='$leader', START='$start', END='$end', DTMUPD=now(), USRUPD='$user' where GUID='$unitleader'");
				mysql_query("update user_detail set UNIT_ID='$guid' where GUID='$leader'");
				eksyen('','?p=unit');
			}else{
				eksyen('Error!','?p=unit');
			}
		}
?>
	<h1>Edit Unit <small>| <a href="?p=unit">back</a></small></h1>
	<form class="form-horizontal" action="" method="post">
	  <input type="hidden" name="unitleader" id="inputUnitleader" class="form-control" value="<?=$dx['GUID'];?>">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Code</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control" name="code" placeholder="Code" maxlength="5" value="<?=$d['UNIT_CODE'];?>">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Name</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" name="nama" placeholder="Name" maxlength="50" value="<?=$d['UNIT_NAME'];?>">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Description</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" name="desc" placeholder="Description" maxlength="255" value="<?=$d['UNIT_DESC'];?>">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Leader</label>

	    <div class="col-sm-5">
	      <select name="leader" id="inputLeader" class="form-control" required="required">
	      	<option value="<?=$dx['USER_DETAIL_ID'];?>"><?=data_user_detail($udi,'FIRSTNAME');?> <?=data_user_detail($udi,'LASTNAME');?></option>
	      <?php
	      $q = mysql_query("select ud.guid,firstname,lastname from user_detail ud
	      					join ms_group mg
	      					join member_of_group mog
	      					on ud.guid=mog.user_detail_id
	      					and mg.guid=mog.ms_group_id
	      					where mg.group_name='LCU'
	      					and ud.guid not in(
	      						select user_detail_id from unit_leader
	      					)");
	      while($d = mysql_fetch_array($q)){ ?>
	      	<option value="<?=$d['guid'];?>"><?=$d['firstname'];?> <?=$d['lastname'];?></option>
	      <?php } ?>
	      </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Start</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control" name="start" placeholder="Year" maxlength="4" onkeypress="return isNumber(event)" value="<?=$dx['START'];?>" required>
	    </div>
	    <label class="col-sm-1 control-label">End</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control" name="end" placeholder="Year" maxlength="4" onkeypress="return isNumber(event)" value="<?=$dx['END'];?>" required>
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
				eksyen('','?p=unit');
			}else{
				mysql_query("delete from unit where guid='$guid'");
				eksyen('','?p=unit');
			}
			break;
		
		default:
			# code...
			break;
	}
}
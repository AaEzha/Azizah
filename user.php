<?php
if(!isset($_GET['act'])){
?>
  <h1>User <small>| <a href="?p=user&act=add">Add User</a></small></h1>
  <div class="row">
    <div class="col-md-12">
      <?php tabel();?>
      <table class="table " id="tbl">
        <thead>
          <tr>
            <th class="col-md-1 text-center">No</th>
            <th class="">Username</th>
            <th class="col-md-1 text-center">Group</th>
            <th class="col-md-1 text-center">Is Login</th>
            <th class="col-md-1 text-center">Verified</th>
            <th class="col-md-2 text-center">Last Login</th>
            <th class="col-md-2 text-center">#</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          $qc = mysql_query("select * from user");
          while($dc = mysql_fetch_array($qc)){
          ?>
          <tr>
            <td class="text-center"><?php echo $i;?></td>
            <td><?php echo $dc['USERNAME'];?></td>
            <td class="text-center"><?php echo group_name($dc['GUID'],'GROUP_NAME');?></td>
            <td class="text-center"><?=($dc['ISLOGIN']==0)?"No":"Logged";?></td>
            <td class="text-center"><?=($dc['VERIFIED']==0)?"No":"Verified";?></td>
            <td class="text-center" title="<?=$dc['LASTLOGIN'];?>"><?php echo time_ago($dc['LASTLOGIN']);?></td>
            <td class="text-center">
              <a type="button" class="btn btn-xs btn-primary" href="?p=user&act=edit&guid=<?php echo $dc['GUID'];?>">Edit</a>
              <a type="button" class="btn btn-xs btn-danger" href="?p=user&act=delete&guid=<?php echo $dc['GUID'];?>" <?=yakin();?>>Delete</a>
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
    if(isset($_POST['userid'])){
      $user = $_SESSION['username'];
      $userid = mysql_real_escape_string($_POST['userid']);
      $pw = mysql_real_escape_string($_POST['pw']);
      $grup = mysql_real_escape_string($_POST['grup']);
      $unit = mysql_real_escape_string($_POST['unit']);

      // cek unit tidak boleh kosong jika sbg LCU
      if($grup=="3c8027d0-3dcf-11e5-901c-00ff7f4e65c4"){
        if($unit==0) eksyen('Unit tidak boleh kosong jika sebagai LCU','?p=user&act=add');
      }

      // insert into user //
      mysql_query("insert into user(GUID,USERNAME,PASSWORD,DTMCRT,USRUPD,VERIFIED) values(uuid(),'$userid',md5('$pw'),now(),'$user','1')");
      $qu = mysql_query("select GUID from user where USERNAME='$userid'");
      $du = mysql_fetch_array($qu);
      $iduser = $du['GUID'];

      //eksyen($iduser,'?p=user');

      // insert into user_detail //
      mysql_query("insert into user_detail(GUID,USER_ID,UNIT_ID,FIRSTNAME,USRCRT,DTMCRT) values(uuid(),'$iduser','$unit','$userid','$user',now())");
      $qu = mysql_query("select GUID from user_detail where USER_ID='$iduser'");
      $du = mysql_fetch_array($qu);
      $iduserdetail = $du['GUID'];

      // insert into member_of_group
      mysql_query("insert into member_of_group(GUID,MS_GROUP_ID,USER_DETAIL_ID,DTMCRT,USRCRT) values(uuid(),'$grup','$iduserdetail',now(),'$user')");

      eksyen('','?p=user');
    }
?>
  <h1>Add Unit <small>| <a href="?p=user">back</a></small></h1>
  <script type="text/javascript">
    $(document).ready(function() {
	  $('#unit').hide();
      $('#inputGrup').change(function(){
        var grup = $(this).val();
        if(grup == "3c8027d0-3dcf-11e5-901c-00ff7f4e65c4"){
          $('#unit').show();
        }else{
          $('#unit').hide();
        }
      });
    });
  </script>
  <form class="form-horizontal" action="" method="post">
    <div class="form-group">
      <label class="col-sm-2 control-label">Username</label>
      <div class="col-sm-4">
        <input type="text" name="userid" id="inputUserid" class="form-control" value="" required="required" maxlength="30">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Password</label>
      <div class="col-sm-4">
        <input type="password" name="pw" id="inputPw" class="form-control" required="required" title="">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Group</label>
      <div class="col-sm-4">
        <select name="grup" id="inputGrup" class="form-control" required="required">
          <?php
          $qg = mysql_query("select GUID, GROUP_NAME from ms_group order by GROUP_NAME desc");
          while($dg = mysql_fetch_array($qg)){
          ?>
          <option value="<?=$dg['GUID'];?>"><?=$dg['GROUP_NAME'];?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group" id="unit">
      <label class="col-sm-2 control-label">Unit</label>
      <div class="col-sm-4">
        <select name="unit" id="inputUnit" class="form-control">
          <option value="0">--</option>
          <?php
          $qg = mysql_query("select * from unit");
          while($dg = mysql_fetch_array($qg)){
          ?>
          <option value="<?=$dg['GUID'];?>"><?=$dg['UNIT_CODE'];?>-<?=$dg['UNIT_NAME'];?></option>
          <?php } ?>
        </select>
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
      eksyen('Nope!','?p=user');
    }
    $guid = $_GET['guid'];

    // data user
    $a = mysql_query("select * from user where GUID='$guid'");
      $c = mysql_num_rows($a);
      if($c<1){
        eksyen('Nope! Type:2','?p=user');
      }
    $d = mysql_fetch_array($a);
    $iduser = $d['GUID'];

    // data user_detail
    $qud = mysql_query("select GUID,UNIT_ID from user_detail where USER_ID='$iduser'");
    $dud = mysql_fetch_array($qud);
    $iduserdetail = $dud['GUID'];

    // data member_of_group
    $qmog = mysql_query("select MS_GROUP_ID from member_of_group where USER_DETAIL_ID='$iduserdetail'
      ");
    $dmog = mysql_fetch_array($qmog);
    $idmog = $dmog['MS_GROUP_ID'];

    if(isset($_POST['userid'])){
      $user = $_SESSION['username'];
      $userid = mysql_real_escape_string($_POST['userid']);
      $grup = mysql_real_escape_string($_POST['grup']);
      $unit = mysql_real_escape_string($_POST['unit']);
      if($_POST['pw']!=""){
        $pw = mysql_real_escape_string($_POST['pw']);
        $q = mysql_query("update user set VERIFIED='1', USERNAME='$userid', PASSWORD=md5('$pw'), DTMUPD=now(), USRUPD='$user' where GUID='$guid'");
      }else{
        $q = mysql_query("update user set VERIFIED='1', USERNAME='$userid', DTMUPD=now(), USRUPD='$user' where GUID='$guid'");
      }
      
      if($q){
        mysql_query("update user_detail set UNIT_ID='$unit' where GUID='$iduserdetail'");
        mysql_query("update member_of_group set MS_GROUP_ID='$grup' where USER_DETAIL_ID='$iduserdetail'");
        eksyen('','?p=user');
      }else{
        eksyen('Error!','?p=user');
      }
    }
?>
  <h1>Edit Unit <small>| <a href="?p=user">back</a></small></h1>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#inputGrup').change(function(){
        var grup = $(this).val();
        if(grup == "3c8027d0-3dcf-11e5-901c-00ff7f4e65c4"){
          $('#unit').show();
        }else{
          $('#unit').hide();
        }
      });
    });
  </script>
  <form class="form-horizontal" action="" method="post">
    <div class="form-group">
      <label class="col-sm-2 control-label">Username</label>
      <div class="col-sm-4">
        <input type="text" name="userid" id="inputUserid" class="form-control" value="<?=$d['USERNAME'];?>" required="required" maxlength="30">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Password</label>
      <div class="col-sm-4">
        <input type="password" name="pw" id="inputPw" class="form-control">
        <span id="helpBlock" class="help-block">Kosongkan jika tidak ingin mengubah password.</span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Group</label>
      <div class="col-sm-4">
        <select name="grup" id="inputGrup" class="form-control" required="required">
          <?php
          $qg = mysql_query("select GUID, GROUP_NAME from ms_group");
          while($dg = mysql_fetch_array($qg)){
          ?>
          <option value="<?=$dg['GUID'];?>"<?php if($idmog==$dg['GUID']){echo " selected";} ?>><?=$dg['GROUP_NAME'];?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group" id="unit">
      <label class="col-sm-2 control-label">Unit</label>
      <div class="col-sm-4">
        <select name="unit" id="inputUnit" class="form-control">
          <option value="0">--</option>
          <?php
          $qg = mysql_query("select * from unit");
          while($dg = mysql_fetch_array($qg)){
          ?>
          <option value="<?=$dg['GUID'];?>" <?php if($dud['UNIT_ID']==$dg['GUID']) echo "selected"; ?>><?=$dg['UNIT_CODE'];?>-<?=$dg['UNIT_NAME'];?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Save & Activate</button>
        <button type="reset" class="btn btn-warning">Reset</button>
      </div>
    </div>
  </form>
<?php 
      break;

    case 'delete':
      $guid = mysql_real_escape_string($_GET['guid']);
      if($guid==""){
        eksyen('','?p=user');
      }else{
        $iduserdetail = data_user_detail_user($guid,'GUID');

        // hapus member_of_group
        mysql_query("delete from member_of_group where USER_DETAIL_ID='$iduserdetail'");
        // hapus user_education
        mysql_query("delete from user_education where USER_DETAIL_ID='$iduserdetail'");
        // hapus user_detail
        mysql_query("delete from user_detail where GUID='$iduserdetail'");
        // hapus user
        mysql_query("delete from user where GUID='$guid'");
        eksyen('','?p=user');
      }
      break;
    
    default:
      # code...
      break;
  }
}
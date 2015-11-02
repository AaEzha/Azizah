<?php
if(isset($_GET['act'])){
	$act = $_GET['act'];
	switch ($act) {
		case 'addnew':
			// UNIT_ID
			$unitid = ambildata($_SESSION['iddetail'],'user_detail','UNIT_ID');
			// UNIT_NAME
			$unitname = ambildata($unitid,'unit','UNIT_NAME');
			// INTERNSHIP ID
			$internid = getdata('internship_registration',"USER_DETAIL_ID='".$_SESSION['iddetail']."' and STATUS!='REJECTED' and STATUS!='PENDING'",'GUID');
			if(isset($_POST['judul'])){
				/*/ UNIT_ID
				$unitid = ambildata($_SESSION['iddetail'],'user_detail','UNIT_ID');
				// UNIT_NAME
				$unitname = ambildata($unitid,'unit','UNIT_NAME');*/
				
				$judul = mysql_real_escape_string($_POST['judul']);
				$pesan = mysql_real_escape_string($_POST['pesan']);

				$quid = mysql_query("select uuid() as uuid");
				$duid = mysql_fetch_array($quid);
				$uuid = $duid['uuid'];

				$q = mysql_query("insert into message(GUID,UNIT_ID,INTERN_ID,TITLE,SENDER_ID,MESSAGE_ID,MESSAGE,DTMCRT,STATUS) values('$uuid','$unitid','$internid','$judul','".$_SESSION['iddetail']."','$uuid','$pesan',now(),'Waiting reply')");
				if($q){
					eksyen('','inside.php#comment');
				}else{
					eksyen('Error!','inside.php#comment');
				}
			}
?>
			<br><h1>Kirim Pesan Baru <small>| <a href="inside.php#comment">kembali</a></small></h1>
			
			<div class="col-md-6">
				<form action="" method="POST" class="form-horizontal" role="form">
					<div class="form-group">
						<label for="inputJudul" class="col-sm-2 control-label">Judul :</label>
						<div class="col-sm-10">
							<input type="text" name="judul" id="inputJudul" class="form-control input-sm" value="" required="required" maxlength="50">
						</div>
					</div>

					<div class="form-group">
						<label for="inputPesan" class="col-sm-2 control-label">Pesan:</label>
						<div class="col-sm-10">
							<textarea name="pesan" id="inputPesan" class="form-control" required="required"></textarea>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" class="btn btn-primary btn-sm">Kirim</button>
							<button type="reset" class="btn btn-danger btn-sm">Reset</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-3">
				<div class="panel panel-primary">
					  <div class="panel-heading">
							<h3 class="panel-title">Internship Information</h3>
					  </div>
					  <div class="panel-body">
					  <?php
					  $idtopic = ambildata($internid,'internship_registration','MASTER_TOPIC_ID');
					  ?>
							<p class="text-primary">Topic : <?=ambildata($idtopic,'master_topic','TOPIC_NAME');?></p>
							<p class="text-primary">Unit : <?=$unitname;?></p>
							<p class="text-primary">Starts : <?=ambildata($internid,'internship_registration','START_DATE');?></p>
							<p class="text-primary">Ends : <?=ambildata($internid,'internship_registration','END_DATE');?></p>
					  </div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-success">
					  <div class="panel-heading">
							<h3 class="panel-title">Intern Profile</h3>
					  </div>
					  <div class="panel-body">
					  <?php
					  $ideducation = ambildata('x','user_education','EDUCATION_LEVEL_ID','USER_DETAIL_ID="'.$_SESSION['iddetail'].'"');
					  $idinstitute = ambildata('x','user_education','INSTITUTE_ID','USER_DETAIL_ID="'.$_SESSION['iddetail'].'"');
					  $idmajor = ambildata('x','user_education','MAJOR_ID','USER_DETAIL_ID="'.$_SESSION['iddetail'].'"');
					  ?>
							<p class="text-primary">Name : <?=ambildata($_SESSION['iddetail'],'user_detail','FIRSTNAME');?> <?=ambildata($_SESSION['iddetail'],'user_detail','LASTNAME');?></p>
							<p class="text-primary">Institute : <?=ambildata($idinstitute,'institute','INSTITUTE_NAME');?></p>
							<p class="text-primary">Degree : <?=ambildata($ideducation,'education_level','EDUCATION_LEVEL_NAME');?></p>
							<p class="text-primary">Major : <?=ambildata($idmajor,'major','MAJOR_NAME');?></p>
					  </div>
				</div>
			</div>
<?php			
			break;

		case 'reply':
		if(!isset($_GET['i'])){
			eksyen('Error','inside.php#comment');
		}else{
			$i = $_GET['i'];
			$q = mysql_query("select * from message where GUID='$i'");
			$d = mysql_fetch_array($q);


			// ID INTERN
			$idintern = ambildata($d['INTERN_ID'],'internship_registration','USER_DETAIL_ID');
			// UNIT_ID
			$unitid = ambildata($idintern,'user_detail','UNIT_ID');
			// UNIT_NAME
			$unitname = ambildata($unitid,'unit','UNIT_NAME');
		}
?>
			<br><h1>Balas Pesan <small>| <a href="inside.php#comment">kembali</a></small></h1>
			<div class="col-md-6">
				<form action="?p=message&act=save" method="POST" class="form-horizontal" role="form">
					<input type="hidden" name="idpesan" id="inputIdpesan" class="form-control" value="<?=$d['GUID'];?>">
					<input type="hidden" name="iduser" id="inputIduser" class="form-control" value="<?=$_SESSION['iddetail'];?>">
					<input type="hidden" name="idsender" id="inputIdsender" class="form-control" value="<?=$d['SENDER_ID'];?>">
					<input type="hidden" name="idunit" id="inputIdunit" class="form-control" value="<?=$d['UNIT_ID'];?>">
					<input type="hidden" name="idinternt" id="inputIdinternt" class="form-control" value="<?=$d['INTERN_ID'];?>">

					<div class="form-group">
						<label for="input" class="col-sm-2 control-label"></label>
						<div class="col-sm-10">
						<?php
						$qq=mysql_query("select * from message where MESSAGE_ID='$i' order by DTMCRT asc");
						while($dq=mysql_fetch_array($qq)){
						?>
							<div class="panel panel-<?php $p=($_SESSION['iddetail']==$dq['SENDER_ID']) ? "info":"warning"; echo $p; ?>">
								  <div class="panel-heading">
										<h3 class="panel-title"><?=$dq['MESSAGE'];?></h3>
								  </div>
								  <div class="panel-footer text-<?=$p;?>">
										oleh 
										<?php
										if($_SESSION['iddetail']==$dq['SENDER_ID']){
											echo "Anda,";
										}else{
										?>
										<?=ambildata($dq['SENDER_ID'],'user_detail','FIRSTNAME');?> <?=ambildata($dq['SENDER_ID'],'user_detail','LASTNAME');?>
										<?php } ?>
										pada <?=$dq['DTMCRT'];?>
								  </div>
							</div>
						<?php } ?>
						</div>
					</div>

					<div class="form-group">
						<label for="inputJudul" class="col-sm-2 control-label">Judul :</label>
						<div class="col-sm-10">
							<input type="text" name="judul" id="inputJudul" class="form-control input-sm" required="required" maxlength="50" value="Re: <?=$d['TITLE'];?>" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="inputPesan" class="col-sm-2 control-label">Pesan :</label>
						<div class="col-sm-10">
							<textarea name="pesan" id="inputPesan" class="form-control input-sm" required="required"></textarea>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" class="btn btn-primary btn-sm">Kirim</button>
							<button type="reset" class="btn btn-danger btn-sm">Reset</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-3">
				<div class="panel panel-primary">
					  <div class="panel-heading">
							<h3 class="panel-title">Internship Information</h3>
					  </div>
					  <div class="panel-body">
					  <?php
					  $idtopic = ambildata($d['INTERN_ID'],'internship_registration','MASTER_TOPIC_ID');
					  ?>
							<p class="text-primary">Topic : <?=ambildata($idtopic,'master_topic','TOPIC_NAME');?></p>
							<p class="text-primary">Unit : <?=$unitname;?></p>
							<p class="text-primary">Starts : <?=ambildata($d['INTERN_ID'],'internship_registration','START_DATE');?></p>
							<p class="text-primary">Ends : <?=ambildata($d['INTERN_ID'],'internship_registration','END_DATE');?></p>
					  </div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-success">
					  <div class="panel-heading">
							<h3 class="panel-title">Intern Profile</h3>
					  </div>
					  <div class="panel-body">
					  <?php
					  $ideducation = ambildata('x','user_education','EDUCATION_LEVEL_ID','USER_DETAIL_ID="'.$idintern.'"');
					  $idinstitute = ambildata('x','user_education','INSTITUTE_ID','USER_DETAIL_ID="'.$idintern.'"');
					  $idmajor = ambildata('x','user_education','MAJOR_ID','USER_DETAIL_ID="'.$idintern.'"');
					  ?>
							<p class="text-primary">Name : <?=ambildata($idintern,'user_detail','FIRSTNAME');?> <?=ambildata($idintern,'user_detail','LASTNAME');?></p>
							<p class="text-primary">Institute : <?=ambildata($idinstitute,'institute','INSTITUTE_NAME');?></p>
							<p class="text-primary">Degree : <?=ambildata($ideducation,'education_level','EDUCATION_LEVEL_NAME');?></p>
							<p class="text-primary">Major : <?=ambildata($idmajor,'major','MAJOR_NAME');?></p>
					  </div>
				</div>
			</div>
<?php
			break;

		case 'save':
			if(isset($_POST['judul'])){
				$judul = mysql_real_escape_string($_POST['judul']);
				$pesan = mysql_real_escape_string($_POST['pesan']);
				$idpesan = mysql_real_escape_string($_POST['idpesan']);
				$iduser = mysql_real_escape_string($_POST['iduser']);
				$idunit = mysql_real_escape_string($_POST['idunit']);
				$idinternt = mysql_real_escape_string($_POST['idinternt']);
				$idsender = mysql_real_escape_string($_POST['idsender']);

				if($iduser!=$idsender){
					$status = "Replied";
				}else{
					$status = "Waiting reply";
				}

				$q = mysql_query("insert into message(GUID,UNIT_ID,INTERN_ID,TITLE,SENDER_ID,MESSAGE_ID,MESSAGE,DTMCRT,STATUS) values(uuid(),'$idunit','$idinternt','$judul','$iduser','$idpesan','$pesan',now(),'$status')");
				if($q){
					eksyen('','inside.php#comment');
				}else{
					eksyen('Error!','inside.php#comment');
				}

			}
			break;

		
		default:
			# code...
			break;
	}
}
?>
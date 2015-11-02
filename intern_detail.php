<?php
$id = $_GET['i'];
$q = mysql_query("select * from internship_registration ir
				  join user_detail ud
				  on ud.GUID=ir.USER_DETAIL_ID
				  where ir.GUID='$id'");
$d = mysql_fetch_array($q);


$idintern = ambildata($id,'internship_registration','USER_DETAIL_ID');
$idtopic = ambildata($id,'internship_registration','MASTER_TOPIC_ID');
$ideducation = ambildata('x','user_education','EDUCATION_LEVEL_ID','USER_DETAIL_ID="'.$idintern.'"');
$idinstitute = ambildata('x','user_education','INSTITUTE_ID','USER_DETAIL_ID="'.$idintern.'"');
$idmajor = ambildata('x','user_education','MAJOR_ID','USER_DETAIL_ID="'.$idintern.'"');

?>
<br><div class="title"><h1>Detail</h1></div>

<div class="col-md-1"></div>

<div class="col-md-2">
	<div class="panel panel-info">
		<div class="panel-heading text-center">
			<h3 class="panel-title"><img src="tampil.php?u=<?=$d['USER_DETAIL_ID'];?>" width="128"></h3>
		</div>
	</div>
</div>

<div class="col-md-6">
	<table width="100%">
		<tr bgcolor="#333" height="43">
			<td width="28%"><span style="margin-left:40px;">Nama</span></td>
			<td width="77%"><span style="margin-left:60px;"><?=ambildata($idintern,'user_detail','FIRSTNAME');?> <?=ambildata($idintern,'user_detail','LASTNAME');?></span></td>
		</tr>
		<tr bgcolor="#666" height="43">
			<td width="28%"><span style="margin-left:40px;">Instansi</span></td>
			<td width="77%"><span style="margin-left:60px;"><?=ambildata($idinstitute,'institute','INSTITUTE_NAME');?></span></td>
		</tr>
		<tr bgcolor="#333" height="43">
			<td width="28%"><span style="margin-left:40px;">Jurusan</span></td>
			<td width="77%"><span style="margin-left:60px;"><?=ambildata($idmajor,'major','MAJOR_NAME');?></span></td>
		</tr>
		<tr bgcolor="#666" height="43">
			<td width="28%"><span style="margin-left:40px;">Pendidikan</span></td>
			<td width="77%"><span style="margin-left:60px;"><?=ambildata($ideducation,'education_level','EDUCATION_LEVEL_NAME');?></span></td>
		</tr>
		<tr bgcolor="#333" height="43">
			<td width="28%"><span style="margin-left:40px;">Topik</span></td>
			<td width="77%"><span style="margin-left:60px;"><?=ambildata($idtopic,'master_topic','TOPIC_NAME');?></span></td>
		</tr>
		<tr bgcolor="#666" height="43">
			<td width="28%"><span style="margin-left:40px;">Surat Pengantar</span></td>
			<td width="77%"><span style="margin-left:60px;"><a href="blob.php?i=<?=$id;?>&mime=MIME_COVER_LETTER&file=COVER_LETTER" target="_blank" class="btn btn-primary btn-xs">Download</a></span></td>
		</tr>
		<tr bgcolor="#333" height="43">
			<td width="28%"><span style="margin-left:40px;">Proposal</span></td>
			<td width="77%"><span style="margin-left:60px;"><a href="blob.php?i=<?=$id;?>&mime=MIME_PROPOSAL&file=PROPOSAL" target="_blank" class="btn btn-primary btn-xs">Download</a></span></td>
		</tr>
		<tr bgcolor="#666" height="43">
			<td width="28%"><span style="margin-left:40px;">CV</span></td>
			<td width="77%"><span style="margin-left:60px;"><a href="blob.php?i=<?=$id;?>&mime=MIME_CV&file=CV" target="_blank" class="btn btn-primary btn-xs">Download</a></span></td>
		</tr>
	</table>
</div>

<div class="col-md-3">
	<div class="panel panel-info">
		  <div class="panel-heading">
				<h3 class="panel-title">Clearance Letter</h3>
		  </div>
		  <div class="panel-body">
				<a type="button" class="btn btn-info btn-block">button</a>
		  </div>
	</div>

	<div class="panel panel-danger">
		  <div class="panel-heading">
				<h3 class="panel-title">Clearance Letter</h3>
		  </div>
		  <div class="panel-body">
				<a type="button" class="btn btn-danger btn-block">button</a>
		  </div>
	</div>

	<div class="panel panel-success">
		  <div class="panel-heading">
				<h3 class="panel-title">Achievement Letter</h3>
		  </div>
		  <div class="panel-body">
				<a type="button" class="btn btn-success btn-block">button</a>
		  </div>
	</div>

	<div class="panel panel-primary">
		  <div class="panel-heading">
				<h3 class="panel-title">Thank You Letter</h3>
		  </div>
		  <div class="panel-body">
				<a type="button" class="btn btn-primary btn-block">button</a>
		  </div>
	</div>
</div>
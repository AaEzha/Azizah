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
<style type="text/css">
	.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
}

.primary-font
{
	color: #000000;
}

.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.panel-body
{
    overflow-y: scroll;
    height: 250px;
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

</style>
<div class="title"><h1>Detail</h1></div>

<div class="col-md-3">
	<div class="panel panel-info">
		<div class="panel-heading text-center">
			<h3 class="panel-title"><img src="tampil.php?u=<?=$d['USER_DETAIL_ID'];?>" width="128"></h3>
		</div>
	</div>
	<a href="#" class="btn btn-success" title="Clearance Letter"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
			<a href="#" class="btn btn-danger" title="Rejection Letter"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
			<a href="#" class="btn btn-warning" title="Achievement Letter" disabled><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
			<a href="#" class="btn btn-info" title="Thank You Letter" disabled><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></a>
</div>

<div class="col-md-5">
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
<div class="col-md-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-comment"></span> Chat
        </div>
        <div class="panel-body">
            <ul class="chat">
        	<?php
        	$q = mysql_query("select * from message where INTERN_ID='".$_GET['i']."' order by DTMCRT desc");
        	$i = 2;
        	while($d = mysql_fetch_array($q)){ //data_user_detail($guid,$kolom)
        		$ii = $i%2;
        		if($ii=="1"){
        	?>
        		<li class="right clearfix"><span class="chat-img pull-right">
                    <img src="tampil.php?u=<?=$d['SENDER_ID'];?>" width="50" alt="<?=data_user_detail($d['SENDER_ID'],"FIRSTNAME");?>" class="img-circle" />
                </span>
                    <div class="chat-body clearfix">
                        <div>
                            <small class=" text-muted"><span class="glyphicon glyphicon-time"></span><?=time_ago($d['DTMCRT']);?></small>
                            <strong class="pull-right primary-font"><?=data_user_detail($d['SENDER_ID'],"FIRSTNAME");?> <?=data_user_detail($d['SENDER_ID'],"LASTNAME");?></strong>
                        </div>
                        <p>
                            <?=$d['MESSAGE'];?>
                        </p>
                    </div>
                </li>
        	<?php
        		}else{
			?>
				<li class="left clearfix"><span class="chat-img pull-left">
                    <img src="tampil.php?u=<?=$d['SENDER_ID'];?>" width="50" alt="<?=data_user_detail($d['SENDER_ID'],"FIRSTNAME");?>" class="img-circle" />
                </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font"><?=data_user_detail($d['SENDER_ID'],"FIRSTNAME");?> <?=data_user_detail($d['SENDER_ID'],"LASTNAME");?></strong> <small class="pull-right text-muted">
                                <span class="glyphicon glyphicon-time"></span><?=time_ago($d['DTMCRT']);?></small>
                        </div>
                        <p>
                            <?=$d['MESSAGE'];?>
                        </p>
                    </div>
                </li>
			<?php        			
        		}
        		$i++; 
        	}
        	?>
            </ul>
        </div>
        <div class="panel-footer">
        	<?php
        	if(isset($_POST['pesan']))
        	{
        		$userid = mysql_real_escape_string($_POST['userid']);
        		$pesan = mysql_real_escape_string($_POST['pesan']);
        		$internid = mysql_real_escape_string($_POST['internid']);
        		mysql_query("insert into message(GUID,INTERN_ID,SENDER_ID,MESSAGE,DTMCRT) values(uuid(),'$internid','$userid','$pesan',now())");
        		echo '<script language="javascript">location.replace("inside.php?p=intern_detail&i='.$internid.'"); </script>';
        	}
        	?>
        	<form action="" method="post">
        	<input type="hidden" name="internid" id="inputUserid" class="form-control" value="<?=$_GET['i'];?>">
        	<input type="hidden" name="userid" id="inputUserid" class="form-control" value="<?=$_SESSION['iddetail'];?>">
            <div class="input-group">
                <input id="btn-input" type="text" name="pesan" class="form-control input-sm" placeholder="Type your message here..." />
                <span class="input-group-btn">
                    <button class="btn btn-warning btn-sm" id="btn-chat">
                        Send</button>
                </span>
            </div>
            </form>
        </div>
    </div>
</div>
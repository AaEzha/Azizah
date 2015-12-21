<?php
$iduser = $_SESSION['iduser'];
tabel();
$_a = mysql_query("select * from user_detail where USER_ID='$iduser'");
$_b = mysql_fetch_array($_a);
if($_b['LASTNAME']==''){
  eksyen('Please complete your profile.','?p=profil_user');
}
?>
<!-- Start home section -->
  <div id="home">
    <!-- Start cSlider -->
    <div id="da-slider" class="da-slider">
    <div class="triangle"></div>
    <!-- mask elemet use for masking background image -->
    <div class="mask"></div>
    <!-- All slides centred in container element -->
    <div class="container">
    <!-- Start first slide -->
    <div class="da-slide">
    <div class="span5 contact-form centered">
          <h3>Welcome, <?php Print $_SESSION['firstname']; ?></h3>
            <?php
            $sesuser = $_SESSION['iddetail'];
            echo "<img width='200' height='150' src='tampil.php?u=$sesuser'>";
            ?>
          <table width="280" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td style="color:black"><?php echo "$dud[firstname] $dud[lastname]";?></td>
            </tr>
            <tr>
              <td style="color:black"><?php echo "$dud[email]";?></td>
            </tr>
          </table>
          <table width="282" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><div align="center"><a href="?p=profil_user" class="muted">edit profile</a></div></td>
              <td><div align="center"><a href="pdf/Internship_Guidance.pdf" class="muted">user guide</a></div></td>
            </tr>
          </table>
        </div>
      </div>
      </div>
      </div>
    </div>
<!-- End home section -->
<!-- Video section start -->
    <div class="section fourth-section" id="video">
        <div class="section fourth-section">
<div class="container newsletter">
                <div class="sub-section">
                    <div class="title clearfix">
                        <div class="pull-left">
                            <h3><strong>INTERNSHIP PROCESS</strong></h3>
                      </div>
                  </div>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                <table width="30%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td><div align="center"><a href="video/My_Movie.mp4" target="_blank"><img src="images/play_btn.png" width="71" height="71"></a></div></td>
                      </tr>
                    </table>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
              </div>
                <p>&nbsp;</p>
</div>

<!-- Video section end -->
<!-- Master Setting section start -->
        
<div class="section primary-section" id="mastersetting">
<div class="container">
<!-- Start title section -->
<div class="title">
<?php if($_SESSION['grup']=='ADMIN' or $_SESSION['grup']=='LCU'){ ?>
  <h1 style="color:#33c6f4">Master Setting</h1></div>
<?php }else{ ?>
  <h1 style="color:#33c6f4">Pengajuan Internship</h1></div>
<?php } ?>
<!--box menu goes here. -->
    <table width="89%" height="400" border="0" align="center" cellpadding="0" cellspacing="10">
    <?php if($_SESSION['grup']=='ADMIN'){ ?>
      <tr>
        <td width="33%" height="100" bgcolor="#0F91AC"><div align="center" class="style39"><a href="?p=user" class="style26">USER</a></div></td>
        <td width="33%" height="100" bgcolor="#15AFD0"><div align="center" class="style39"><a href="?p=unit" class="style1"><strong>UNIT</strong></a></div></td>
        <td width="33%" height="100" bgcolor="#33C6F4"><div align="center" class="style39">
          <div align="center"><a href="?p=program" class="style38 style1">PROGRAM</a></div>
        </div></td>
      </tr>
      <tr>
        <td width="33%" height="113" bgcolor="#33C6F4"><div align="center" class="style39"><a href="?p=institute" class="style38">INSTITUTE</a></div></td>
        <td width="33%" height="113" bgcolor="#89E1F3"><div align="center" class="style30"><a href="?p=major" class="style38">MAJOR</a></div></td>
        <td width="33%" height="113" bgcolor="#0F91AC"><div align="center" class="style39">
          <div align="center">
            <p><a href="?p=education-level"  class="style1"><strong>EDUCATION LEVEL</strong></a></p>
            </div>
        </div></td>
      </tr>
      <tr>
        <td width="33%" height="100" bgcolor="#0F91AC"><div align="center" class="style39"><a href="?p=topic" class="style26">TOPIC</a></div></td>
        <td width="33%" height="100" bgcolor="#15AFD0"><div align="center" class="style39"><a href="?p=internprogram" class="style1"><strong>INTERNSHIP PROGRAM</strong></a></div></td>
        <td width="33%" height="100" bgcolor="#33C6F4"><div align="center" class="style39">
          <div align="center"><a href="?p=quota" class="style38 style1">QUOTA</a></div>
        </div></td>
      </tr>
      <tr>
        <td width="33%" height="113" bgcolor="#33C6F4"><div align="center" class="style39"><a href="?p=letter" class="style38">LETTER</a></div></td>
        <td width="33%" height="113" bgcolor="#89E1F3"><div align="center" class="style30"><a href="?p=major" class="style38">xxx</a></div></td>
        <td width="33%" height="113" bgcolor="#0F91AC"><div align="center" class="style39">
          <div align="center">
            <p><a href="?p=education-level"  class="style1"><strong>xxx</strong></a></p>
            </div>
        </div></td>
      </tr>
    <?php } ?>
    <?php if($_SESSION['grup']=='LCU'){ ?>
      <tr>
        <td width="33%" height="100" bgcolor="#15AFD0"><div align="center" class="style39"><a href="?p=topic" class="style26">TOPIC</a></div></td>
        <td width="33%" height="100" bgcolor="#0F91AC"><div align="center" class="style39"><a href="?p=program" class="style26">INDUSTRY TOPIC</a></div></td>
        <td width="33%" height="100" bgcolor="#15AFD0"><div align="center" class="style39"><a href="?p=topics" class="style1"><strong>SELECT TOPIC</strong></a></div></td>
      </tr>
      <tr>
        <td width="33%" height="100" bgcolor="#89E1F3"><div align="center" class="style39">
          <div align="center"><a href="?p=quota_lcu" class="style38 style1">QUOTA</a></div>
        </div></td>
        <td width="33%" height="113" bgcolor="#33C6F4"><div align="center" class="style39"><a href="?p=institute" class="style38">INSTITUTE</a></div></td>
        <td width="33%" height="113" bgcolor="#89E1F3"><div align="center" class="style30"><a href="?p=major" class="style38">MAJOR</a></div></td>
      </tr>
    <?php } ?>
    <?php if($_SESSION['grup']=='USER'){ ?>
      <tr>
        <td colspan="3" width="100%">
        <script type="text/javascript">
          $(document).ready(function() {
            $('#fprojek').hide();
            $('#dprojek').hide();
            $('#inputProgram').change(function(){
              var grup = $(this).val();
              if(grup == "5b735728-7db6-11e5-8cd3-28d244bd1b19"){
                $('#fprojek').show();
				$('#dprojek').show();
                $('#ftopik').hide();
              }else{
                $('#fprojek').hide();
				$('#dprojek').hide();
                $('#ftopik').show();
              }
            });

            $("#inputTopik").change(function(){
                var topik = $(this).val();
                $.ajax({
                    url: "quota_get.php",
                    data: "topik="+topik,
                    cache: false,
                    success: function(msg){
                        $("#inputQuota").val(msg);
                    }
                });
            });

            $("#inputprojek").change(function(){
                var projek = $(this).val();
                $.ajax({
                    url: "quota_projek.php",
                    data: "projek="+projek,
                    cache: false,
                    success: function(msg){
                        $("#dprojek").html(msg);
                    }
                });
            });
          });
        </script>
          <p>Sebagai perusahaan yang senantiasa peduli dengan dunia pendidikan kami memberikan kesempatan bagi siswa/i tingkat SMA/SMK/SMEA/ST dan mahasiswa/i yang ingin mengikuti PKL/KP/Penelitian Skripsi/Thesis dan Magang Industri.</p>
          <p>Silahkan dilengkapi:</p>
          <?php
          $iduserdetail = $_SESSION['iddetail'];
          $qcek = mysql_query("select * from internship_registration where USER_DETAIL_ID='$iduserdetail' and STATUS='PENDING'");
          $jcek = mysql_num_rows($qcek);
          $dcek = mysql_fetch_array($qcek);
          if($jcek==1){ ?>
          <form class="form-horizontal" action="act_upd_intern.php" method="post" enctype="multipart/form-data" id="update">
            <input type="hidden" name="guid" id="inputGuid" class="form-control" value="<?=$dcek['GUID'];?>">
            <div class="form-group">
              <label for="inputProgram" class="col-sm-2 control-label">Program Internship</label>
              <div class="col-sm-5">
                <select name="program" id="inputProgram" class="form-control input-sm" required="required">
                <?php
                $app = mysql_query("select * from internship_program order by PROGRAM desc");
                while($ap = mysql_fetch_array($app)){ ?>
                  <option value="<?=$ap['GUID'];?>" <?php if($dcek['PROGRAM_ID']==$ap['GUID']) echo "selected"; ?>><?=$ap['PROGRAM'];?></option>
                <?php } ?>
                </select>
              </div>
              <label for="inputstatus" class="col-sm-1 control-label">STATUS</label>
              <div class="col-sm-2">
                <input type="text" name="status" id="inputstatus" class="form-control input-sm" value="<?=$dcek['STATUS'];?>" disabled="">
              </div>
            </div>
            <div class="form-group" id="ftopik">
              <label for="inputTopik" class="col-sm-2 control-label">Topik</label>
              <div class="col-sm-5">
                <select name="topik" id="inputTopik" class="form-control input-sm">
                  <option value="">--</option>
                <?php
                $app = mysql_query("select mt.GUID as idtopik, mt.TOPIC_NAME as namatopik from master_topic mt
                                    join selected_topic st
                                    on mt.GUID=st.MASTER_TOPIC_ID
                                    group by st.MASTER_TOPIC_ID
                                    order by TOPIC_NAME asc");
                while($ap = mysql_fetch_array($app)){ ?>
                  <option value="<?=$ap['idtopik'];?>" <?php if($dcek['MASTER_TOPIC_ID']==$ap['idtopik']) echo "selected"; ?>><?=$ap['namatopik'];?></option>
                <?php } ?>
                </select>
              </div>
              <label for="inputQuota" class="col-sm-1 control-label">Quota</label>
              <div class="col-sm-2">
                <input type="text" name="quota" id="inputQuota" class="form-control input-sm" value="" disabled="">
              </div>
            </div>
            <div class="form-group" id="fprojek">
              <label for="inputprojek" class="col-sm-2 control-label">Projek</label>
              <div class="col-sm-5">
                <select name="projek" id="inputprojek" class="form-control input-sm">
                  <option value="0">--</option>
                <?php
                $app = mysql_query("select * from program order by PROGRAM_NAME asc");
                while($ap = mysql_fetch_array($app)){ ?>
                  <option value="<?=$ap['GUID'];?>" <?php if($dcek['PROGRAM_ID']==$ap['GUID']) echo "selected"; ?>><?=$ap['PROGRAM_NAME'];?></option>
                <?php } ?>
                </select>
              </div>
			  <div id="dprojek"></div>
            </div>
            <div class="form-group">
              <label for="mulai" class="col-sm-2 control-label">Tanggal Mulai</label>
              <div class="col-sm-2">
                <input type="text" name="mulai" id="mulai" class="form-control input-sm" required="required" value="<?=$dcek['START_DATE'];?>">
              </div>
              <label for="selesai" class="col-sm-2 control-label">Tanggal Selesai</label>
              <div class="col-sm-2">
                <input type="text" name="selesai" id="selesai" class="form-control input-sm" required="required" value="<?=$dcek['END_DATE'];?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputProposal" class="col-sm-2 control-label">Proposal (PDF)</label>
              <div class="col-sm-10">
                <input type="file" name="proposal" id="inputProposal">
                <span id="helpBlock" class="help-block">Max size: 500kb</span>
              </div>
            </div>
            <div class="form-group">
              <label for="inputpengantar" class="col-sm-2 control-label">Surat Pengantar (PDF)</label>
              <div class="col-sm-10">
                <input type="file" name="pengantar" id="inputpengantar">
                <span id="helpBlock" class="help-block">Max size: 500kb</span>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="sedia" value="100" required> Saya bersedia mengikuti semua persyaratan dan ketentuan yang ada.
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info btn-lg">Submit</button>
                <button type="reset" class="btn btn-info btn-lg">Reset</button>
              </div>
            </div>
          <?php }else{ ?>
          <form class="form-horizontal" action="act_intern.php" method="post" enctype="multipart/form-data" id="insert">
            <div class="form-group">
              <label for="inputProgram" class="col-sm-2 control-label">Program Internship</label>
              <div class="col-sm-5">
                <select name="program" id="inputProgram" class="form-control input-sm" required="required">
                <?php
                $app = mysql_query("select * from internship_program order by PROGRAM desc");
                while($ap = mysql_fetch_array($app)){ ?>
                  <option value="<?=$ap['GUID'];?>"><?=$ap['PROGRAM'];?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group" id="ftopik">
              <label for="inputTopik" class="col-sm-2 control-label">Topik</label>
              <div class="col-sm-5">
                <select name="topik" id="inputTopik" class="form-control input-sm">
                  <option value="">--</option>
                <?php
                $app = mysql_query("select mt.GUID as idtopik, mt.TOPIC_NAME as namatopik from master_topic mt
                                    join selected_topic st
                                    on mt.GUID=st.MASTER_TOPIC_ID
                                    group by st.MASTER_TOPIC_ID
                                    order by TOPIC_NAME asc");
                while($ap = mysql_fetch_array($app)){ ?>
                  <option value="<?=$ap['idtopik'];?>"><?=$ap['namatopik'];?></option>
                <?php } ?>
                </select>
              </div>
              <label for="inputQuota" class="col-sm-1 control-label">Quota</label>
              <div class="col-sm-2">
                <input type="text" name="quota" id="inputQuota" class="form-control input-sm" value="" disabled="">
              </div>
            </div>
            <div class="form-group" id="fprojek">
              <label for="inputprojek" class="col-sm-2 control-label">Projek</label>
              <div class="col-sm-5">
                <select name="projek" id="inputprojek" class="form-control input-sm">
                  <option value="0">--</option>
                <?php
                $app = mysql_query("select * from program order by PROGRAM_NAME asc");
                while($ap = mysql_fetch_array($app)){ ?>
                  <option value="<?=$ap['GUID'];?>" <?php if($dcek['PROGRAM_ID']==$ap['GUID']) echo "selected"; ?>><?=$ap['PROGRAM_NAME'];?></option>
                <?php } ?>
                </select>
              </div>
			  <div id="dprojek"></div>
            </div>
            <div class="form-group">
              <label for="mulai" class="col-sm-2 control-label">Tanggal Mulai</label>
              <div class="col-sm-3">
                <input type="text" name="mulai" id="mulai" class="form-control input-sm" required="required">
              </div>
              <label for="selesai" class="col-sm-2 control-label">Tanggal Selesai</label>
              <div class="col-sm-3">
                <input type="text" name="selesai" id="selesai" class="form-control input-sm" required="required">
              </div>
            </div>
            <div class="form-group">
              <label for="inputProposal" class="col-sm-2 control-label">Proposal (PDF)</label>
              <div class="col-sm-10">
                <input type="file" name="proposal" id="inputProposal" required="required">
              </div>
            </div>
            <div class="form-group">
              <label for="inputpengantar" class="col-sm-2 control-label">Surat Pengantar (PDF)</label>
              <div class="col-sm-10">
                <input type="file" name="pengantar" id="inputpengantar" required="required">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="sedia" value="100" required> Saya bersedia mengikuti semua persyaratan dan ketentuan yang ada.
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info btn-lg">Submit</button>
                <button type="reset" class="btn btn-info btn-lg">Reset</button>
              </div>
            </div>
          <?php } ?>
          </form>
        </td>
      </tr>
    <?php } ?>
    </table>
<div align="center"></div>
</div>
</div>
<!-- Master Setting section end -->
<!-- Internship section start -->
        
<div class="section third-section" id="internship">
<div class="container">
<?php if($_SESSION['grup']=='USER'){ ?>
<!-- Start title section -->
<div class="title">
  <h1 style="color:#33c6f4">History</h1>
</div>
<table class="table table-condensed" id="tbl">
  <thead>
    <tr>
      <th class="col-md-1 text-center">No</th>
      <th class="col-md-2 text-center">Program / Instansi</th>
      <th class="col-md-2 text-center">Jurusan</th>
      <th class="col-md-2 text-center">Topik/Referensi</th>
      <th class="col-md-2 text-center">Periode</th>
      <th class="text-center">Status</th>
      <th class="col-md-1 text-center">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $i=1;
  $q = mysql_query("select * from internship_registration where USER_DETAIL_ID='".$_SESSION['iddetail']."'");
  while($d = mysql_fetch_array($q)){
    $idins = getdata('user_education',"USER_DETAIL_ID='".$_SESSION['iddetail']."'",'INSTITUTE_ID');
    $idmajor = getdata('user_education',"USER_DETAIL_ID='".$_SESSION['iddetail']."'",'MAJOR_ID');
  ?>
    <tr>
      <td class="text-center"><?=$i;?></td>
      <td class="text-center"><?=ambildata($d['EDUCATION_LEVEL_ID'],'education_level','EDUCATION_LEVEL_NAME');?> / <?=ambildata($idins,'institute','INSTITUTE_NAME');?></td>
      <td class="text-center"><?=ambildata($idmajor,'major','MAJOR_NAME');?></td>
      <td class="text-center"><?=ambildata($d['MASTER_TOPIC_ID'],'master_topic','TOPIC_NAME');?></td>
      <td class="text-center"><?=$d['START_DATE'];?>-<?=$d['END_DATE'];?></td>
      <td class="text-center"><?=$d['STATUS'];?></td>
      <td class="text-center"><a href="?p=intern_detail&i=<?=$d['GUID'];?>" class="btn btn-info btn-xs">detail</a></td>
    </tr>
  <?php $i++; } ?>
  </tbody>
</table>
<?php }else{ ?>

<div class="title">
  <h1 style="color:#135264">Internship</h1>
</div>

<p>&nbsp;</p>
<table width="49%" height="248" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td width="42%" height="117"><div align="center"><a href="?p=intern_pending" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Pengajuan','','images/pengajuan_.png',1)"><img src="images/pengajuan.png" name="Pengajuan" width="193" height="193" border="0"></a></div></td>
    <td width="15%">&nbsp;</td>
    <td width="43%"><div align="center"><a href="?p=intern" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Peserta Internship','','images/internship_.png',1)"><img src="images/internship.png" name="Peserta Internship" width="193" height="193" border="0"></a></div></td>
  </tr>
  <tr>
    <td><div align="center" class="style34"><a href="?p=intern_pending">Pengajuan Internship</a></div></td>
    <td>&nbsp;</td>
    <td><div align="center"><span class="style34"><a href="?p=intern">Peserta Internship</a></span></div></td>
  </tr>
<?php } ?>  
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div align="center"></div>
</div>
</div>
<!-- Internship section end -->

<?php if($_SESSION['grup']=='ADMIN' or $_SESSION['grup']=='LCU'){ ?>
<!-- Contact start -->
<div id="comment" class="comment">
  <div class="section third-section" style="background:#000">
    <div class="container">
      <div class="text-center">
        <h1 style="color:#05B1EB">Guestbook</h1>
      </div>
      <div class="col-md-12">
        <table class="table" id="tbl">
          <thead>
            <tr>
              <th class="col-md-1 text-center">No</th>
              <th class="col-md-2">Nama</th>
              <th class="col-md-2">Email</th>
              <th>Pesan</th>
              <th class="col-md-2 text-center">Tanggal</th>
              <th class="col-md-1 text-center">Status</th>
              <th class="col-md-1 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $qm = mysql_query("select * from guestbook order by DTMCRT desc");
            $i = 1;
            while($dm = mysql_fetch_array($qm)){ ?>
            <tr>
              <td class="text-center"><?=$i++;?></td>
              <td><?=$dm['FIRSTNAME'];?></td>
              <td><?=$dm['EMAIL'];?></td>
              <td><?=$dm['COMMENT'];?></td>
              <td class="text-center"><?=$dm['DTMCRT'];?></td>
              <td class="text-center"><?=($dm['REPLY']==1) ? "Replied":"Unreplied";?></td>
              <td class="text-center"><a href="?p=gbook&i=<?=$dm['GUID'];?>" class="btn btn-info btn-xs">balas</a></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- comment section end -->
<?php } ?>
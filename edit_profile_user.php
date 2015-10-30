<?php
include("db_connection.php"); 

          session_start();
              $user = $_SESSION['username'];
              

$result = mysql_query("SELECT FIRSTNAME, LASTNAME, ID_CARD, NIM_NIS, EMAIL, PLACE_OF_BIRTH, DATE_OF_BIRTH, GENDER, USER_ADDRESS, HOBBY, PHONE1, PHONE2, ABOUT_ME, CV, PHOTO FROM user_detail as ud JOIN user as u ON ud.user_id = u.guid WHERE username = '$user'");

if($result === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{
    $firstname = $row['FIRSTNAME'];
    $lastname = $row['LASTNAME'];
    $idcard = $row['ID_CARD'];
    $nim_nis = $row['NIM_NIS'];
    $email = $row['EMAIL'];
    $pob = $row['PLACE_OF_BIRTH'];
    $dop = $row['DATE_OF_BIRTH'];
    $gender = $row['GENDER'];
    $user_address = $row['USER_ADDRESS'];
    $hobby = $row['HOBBY'];
    $phone1 = $row['PHONE1'];
    $phone2= $row['PHONE2'];
    $aboutme = $row['ABOUT_ME'];
    $cv = $row['CV'];
    $photo = $row['PHOTO'];

}
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Profile</title>
        <!-- Bootstrap CSS and bootstrap datepicker CSS used for styling the demo pages-->
        <link rel="stylesheet" href="css/datepicker.css">
        <link rel="stylesheet" href="css/bootstrap.css">

        <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="css/style.css" />

        <!-- Load css styles -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="css/style - Copy.css" />
        <link rel="stylesheet" type="text/css" href="css/imas.css" />
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="css/imas-ie7.css" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="css/jquery.cslider.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css" />
        <link rel="stylesheet" type="text/css" href="css/animate.css" />
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57.png">
       <script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<style type="text/css">
<!--
.style64 {font-size: 10px}
.style65 {color: #FFFFFF}
.style66 {
	font-size: 18px;
	font-weight: bold;
}
.style70 {font-size: 16px; font-weight: bold; color: #FFFFFF; }
-->
        </style>
    <script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>
    
<body onLoad="MM_preloadImages('images/print_.png'); myFunctionHide()">

  <script>
function myFunctionHide() {
    document.getElementById("sinstitue").style.visibility = "Hidden";
    document.getElementById("smajor").style.visibility = "Hidden";
    document.getElementById("year").style.visibility = "Hidden";
    document.getElementById("btnAdd").style.visibility = "Hidden";
}

function myFunctionShow() {
    document.getElementById("sinstitue").style.visibility = "visible";
    document.getElementById("smajor").style.visibility = "visible";
    document.getElementById("year").style.visibility = "visible";
    document.getElementById("btnAdd").style.visibility = "visible";
}
</script>

<div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a href="#" class="brand">
                    <img src="images/logo.png" width="100%" height="100%" alt="Logo" />
                        <!-- This is website logo -->
                    </a>
                    <!-- Navigation button, visible on small resolution -->
<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-menu"></i>
                  </button>
                    <!-- Main navigation -->
                    <div class="nav-collapse collapse pull-right">
                        <ul class="nav" id="top-navigation">
                            <li class="active"><a href="#home">Home</a></li>
 							<li><a href="#video">Internship Process</a></li>
                            <li><a href="#pengajuan">Pengajuan</a></li>
                            <li><a href="#history">History</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="proses_logout.php">Sign Out</a></li>                      </ul>
                    </div>
                    <!-- End main navigation -->
                </div>
          </div>
</div>
                     <!-- Edit Profile section start -->
<div id="register">
            <div class="section third-section">
          <div class="container">
            <div class="title">
              <h1>Edit Profile</h1>
              <p>Mahasiswa/Siswa</p>
            </div>
            <form action="proses_update.php" method="post" enctype="multipart/form-data">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="316" bgcolor="#333333"><table width="95%" height="409" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="43" colspan="6" valign="bottom" style="color:#FFFFFF"><span class="style66"> DATA DIRI</span></td>
                      <td width="33%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="20" colspan="7" valign="bottom" style="color:#FFFFFF"><hr noshade="noshade" /></td>
                    </tr>
                    <tr>
                      <td width="4%">&nbsp;</td>
                      <td width="13%"style="color:#FFFFFF">Nama Depan</td>
                      <td><?php echo "<input name='txt_first_name' type='text' id='txt_first_name' size='184' value='$firstname' required>" ?></td>
                      <td>&nbsp;</td>
                      <td><span class="style65">Nama Belakang</span></td>
                      <td><?php echo"<input name='txt_last_name' type='text' id='txt_last_name' size='184' value='$lastname'required>" ?>
                      </td>
                      <td rowspan="10"><table width="66%" border="0" align="center" cellpadding="0" cellspacing="0">
                        
                      </td>
                       
                        <tr>
                          <td><div align="center"><?php
                        print "<img width='200' height='150' src='tampil.php?u=$user'>"; ?>
                        </div></td>
                        </tr>
                        <tr>
                          <td><div align="center"><span style="color:#FFFFFF;font-size:9px;vertical-align:text-top">*) Maks. 500 Kb</span></div></td>
                        </tr>
                        <tr>
                          <td><div align="center"style="color:#FFFFFF"><strong>
                            <?php echo $firstname. " ". $lastname ?>
                          </strong></div></td>
                        </tr>
                        <tr>
                          <td>
                          <?php echo "<input type='file' name='file_photo' id='file_photo' value=''/>" ?>
                        </td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td style="color:#FFFFFF">No. KTP</td>
                      <td colspan="4">
                        <?php echo "<input name='txt_id_card' type='text' id='txt_id_card' size='184' value='$idcard' required>" ?>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td style="color:#FFFFFF">NIS/NIM</td>
                      <td colspan="4">
                        <?php echo " <input name='txt_nis_nim' type='text' id='txt_nis_nim' size='184' value='$nim_nis' required>" ?>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td style="color:#FFFFFF">Tempat Lahir</td>
                      <td width="20%"><?php echo "<input name='txt_place_of_birth' type='text' id='txt_place_of_birth' size='184' value='$pob' required>" ?></td>
                      <td width="2%">&nbsp;</td>
                      <td width="9%" style="color:#FFFFFF">Tanggal Lahir</td>
                      <td width="19%"><?php echo "<input name='txt_date_of_birth' type='text' id='takedate' size='184' value='$dop' onkeydown='return false' required>" ?></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td style="color:#FFFFFF">Alamat</td>
                      <td colspan="4"><span class="style1">
                        <?php echo "<input name='txt_user_address' type='text' id='txt_user_address' size='184' value='$user_address'  required>" ?>
                      </span></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td style="color:#FFFFFF">Jenis kelamin</td>
                      <td colspan="4"><span class="style1 style65">
                        <?php if($gender == "L")
                    {
                      echo "<input type='radio' name='gender' value='Laki-Laki' id='gender' style='vertical-align:middle;' checked> Laki-Laki 
                            <input type='radio' name='gender' value='Perempuan' id='gender' style='vertical-align:middle;'> Perempuan ";
                    }
                    else
                            {
                                echo "<input type='radio' name='gender' value='Laki-Laki' id='gender' style='vertical-align:middle;'> Laki-Laki  
                                      <input type='radio' name='gender' value='Perempuan' id='gender' checked style='vertical-align:middle;'> Perempuan ";
                            }
                            ?></span></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td style="color:#FFFFFF">E-Mail</td>
                      <td colspan="4"><?php echo "<input name='txt_email' type='text' id='txt_email' size='184' value='$email' required>" ?></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td style="color:#FFFFFF">Password</td>
                      <td colspan="4"><input type="password" name="textfield8" id="textfield8" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td style="color:#FFFFFF">Telepon 1</td>
                      <td><?php echo "<input name='txt_phone1' type='text' id='txt_phone1' size='184' value='$phone1' required>" ?></td>
                      <td><div align="center"></div></td>
                      <td style="color:#FFFFFF">Telepon 2</td>
                      <td><?php echo "<input name='txt_phone2' type='text' id='txt_phone2' value='$phone2' size='184'>" ?></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td style="color:#FFFFFF">Hobi</td>
                      <td colspan="4"><span class="style1">
                        <?php echo "<input name='txt_hobby' type='text' id='txt_hobby' size='184' value='$hobby' >" ?>
                      </span></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="106" bgcolor="#666666">
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="50%" height="44" valign="bottom" style="color:#FFFFFF"><span class="style66">PENDIDIKAN</span></td>
                      <td width="50%" valign="bottom" style="color:#FFFFFF"><span class="style66">TRAINING/PELATIHAN</span></td>
                    </tr>
                    <tr>
                      <td height="44" valign="bottom" style="color:#FFFFFF"><hr noshade="noshade" /></td>
                      <td valign="bottom" style="color:#FFFFFF"><hr noshade="noshade" /></td>
                    </tr>
                    <tr>
                      <td valign="top"><p><a href="#" style="color:#FFFFFF" onmouseover= style="color:#33c6f4" onmouseout= style="color:#FFFFFF" onclick="myFunctionShow()">+ Tambah Pendidikan</a></p>
                        <table width="41%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><div align="right">
                              <span class="style70">
                                <select id="institute" name="institute" onChange="onChange()">
                      <?php
 $fya=mysql_query("SELECT institute_name FROM institute");
                    while ($row=mysql_fetch_array($fya)){
                    $ala=$row["institute_name"];
          echo "<option value=\"$ala\">$ala</option>";
          } ?>
                      </select>
                              </span>

                              <span class="style70">
                                <select id="major" name="major" onChange="onChange()">
                      <?php
 $fya=mysql_query("SELECT major_name FROM major");
                    while ($row=mysql_fetch_array($fya)){
                    $ala=$row["major_name"];
          echo "<option value=\"$ala\">$ala</option>";
          } ?>
                    </select>
                              </span>
                              <span class="style70"><input type="text" id="year" name="year" Placeholder="Tahun Lulus">
                                <button id="btnAdd" name="btnAdd" class="button button-sp">Add</button>
                                <p>&nbsp;</p>

                              </div>
                              </div></td>
                          </tr>
                        </table>
                        
                        </td>
                      <td valign="top"><p><a href="#" style="color:#FFFFFF" onmouseover= style="color:#33c6f4" onmouseout= style="color:#FFFFFF">+ Tambah Pelatihan</a></p>
                        <table width="41%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><div align="right"><span class="style70">Pelatihan12345</span><span class="style65"><br />
                              <span class="style64">PerusahaanABCD - 2012</span></span><span class="style64"><br />
                                <a href="#" style="color:#FFFFFF">sertiikat12345.jpg</a></span></div></td>
                          </tr>
                        </table>                        </td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="171" bgcolor="#333333"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="50%" style="color:#FFFFFF"><strong>ABOUT ME</strong></td>
                      <td width="50%" style="color:#FFFFFF"><strong>Curriculume Vitae</strong></td>
                    </tr>
                    <tr>
                      <td><p><span class="style1">
                        <?php echo "<input name='txt_aboutme' type='text' id='txt_aboutme' value='$aboutme' size='184'>" ?>
                      </span></p></td>
                    <td><table width="72%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="39%"><div align="center"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('upload cv','','images/upl-doc.png',1)"><img src="images/upl-doc_.png" alt="" name="upload cv" width="100" height="119" border="0" id="upload cv" /></a></div></td>
                            <td width="61%"><p>cv.doc</p>
                            <p><span style="font-size:10px;vertical-align:text-top">*) Maks. 500 Kb</span></p></td>
                        </tr>
                        </table></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="288" align="center"><p>&nbsp;</p>
                  <button name="btnCancel" class="button button-sp">Cancel</button>  
                    </span >
                    <button name="btnSave" class="button button-sp" >Save</button></td>
                </tr>
              </table>
              </form>
                  </div>
                </div>
          </div>
        </div>
        <!-- Edit profile section end -->
         <!-- Footer section start -->
<div class="footer">
            <table width="100%" height="58" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="220" rowspan="2"><div align="right"><img src="images/logo.png" width="178" height="36"></div></td>
                <td width="15" rowspan="2">&nbsp;</td>
                <td width="438" rowspan="2"><div align="left"><img src="images/logo IMAS_bg gelap.png" width="91" height="35"></div></td>
                <td width="344"><div align="right" style="color:#FFFFFF">Bahasa  <strong><a href="#" style="color:#FFFFFF">IDN</a></strong> </div></td>
                <td width="70" rowspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td><div align="right">Copyright &copy; GMFAeroAsia2015</div>
                <div align="right"></div></td>
              </tr>
            </table>
</div>
        <!-- Footer section end -->


        <!-- ScrollUp button start -->
        <div class="scrollup">
            <a href="#">
                <i class="icon-up-open"></i>
            </a>
        </div>

        <!-- ScrollUp button end -->
        <!-- Include javascript -->
        <script src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.mixitup.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/modernizr.custom.js"></script>
        <script type="text/javascript" src="js/jquery.bxslider.js"></script>
        <script type="text/javascript" src="js/jquery.cslider.js"></script>
        <script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/jquery.inview.js"></script>
        
        <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="js/respond.min.js"></script>
        <![endif]-->
<script type="text/javascript" src="js/app.js"></script>

<!-- Load jQuery and bootstrap datepicker scripts -->
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#takedate').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
        </script>
    
</body>
</html>
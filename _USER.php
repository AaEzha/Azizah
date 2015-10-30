<?php
include ("db_connection.php");

session_start();
              $user = $_SESSION['user'];

              $query = mysql_query("Select GUID from user WHERE username = '$user'");
              while($row = mysql_fetch_assoc($query)) //display all rows from query
                  {
                    $user_id = $row['GUID'];
                  }

?>

<?php
$result = mysql_query(
  "SELECT FIRSTNAME, LASTNAME, EMAIL
  FROM user_detail as ud JOIN user as u 
  ON ud.user_id = u.guid 
  WHERE username = '$user'");

if($result === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{
    $firstname = $row['FIRSTNAME'];
    $lastname = $row['LASTNAME'];
    $email = $row['EMAIL'];
}
?> 

<!DOCTYPE html>
<html lang="en">
    
    <head>
<meta charset=utf-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to Internship Management Application System</title>
        

        <!-- Bootstrap CSS and bootstrap datepicker CSS used for styling the demo pages-->
        <link rel="stylesheet" href="css/datepicker.css">
        <link rel="stylesheet" href="css/bootstrap.css">

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
.style1 {color: #FFFFFF}
.style2 {
	font-size: 18px;
	color: #FFFFFF;
}
-->
        </style>
    
    <style type="text/css">
<!--
.style54 {font-size: 14; color: #FFFFFF; }
.style58 {
	font-size: 13px;
	color: #FFFFFF;
}
.style23 {	font-size: 20px;
	font-weight: normal;
.style24 {
	font-size: 27px;
	font-weight: bold;
}
.style24 {font-weight: bold}
.style25 {	color: #000000
}
-->
        </style>
    <script type="text/javascript">
<!--
function nav(no) {
		if(no == '1'){
			document.getElementById("subnav").style.display = 'block';
			document.getElementById("subnav").style.visibility = 'visible';
		}
		if(no == '2'){
			document.getElementById("subnav1").style.display = 'block';
			document.getElementById("subnav1").style.visibility = 'visible';
		}
}
function navout(no) {
		if(no == '1'){
		document.getElementById("subnav").style.display = 'none';
		document.getElementById("subnav").style.visibility = 'hidden';
		}
		if(no == '2'){
		document.getElementById("subnav1").style.display = 'none';
		document.getElementById("subnav1").style.visibility = 'hidden';
		}
}
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
    
    <body onLoad="MM_preloadImages('images/detail2.png','images/cancel2.png','images/edit2.png')">
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
                            <li class="active" onMouseOver="nav('1')" onMouseOut="navout('1')"><a href="#">Home</a>
                            	<ul id="subnav">
                                	<li> <a href="#home" style="color:#FFFFFF">Home</a></li>
                                    <li> <a href="#video" style="color:#FFFFFF">Internship process</a></li>
                                </ul>
                          </li>  
                            <li class="active" onMouseOver="nav('2')" onMouseOut="navout('2')"><a href="#">Internship</a>
                            	<ul id="subnav1">
                                	<li> <a href="#pengajuan" style="color:#FFFFFF">Pengajuan</a></li>
                                    <li> <a href="#history" style="color:#FFFFFF">History</a></li>
                                </ul>
                          </li>  
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="proses_logout.php">Sign Out</a></li>                      </ul>
                    </div>
                    <!-- End main navigation -->
                </div>
          </div>
    </div>
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
                        <h3>Welcome, <?php Print "$user" ?><br>

                          <?php
                        print "<img width='200' height='150' src='tampil.php?u=$user'></h3>";
                        ?>
                        
                        <table width="280" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td> <?php echo  "<input name='textfield14' type='text' disabled id='textfield14' value='$firstname $lastname' style='text-align:center'/>" ?></td>
                            </tr>
                            <tr>
                              <td><input name="textfield12" type="text" disabled id="textfield15" value="Teknologi Informasi" style="text-align:center"></td>
                            </tr>
                            <tr>
                              <td><input name="textfield13" type="text" disabled id="textfield16" value="Universitas Muhammadiyah Yogyakarta" style="text-align:center"></td>
                            </tr>
                            <tr>
                              <td> <?php echo  "<input name='textfield15' type='text' disabled id='textfield17' value='$email' style='text-align:center'/>" ?> </td>
                            </tr>
                        </table>
                          <table width="282" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><div align="center"><a href="edit profile_user.php" class="muted">edit profile</a></div></td>
                              <td><div align="center"><a href="#" class="muted">user guide</a></div></td>
                            </tr>
                          </table>
                          <a href="#" class="muted"></a>  <span/> <a href="#" class="muted"></a>
                          <div id="successSend" class="alert alert-success invisible"></div>
                      </div>
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
<!-- Pengajuan Internship section start -->
<div class="section primary-section" id="pengajuan">
            <div class="container">
                <!-- Start title section -->
                <div class="title">
                    <h1>Pengajuan Internship</h1>
                    <!-- Section's title goes here -->
                  <!--Simple description for section goes here. -->
              </div>
                <div class="row-fluid">
                  <table width="94%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><p>Sebagai perusahaan yang senantiasa peduli dengan dunia pendidikan kami memberikan kesempatan bagi siswa/i tingkat SMA/SMK/SMEA/ST dan mahasiswa/i yang ingin mengikuti PKL/KP/Penelitian Skripsi/Thesis dan Magang Industri.</p>
                      <p>Silahkan dilengkapi :</p>
                      <form action="proses_internship.php" method="post" enctype="multipart/form-data">
                      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="15%"><span class="style1">Program Internship</span></td>
                          <td width="35%"><span class="style1">
                            <label for="select"></label>
                            <select name="program" id="program">
                              <option>PKL</option>
                              <option>KP</option>
                              <option>Penelitian</option>
                              <option>Magang Industri</option>
                              </select>
                          </span></td>
                          <td width="8%" rowspan="6"><span class="style1"></span><span class="style1"></span><span class="style1"></span><span class="style1"></span><span class="style1"></span><span class="style1"></span></td>
                          <td width="42%"><span class="style1"></span></td>
                        </tr>
                        <tr>
                          <td><span class="style1">Topik</span></td>
                          <td><span class="style1">
                            <select name="concern" onChange="onChange()">
                      <?php
 $fya=mysql_query("SELECT topic_name FROM master_topic");
                    while ($row=mysql_fetch_array($fya)){
                    $ala=$row["topic_name"];
          echo "<option value=\"$ala\">$ala</option>";
          } ?>
                    </select>
                          </span></td>
                          <td align="center"><span class="style2">Sisa Kapasitas</span></td>
                        </tr>
                        <tr>
                          <td><span class="style1">Tanggal Mulai </span></td>
                          <td><label for="textfield"></label>
                            <input type="text" name="txt_start_date" id="takedate_start" onkeydown="return false" required></td>
                          <td align="right"><table width="287" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="38%"><input type="text" name="textfield3" id="textfield3" disabled></td>
                              <td width="30%"><div align="center" class="style1">orang</div></td>
                              <td width="32%">&nbsp;</td>
                              <td width="32%">&nbsp;</td>
                            </tr>
                          </table>                          </td>
                        </tr>
                        <tr>
                          <td><span class="style1">Tanggal Selesai </span></td>
                          <td><span class="style1">
                            <input type="text" name="txt_end_date" id="takedate_end" onkeydown="return false" required>
                          </span></td>
                          <td><span class="style1"></span></td>
                        </tr>
                        <tr>
                          <td height="30"><span class="style1">Proposal</span></td>
                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="73%" ><span class="style1">
                              <input type="file" name="file_proposal" id="file_proposal" src="images/upl-doc_.png" required/>
                              <div style="font-size:10px;vertical-align:text-top"> *) Maks. 500 Kb</div> </span>  </td>
                            </tr>
                          </table></td>
                          <td><span class="style1"></span></td>
                        </tr>
                        <tr>
                          <td><span class="style1">Surat Pengantar </span></td>
                          <td><span class="style1">
                            <input type="file" name="file_cover_letter" id="file_cover_letter" required> <div style="font-size:10px;vertical-align:text-top"> *) Maks. 500 Kb</div>
                          </span></td>
                          <td><span class="style1"></span></td>
                        </tr>
                        <tr>
                          <td height="60" colspan="4" valign="bottom">
                            <div align="center">
                              <input type="checkbox" name="checkbox" id="checkbox">
                              <span class="style1">Saya bersedia mengikuti semua persyaratan dan ketentuan yang ada.</span><br>
                            </div>
                            <label for="checkbox"></label>
                          </td>
                        </tr>
                        <tr>
                          <td height="21" colspan="4" valign="top"><table width="288" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="288" align="center"><button class="button button-sp">Submit</button></form>
                                </span>
                                <button class="button button-sp">Reset</button></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table>
                  <div class="span4"><div class="centered service"></div>
                  </div>
                </div>
            </div>
    </div>
        <!-- Pengajuan Internship section end -->
    <!-- History section start -->
<div id="history" class="section third-section"> <!-- di ubah -->
            <div class="container">
                <div class="title">
                    <h1>History</h1> <!--field maks 10-->
              </div>
                <table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="413" align="center"><table width="327" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="14%"><div align="center"><a href="#"><img src="images/search.png" alt="" width="47" height="47"></a></div></td>
                        <td width="49%"><input type="text" name="textfield4" id="textfield4"> </td>
                      </tr>
                    </table>
                       <br>
                       <table width="984" height="326" border="1" cellpadding="0" cellspacing="0" bordercolor="#33C6F4">
                         <tr>
                           <td width="31" rowspan="2" bordercolor="#333333" bgcolor="#065671"><div align="center" class="style54"> No</div>
                               <div align="center" class="style54"></div></td>
                           <td width="79" rowspan="2" bordercolor="#333333" bgcolor="#065671"><div align="center" class="style54">Program</div>
                               <div align="center" class="style54"></div></td>
                           <td width="160" rowspan="2" bordercolor="#333333" bgcolor="#065671"><div align="center" class="style54">Instansi</div>
                               <div align="center" class="style54"></div></td>
                           <td width="145" rowspan="2" bordercolor="#333333" bgcolor="#065671"><div align="center" class="style54">Jurusan</div>
                               <div align="center" class="style54"></div></td>
                           <td width="152" rowspan="2" bordercolor="#333333" bgcolor="#065671"><div align="center" class="style54">Topik/Referensi</div>
                               <div align="center" class="style54"></div></td>
                           <td height="43" colspan="2" bordercolor="#333333" bgcolor="#065671"><div align="center" class="style54">Periode</div>
                               <div align="center" class="style54"></div></td>
                           <td width="85" rowspan="2" bordercolor="#333333" bgcolor="#065671"><div align="center" class="style54">Status</div>
                               <div align="center" class="style54"></div></td>
                           <td width="161" rowspan="2" bordercolor="#333333" bgcolor="#065671"><div align="center" class="style54">Action</div>
                               <div align="center" class="style54"></div></td>
                         </tr>
                         <tr>
                           <td width="76" height="41" bordercolor="#333333" bgcolor="#065671"><div align="center" class="style54">Start</div></td>
                           <td width="75" bordercolor="#333333" bgcolor="#065671"><div align="center" class="style54">End</div></td>
                         </tr>

                         <?php
                         $query_institute = mysql_query(
                          "SELECT ins.institute_name 
                          FROM institute ins JOIN user_education usr 
                          ON ins.guid = usr.INSTITUTE_ID 
                          WHERE usr.user_detail_id = '$user_id'");

                         $query_major = mysql_query(
                          "SELECT m.major_name 
                          FROM major m JOIN user_education u 
                          ON m.guid = u.major_id 
                          WHERE u.user_detail_id = '$user_id'");

                         $query_topic = mysql_query(
                          "SELECT mt.topic_name, ir.start_date, ir.end_date, ir.status 
                          FROM master_topic mt JOIN internship_registration ir 
                          ON mt.guid = ir.master_topic");

                         $i=1;
                       
                         while($row = mysql_fetch_array($query_institute) AND $row2 = mysql_fetch_array($query_major) AND $row3 = mysql_fetch_array($query_topic))
                         {
                          Print "<tr>";
                          Print '<td height="60" valign="middle" bordercolor="#333333" bgcolor="#FFFFFF"><div align="center">'.$i++."</div></td>";
                          Print '<td height="60" valign="middle" bordercolor="#333333" bgcolor="#FFFFFF"><div align="center">'."PKL"."</div></td>";
                          Print '<td height="60" valign="middle" bordercolor="#333333" bgcolor="#FFFFFF"><div align="center">'.$row['institute_name']."</div></td>";
                          Print '<td height="60" valign="middle" bordercolor="#333333" bgcolor="#FFFFFF"><div align="center">'.$row2['major_name']."</div></td>";
                          Print '<td height="60" valign="middle" bordercolor="#333333" bgcolor="#FFFFFF"><div align="center">'.$row3['topic_name']."</div></td>";
                          Print '<td height="60" valign="middle" bordercolor="#333333" bgcolor="#FFFFFF"><div align="center">'.$row3['start_date']."</div></td>";
                          Print '<td height="60" valign="middle" bordercolor="#333333" bgcolor="#FFFFFF"><div align="center">'.$row3['end_date']."</div></td>";
                          Print '<td height="60" valign="middle" bordercolor="#333333" bgcolor="#FFFFFF"><div align="center">'.$row3['status']."</div></td>";
                          Print '<td height="60" valign="middle" bordercolor="#333333" bgcolor="#FFFFFF"><div align="center">
                                  <a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage("detail4","","images/detail2.png",1)">
                                 <img src="images/detail1.png" name="detail4" width="100" height="20" border="0"></a>
                                 <a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage("edit","","images/edit2.png",1)">
                                <img src="images/edit1.png" name="edit" width="100" height="20" border="0"></a> 
                                <a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage("cancel2","","images/cancel2.png",1)">
                              <img src="images/cancel1.png" name="cancel2" width="100" height="20" border="0"></a>
                                 </div></td>';
                          Print "</tr>";
                         }
                         ?>
                         
                       </table></td>
                  </tr>
                  <tr>
                    <td height="30" align="center"><table width="112" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="40" valign="top"><img src="images/previous.png" width="30" height="30"></td>
                        <td width="32"><input type="text" name="textfield5" id="textfield5" disabled style="width:30px"></td>
                        <td width="40" valign="top"><div align="right"><img src="images/next.png" width="30" height="31"></div></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
  </div>
</div>
        <!-- History section end -->

 <!-- Contact section start -->
        <div id="contact" class="contact">
            <div class="section primary-section"> <!-- di ubah -->
                <div class="container">
                  <div class="title">
                    <h1>Contact Us</h1>
                      <table width="1073" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="354"><h3 class="style24"><strong>Sign the Guest Book</strong></h3></td>
                          <td width="217"><h3 class="style24"><strong>Address</strong></h3></td>
                          <td width="502" rowspan="2" align="center"><img src="images/Capture.PNG" width="452" height="331"></td>
                        </tr>
                        <tr>
                          <td>
                            <form action="proses_comment.php" method="post">
                            <table width="314" border="0" align="left" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="314"><?php echo "<input type='text' name='name' id='name' value='$user' align='middle' style='text-align:center' height='10' width='100' readonly='readonly'/>" ?>  </td>
                              </tr>
                              <tr>
                                <td><?php echo "<input type='text' name='email' id='email' value='$email' align='middle' style='text-align:center' height='10' readonly='readonly'/> "?></td>
                              </tr>
                              <tr>
                                <td><div align="left">
                                    <textarea name="comment" id="comment" style="text-align:center" placeholder="Your Comment" align="let" height="10"></textarea>
                                </div></td>
                              </tr>
                              <tr>
                                <td><div align="center"><img src="images/captcha.png" width="314" height="125"></div></td>
                              </tr>
                              <tr>
                                <td><p align="center">
                                    <button class="button button-sp"> Submit</button>
                                  </span>
                                    <button class="button button-sp"> Reset</button>
                                </p></td>
                              </tr>
                            </table>
                            </form>
                              <div align="center"></div></td>
                          <td valign="top"><h4 align="left" class="style23">PT. GMF AeroAsia</h4>
                              <p align="left" class="muted style25">Learning Services<br>
                                Material Building 2nd Floor<br>
                                Soekarno Hatta International Airport<br>
                                Cengkareng Indonesia</p>
                          <p align="left" class="muted style25">PO Box 1303</p></td>
                        </tr>
                      </table>
                  </div>
                </div>
          </div>
        </div>
        <!-- Contact section end -->
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
                
                $('#takedate_start').datepicker({
                    format: "yyyy-mm-dd"
                });  
                $('#takedate_end').datepicker({
                    format: "yyyy-mm-dd"
                });
            
            });
        </script>
    
</body>
</html>
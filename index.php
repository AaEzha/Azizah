<?php session_start();
include("db_connection.php"); 

// cek kuota per minggu
$tgl = date('d');
$bln = date('m');
$thn = date('Y');
if ($tgl>="1" and $tgl<="7") {
  $qw = "WEEK1";
  $week = "1";
} elseif ($tgl>="8" and $tgl<="14") {
  $qw = "WEEK2";
  $week = "2";
} elseif ($tgl>="15" and $tgl<="21") {
  $qw = "WEEK3";
  $week = "3";
} elseif ($tgl>="22" and $tgl<="28") {
  $qw = "WEEK4";
  $week = "4";
} elseif ($tgl>="29" and $tgl<="31") {
  $qw = "WEEK5";
  $week = "5";
}

$qk = mysql_query("select * from quota where MONTH='$bln', YEAR='$thn', ".$qw."is NULL");
$ck = mysql_num_rows($qk);
if($ck==0){
  $rk = mysql_query("select * from quota where ");
}

if(isset($_SESSION['username'])){
  header("location:inside.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset=utf-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>IMAS - Internship Management Application System</title>
        <!-- Bootstrap CSS and bootstrap datepicker CSS used for styling the demo pages-->
        <link rel="stylesheet" href="css/datepicker.css">
        <link rel="stylesheet" href="css/bootstrap.css">

        <!-- Load css styles -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="css/style - Copy.css" />
        <link rel="stylesheet" type="text/css" href="css/imas.css" />
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="css/imas-ie7.css" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="css/jquery.cslider.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css" />
        <link rel="stylesheet" type="text/css" href="css/animate.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57.png">
        <script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
        <!-- Include javascript -->
        <script src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.mixitup.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/modernizr.custom.js"></script>
        <script type="text/javascript" src="js/jquery.bxslider.js"></script>
        <script type="text/javascript" src="js/jquery.cslider.js"></script>
        <script type="text/javascript" src="js/jquery.placeholder.js"></script>
        <script type="text/javascript" src="js/jquery.inview.js"></script>
        <script type="text/javascript" src="js/isNumber.js"></script>
        <!-- Load google maps api and call initializeMap function defined in app.js 
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;callback=initializeMap"></script>-->
        <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="js/app.js"></script>
        <!-- Load jQuery and bootstrap datepicker scripts -->
        <script>
        $(function() {
          var institut = [
          <?php
          $qi = mysql_query("select * from institute order by INSTITUTE_NAME");
          while($di = mysql_fetch_array($qi)){
          ?>
            "<?=$di['INSTITUTE_NAME'];?>",
          <?php } ?>
          ];
          var jurusan = [
          <?php
          $qi = mysql_query("select * from major order by MAJOR_NAME");
          while($di = mysql_fetch_array($qi)){
          ?>
            "<?=$di['MAJOR_NAME'];?>",
          <?php } ?>
          ];
          $("#ins").autocomplete({
            source: institut
          });
          $("#inputJurusan").autocomplete({
            source: jurusan
          });

          $( "#tgl" ).datepicker({
            dateFormat: "yy-mm-dd",
            changeYear:true,
            changeMonth:true
          });
        });
        </script>
        <style type="text/css">
          <!--
          .style1 {color: #FFFFFF}
          .style23 {
          	font-size: 20px;
          	font-weight: normal;
          .style24 {
          	font-size: 27px;
          	font-weight: bold;
          }
          .style24 {font-weight: bold}
          .style25 {
          	color: #000000
          }
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
          	
          	document.getElementById("subnav").style.display = 'none';
          	document.getElementById("subnav").style.visibility = 'hidden';
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

          function nav() {
          	document.getElementById("subnav").style.display = 'block';
          	document.getElementById("subnav").style.visibility = 'visible';
          }
          function navout() {
          	document.getElementById("subnav").style.display = 'none';
          	document.getElementById("subnav").style.visibility = 'hidden';
          }
          //-->
        </script>
        

</head>
    <form action='ADMIN.php' name="admin" method='POST'>
        <input type='hidden' name='LinePerPage' id='LinePerPage' value='5'>
        <input type='hidden' name='key' id='key' value=''>
        <input type='hidden' name='rec' id='rec' value='5'>
        <input type='hidden' name='page' id='page' value='1'>
    </form>

    <body onLoad="MM_preloadImages('images/upl-photo.png','images/upl-doc.png')">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <img src="images/logo.png" width="100%" height="100%" alt="Logo" />
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right" id="top-navigation">
          <li><a href="#home">Home</a></li>
          <li><a href="#register">Register</a></li>
          <li><a href="#contact">Contact</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>    
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
                        <h2 class="fittext2">Welcome to</h2>
                        <h4>Internship Management Application System</h4>
                        <p>GMF Internship Program called is program of Corporate Sosial Responsibility (CSR) of PT. GMF AeroAsia in the field of education by providing facillities to the student to further develop the academic skills learned at collage in order to gain direct experience in the working world as well as being a great family with GMF AeroAsia.</p>
                        
                      <a href="#sign-in" class="da-link button">Sign In</a>
                  </div>
              </div>
          </div>
    </div>
    </div>
<!-- End home section -->
        <!-- Sign-in section start -->
        
<div class="section primary-section" id="sign-in">
            <div class="container">
                <!-- Start title section -->
                <div class="text-center">
                  <h1>Sign In</h1>
                    <!-- Section's title goes here -->
                  <!--Simple description for section goes here. -->
                </div>
              <div class="row-fluid">
                <form action="proses_login.php" method="post">
                <table class="table">
                  <tr>
                    <td width="265"><p align="center">Don't have an account?<br/><a href="#register" class="style1" >Sign Up Now</a></p>
                      <p align="center">
                        <input type="text" name="username" class="form-control" value="" id="username" placeholder="User ID" align="middle" style="text-align:center" required/>
                      </p>
                      <p align="center">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" align="middle" style="text-align:center" required/>
                      </p>
                      <p align="center"><a href="#" class="style1">Forgot my password</a><br>
                        <label for="checkbox"></label>
                      </p>
                    <p align="center"><button type="submit" class="button button-sp">Sign in</button></p></td>
                    <td width="677"><p align="right"><img src="images/bg-home_1.png" alt="" width="721" height="395"></p>                    </td>
                  </tr>
                </table>
                </form>
              </div>
          </div>
        </div>
        <!-- Sign-in section end -->
 <!-- Register section start -->
<div id="register" class="section primary-section">
  <div class="container">
    <div class="title">
      <h1>Register</h1>
    </div>
    <form class="form-horizontal" action="act_reg.php" method="post" id="myform" enctype="multipart/form-data">
      <div class="form-group" style="background:#333">
        <label class="col-sm-2 control-label">Nomor Identitas</label>
        <div class="col-sm-4">
          <input type="text" name="noid" id="inputNoid" class="form-control" value="" required="required">
        </div>
        <label class="col-sm-2 control-label">NIM/NIS</label>
        <div class="col-sm-4">
          <input type="text" name="nims" id="inputNims" class="form-control" value="" onkeypress="return isNumber(event)" required="required">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Nama Depan</label>
        <div class="col-sm-4">
          <input type="text" name="namadepan" id="inputNamadepan" class="form-control input-sm" value="" required="required">
        </div>
        <label class="col-sm-2 control-label">Nama Belakang</label>
        <div class="col-sm-4">
          <input type="text" name="namabelakang" id="inputNamabelakang" class="form-control input-sm" value="" required="required">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Tempat Lahir</label>
        <div class="col-sm-4">
          <input type="text" name="tempatlahir" id="inputTempatlahir" class="form-control input-sm" value="" required="required">
        </div>
        <label class="col-sm-2 control-label">Tanggal Lahir</label>
        <div class="col-sm-4">
          <input type="date" name="tanggallahir" id="tgl" class="form-control input-sm" value="" required="required" aria-describedby="helpBlock">
          <span id="helpBlock" class="help-block">Format: year-month-day</span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Jenis Kelamin</label>
        <div class="col-sm-10">
          <div class="radio">
            <label>
              <input type="radio" name="jk" id="inputJk" value="M" checked="checked">
              Laki-laki
            </label>
            &nbsp;&nbsp;
            <label>
              <input type="radio" name="jk" id="inputJk" value="F" checked="">
              Perempuan
            </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Alamat</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="alamat"></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Telepon 1</label>
        <div class="col-sm-4">
          <input type="tel" name="tel1" id="inputTel1" class="form-control input-sm" value="" required="required" title="">
        </div>
        <label class="col-sm-2 control-label">Telepon 2</label>
        <div class="col-sm-4">
          <input type="tel" name="tel2" id="inputTel2" class="form-control input-sm" value="" required="required" title="">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Email</label>
        <div class="col-sm-4">
          <input type="email" name="email" id="inputEmail" class="form-control input-sm" value="" required="required" title="">
        </div>
        <label class="col-sm-2 control-label">Hobi</label>
        <div class="col-sm-4">
          <input type="text" name="hobi" id="inputHobi" class="form-control input-sm" value="" required="required">
        </div>
      </div>
      <div class="form-group" style="background:#333">
        <label class="col-sm-2 control-label">User ID</label>
        <div class="col-sm-4">
          <input type="text" name="userid" id="inputUserid" class="form-control input-sm" value="" required="required" maxlength="30">
        </div>
      </div>
      <div class="form-group" style="background:#333">
        <label class="col-sm-2 control-label">Password</label>
        <div class="col-sm-4">
          <input type="password" name="pw1" id="password" class="form-control input-sm" required="required" title="">
        </div>
        <label class="col-sm-2 control-label">Re-password</label>
        <div class="col-sm-4">
          <input type="password" name="pw2" id="password_check" class="form-control input-sm" required="required" title="">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Jenjang Pendidikan</label>
        <div class="col-sm-4">
          <select name="jenjang" id="inputJenjang" class="form-control input-sm" required="required">
            <?php
            $qj = mysql_query("select * from education_level order by sequence asc");
            while($dj = mysql_fetch_array($qj)){
            ?>
            <option value="<?=$dj['GUID'];?>"><?=$dj['EDUCATION_LEVEL_NAME'];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <script>
      $(function() {
        
      });
      </script>
      <div class="form-group">
        <label class="col-sm-2 control-label">Instansi</label>
        <div class="col-sm-4">
          <input name="instansi" id="ins" class="form-control input-sm" required="required">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Jurusan</label>
        <div class="col-sm-4">
          <input name="jurusan" id="inputJurusan" class="form-control input-sm" required="required">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Peminatan</label>
        <div class="col-sm-4">
          <select name="minat" id="inputMinat" class="form-control input-sm" required="required">
            <?php
            $qj = mysql_query("select * from master_topic order by topic_name asc");
            while($dj = mysql_fetch_array($qj)){
            ?>
            <option value="<?=$dj['GUID'];?>"><?=$dj['TOPIC_NAME'];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Kemampuan & Pengalaman</label>
        <div class="col-sm-10">
          <textarea name="kemampuan" id="inputKemampuan" class="form-control" rows="3" required="required"></textarea>
        </div>
      </div>
      <div class="form-group" style="background:#333">
        <label class="col-sm-4 control-label">Upload Foto</label>
        <div class="col-sm-2">
          <input type="file" name="foto" required>
        </div>
        <label class="col-sm-1 control-label">Upload CV</label>
        <div class="col-sm-2">
          <input type="file" name="cv" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-12 text-center">
          Sebelum mensubmit, cek dan teliti data yang Anda isikan.<br>
          Semua data dan informasi Anda adalah benar dan dapat dipertanggungjawabkan.
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-12 text-center">
          <button type="submit" id="submit" class="btn btn-primary btn-lg">Submit</button>
          <button type="reset" class="btn btn-primary btn-lg">Reset</button>
        </div>
      </div>
    </form>
  </div>
</div>
    
        <!-- Contact section start -->
        <div id="contact" class="contact">
            <div class="section secondary-section">
                <div class="container">
                  <div class="title">
                    <h1>Contact Us</h1>
                      <div class="container row">
                        <div class="col-sm-3 text-center"><font size="5">Sign the Guest Book</font></div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3 text-center"><font size="5">Address</font></div>
                        <div class="col-sm-5"></div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <form class="form-horizontal" action="act_guestbook.php" method="post">
                              <div class="form-group">
                                <input type="text" name="yourname" id="inputYourname" class="form-control" value="" required="required" placeholder="Your Name" style="text-align:center">
                              </div>
                              <div class="form-group">
                                <input type="email" name="youremail" id="inputYouremail" class="form-control" value="" required="required" placeholder="Your Email" style="text-align:center">
                              </div>
                              <div class="form-group">
                                <textarea name="yourcomment" id="inputYourcomment" class="form-control" rows="3" required="required" placeholder="Your Comment" style="text-align:center"></textarea>
                              </div>
                              <div class="form-group">
                                <img src="images/captcha.png" width="314" height="125">
                              </div>
                              <div class="form-group">
                                <div class="col-sm-12 text-center">
                                  <button type="submit" class="btn btn-success">Submit</button>
                                  <button type="reset" class="btn btn-success">Reset</button>
                                </div>
                              </div>
                            </form>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                          <h4 align="left" class="style23">PT. GMF AeroAsia</h4>
                          <p align="left" class="muted style25">Learning Services<br>
                            Material Building 2nd Floor<br>
                            Soekarno Hatta International Airport<br>
                            Cengkareng Indonesia</p>
                          <p align="left" class="muted style25">PO Box 1303</p>
                        </div>
                        <div class="col-sm-5 text-center">
                          <img src="images/Capture.PNG" width="452" height="331">
                        </div>
                      </div>
                    </div>
                </div>
          </div>
        </div>
        <!-- Contact section edn -->
        <!-- Footer section start -->
<div class="footer">
            <table width="100%" height="58" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="220" rowspan="2"><div align="right"><img src="images/logo.png" width="178" height="36"></div></td>
                <td width="15" rowspan="2">&nbsp;</td>
                <td width="438" rowspan="2"><div align="left"><img src="images/logo IMAS_bg gelap.png" width="91" height="35"></div></td>
                <td width="344"><div align="right">Bahasa  <strong><a href="#">IDN</a></strong> </div></td>
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



</body>
</html>
        
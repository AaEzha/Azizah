<?php
session_start();
include("db_connection.php");

?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset=utf-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IMAS - Internship Management Application System</title>
        <!-- Load css styles -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="css/style - Copy.css" />
        <link rel="stylesheet" type="text/css" href="css/imas.css" />
        <link href="css/datatables.bootstrap.css" rel="stylesheet">
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
        <style type="text/css">
          <!--
          .style1 {color: #FFFFFF}
          .style26 {color: #FFFFFF; font-weight: bold; }
          .style30 {
            color: #000000;
            font-size: 24px;
          }
          .style5 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #000000; }
          .style34 {color: #135264; font-size: 18px;}
          .style35 {font-size: 16px}
          .style36 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #000000; font-size: 16px; }
          .style38 {
            color: #000000;
            font-weight: bold;
          }
          .style39 {color: #FFFFFF; font-size: 24px; }
          -->
        </style>
        <script type="text/javascript">
          <!--
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

          function nav() {
            document.getElementById("subnav").style.display = 'block';
            document.getElementById("subnav").style.visibility = 'visible';
          }
          function navout() {
            document.getElementById("subnav").style.display = 'none';
            document.getElementById("subnav").style.visibility = 'hidden';
          }
          function MM_swapImgRestore() { //v3.0
            var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
          }
          function MM_swapImage() { //v3.0
            var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
             if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
          }

           function submit(action){
                      document.forms[0].action=action;
                      document.forms[0].submit();
                    }
          //-->
        </script>
        <!-- Include javascript -->
        <script src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.mixitup.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script src="js/jquery.dataTables.js"></script>
        <script src="js/dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="js/modernizr.custom.js"></script>
        <script type="text/javascript" src="js/jquery.bxslider.js"></script>
        <script type="text/javascript" src="js/jquery.cslider.js"></script>
        <script type="text/javascript" src="js/jquery.placeholder.js"></script>
        <script type="text/javascript" src="js/jquery.inview.js"></script>
        <script type="text/javascript" src="js/isNumber.js"></script>
        <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="js/app.js"></script>
</head>
    
<body onLoad="MM_preloadImages('images/upl-photo.png','images/upl-doc.png','images/internship_.png','images/pengajuan_.png')">

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
        <li><a href="index.php">Home</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>

<div class="section aaezha" id="mastersetting">
<div class="container">

<?php
if(isset($_POST['email']))
{
	$email = mysql_real_escape_string($_POST['email']);
	$id = mysql_real_escape_string($_POST['code']);
	$pass = mysql_real_escape_string($_POST['pass']);
	$md5pass = md5($pass);

	// cek
	$q = mysql_query("select USER_ID,FIRSTNAME,LASTNAME from user_detail where EMAIL='$email' and ID_CARD='$id' or EMAIL='$email' and NIM_NIS='$id' or EMAIL='$email' and PHONE1='$id' or EMAIL='$email' and PHONE2='$id'");
	$qj = mysql_num_rows($q);
	$qd = mysql_fetch_array($q);
	if($qj>=1)
	{
		// ubah passwordnya
		$userid = $qd['USER_ID'];
		mysql_query("update user set password='$md5pass' where GUID='$userid'");
		// info untuk email
		$_SESSION['emailnya'] = $email;
		$_SESSION['namanya'] = $qd['FIRSTNAME'] ." ".$qd['LASTNAME'];
		$_SESSION['passwordnya'] = $pass;
		include 'email/forget.php';
		eksyen('Check your email!','index.php');
	}else{
		eksyen('Wrong account!','index.php');
	}
}
?>

	<h1>Forget your password</h1>
	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Your Email</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="email" placeholder="e.g: youremail@email.com" maxlength="100" required>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Your ID/NIS/Phone Number</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="code" placeholder="Your ID/NIS/Phone Number" maxlength="32" required>
	      <p class="help-text">Pick one of those choices.</p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Your New Password</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="pass" placeholder="Your New Password" maxlength="20" required>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-success">Save</button>
	      <button type="reset" class="btn btn-warning">Reset</button>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-success">Save</button>
	      <button type="reset" class="btn btn-warning">Reset</button>
	    </div>
	  </div>
	</form>


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
</body>
</html>
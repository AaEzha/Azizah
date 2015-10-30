<?php
include("db_connection.php"); 

session_start();
              $user = $_SESSION['user'];
              $user_id = $_SESSION['user_id'];

              $query = mysql_query("Select GUID from user WHERE username = '$user'");
              while($row = mysql_fetch_assoc($query)) //display all rows from query
                  {
                    $user_id = $row['GUID'];
                  }
?>

<?php
$query_select_comment = mysql_query(
  "SELECT ud.FIRSTNAME as FIRSTNAME, ud.LASTNAME as LASTNAME, ud.EMAIL as EMAIL, unit.unit_code as UNIT_CODE, unit.unit_name as UNIT_NAME
  FROM user_detail as ud JOIN user as u INNER JOIN unit as unit
  ON ud.user_id = u.guid and unit.guid = ud.unit_id
  WHERE u.username = '$user'");

if($query_select_comment === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($query_select_comment))
{
    $firstname = $row['FIRSTNAME'];
    $lastname = $row['LASTNAME'];
    $email = $row['EMAIL'];
	$unit_code = $row['UNIT_CODE'];
    $unit_name = $row['UNIT_NAME'];
}
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
</head>
    
<body onLoad="MM_preloadImages('images/upl-photo.png','images/upl-doc.png','images/internship_.png','images/pengajuan_.png')">
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
                          <li class="active" onMouseOver="nav()" onMouseOut="navout()"><a href="#home">Home</a>
                            	<ul id="subnav">
                                	<li> <a href="#home" style="color:#FFFFFF">Home</a></li>
                                    <li> <a href="#video" style="color:#FFFFFF">Internship Process</a></li>
                                </ul>
                          </li>  
                            <li><a href="#mastersetting">Master Setting</a></li>
                            <li><a href="#internship">Internship</a></li>
                            <li><a href="#comment">Comment</a></li>
                            <li><a href="proses_logout.php">Sign Out</a></li>
                        </ul>
                    </div>
                </div>
          </div>
</div><!-- End main navigation -->
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
							<td> <?php echo "<input name='textfield14' type='text' disabled id='textfield14' value='$firstname $lastname' style='text-align:center'> "?></td>
						</tr>
						<tr>
							<td> <?php echo "<input name='textfield14' type='text' disabled id='textfield14' value='$unit_code - $unit_name' style='text-align:center'> "?></td>
						</tr>
                        <tr>
							<td><?php echo "<input name='textfield15' type='text' disabled id='textfield17' value='$email' style='text-align:center'>" ?></td>
                        </tr>
					</table>
                    <table width="282" border="0" cellspacing="0" cellpadding="0">
                        <tr><td><div align="center"><a href="edit profile_user.php" class="muted">edit profile</a></div></td>
                        <td><div align="center"><a href="#" class="muted">user guide</a></div></td>
                        </tr>
                    </table>
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
                        <td><div align="center"><!--<a href="video/My_Movie.mp4" target="_blank"><img src="images/play_btn.png" width="71" height="71"></a>--><video src="video/My_Movie.mp4" autoplay="false" width="100%"></video></div></td>
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
	<h1 style="color:#33c6f4">Master Setting</h1></div>
<!--box menu goes here. -->
<table width="89%" height="400" border="0" align="center" cellpadding="0" cellspacing="10">
  <tr>
    <td width="33%" height="100" bgcolor="#0F91AC"><div align="center" class="style39"><a href="#" onclick="submit('admin_user.php')" class="style26">TOPIC</a></div></td>
    <td width="33%" height="100" bgcolor="#15AFD0"><div align="center" class="style39"><a href="#" onclick="submit('admin_unit.php')" class="style1"><strong>ASSESMENT</strong></a></div></td>
    <td width="33%" height="100" bgcolor="#33C6F4"><div align="center" class="style39">
      <div align="center"><a href="#" onclick="submit('admin_program.php')" class="style38 style1">MESSAGE</a></div>
    </div></td>
    </tr>

    <?php
      $key='';
      $rec=5;
      $page= 1;
      $pagenum=0;

        if (mysql_real_escape_string($_POST['key']) !='' || mysql_real_escape_string($_POST['key'])  != null){
            $key=mysql_real_escape_string($_POST['key']) ;
           
        }
        if (mysql_real_escape_string($_POST['rec'])  !='' || mysql_real_escape_string($_POST['rec']) != null){
            $rec=mysql_real_escape_string($_POST['rec']);
          
        }
        if (mysql_real_escape_string($_POST['page']) !='' || mysql_real_escape_string($_POST['page']) != null){
           $page= mysql_real_escape_string($_POST['page']); 
           $pagenum=(mysql_real_escape_string($_POST['page'])-1)*$rec;         
        }

        $pagerow=mysql_real_escape_string($_POST['LinePerPage']);
       
        $query_count_data = mysql_query("SELECT COUNT(*) as SUM, COMMENT FROM comment  WHERE FIRSTNAME LIKE '%{$key}%' OR EMAIL LIKE '%{$key}%' OR COMMENT LIKE '%{$key}%'");
        while($row = mysql_fetch_array($query_count_data)){
          $sum = $row['SUM'];

          if($sum % $pagerow == 0){
            $result = $sum/$pagerow;
          }
          else {
            $c = $sum % $pagerow;
            $result = (($sum - $c)/$pagerow)+1;
          }
        }
        ?>

    <form  method='POST'>
        <input type='hidden' name='LinePerPage' id='LinePerPage' value='5'>
        <input type='hidden' name='key' id='key' value=''>
        <input type='hidden' name='rec' id='rec' value='5'>
        <input type='hidden' name='page' id='page' value='1'>
   <!--  </form>

    <form action='Admin_Institute.php' name="admin_institute" method='POST'>
        <input type='hidden' name='LinePerPage' id='LinePerPage' value='5'>
        <input type='hidden' name='key' id='key' value=''>
        <input type='hidden' name='rec' id='rec' value='5'>
        <input type='hidden' name='page' id='page' value='1'>
    </form>

    <form action='Admin_Major.php' name="admin_major" method='POST'>
        <input type='hidden' name='LinePerPage' id='LinePerPage' value='5'>
        <input type='hidden' name='key' id='key' value=''>
        <input type='hidden' name='rec' id='rec' value='5'>
        <input type='hidden' name='page' id='page' value='1'>
    </form>

    <form action='Admin_Education_Level.php' name="admin_education_level" method='POST'>
        <input type='hidden' name='LinePerPage' id='LinePerPage' value='5'>
        <input type='hidden' name='key' id='key' value=''>
        <input type='hidden' name='rec' id='rec' value='5'>
        <input type='hidden' name='page' id='page' value='1'>
    </form>

    <form action='Admin_Unit.php' name="admin_unit" method='POST'>
        <input type='hidden' name='LinePerPage' id='LinePerPage' value='5'>
        <input type='hidden' name='key' id='key' value=''>
        <input type='hidden' name='rec' id='rec' value='5'>
        <input type='hidden' name='page' id='page' value='1'>
    </form>

    <form action='Admin_Program.php' name="admin_program" method='POST'>
        <input type='hidden' name='LinePerPage' id='LinePerPage' value='5'>
        <input type='hidden' name='key' id='key' value=''>
        <input type='hidden' name='rec' id='rec' value='5'>
        <input type='hidden' name='page' id='page' value='1'>
    </form> -->



  <tr>
    <td width="33%" height="113" bgcolor="#33C6F4"><div align="center" class="style39"><a href="#" onclick="submit('admin_institute.php')" class="style38">INSTITUTE</a></div></td>
    <td width="33%" height="113" bgcolor="#89E1F3"><div align="center" class="style30"><a href="#" onclick="submit('admin_major.php')" class="style38">MAJOR</a></div></td>
    <td width="33%" height="113" bgcolor="#0F91AC"><div align="center" class="style39">
      <div align="center">
        <p><a href="#" onclick="submit('admin_education_level.php')"  class="style1"><strong>LETTER</strong></a></p>
        </div>
    </div></td>
    </tr>
</table>
<div align="center"></div>
</div>
</div>
<!-- Master Setting section end -->
<!-- Internship section start -->
        
<div class="section primary-section" id="internship" style="background-color:#CCCCCC">
<div class="container">
<!-- Start title section -->
<div class="title">
	<h1 style="color:#135264">Internship</h1></div>
<p>
  <!--box menu goes here. -->
</p>
<p>&nbsp;</p>
<table width="49%" height="248" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="42%" height="117"><div align="center"><a href="Admin_Pengajuan_Internship.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Pengajuan','','images/pengajuan_.png',1)"><img src="images/pengajuan.png" name="Pengajuan" width="193" height="193" border="0"></a></div></td>
    <td width="15%">&nbsp;</td>
    <td width="43%"><div align="center"><a href="Admin_Peserta_Internship.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Peserta Internship','','images/internship_.png',1)"><img src="images/internship.png" name="Peserta Internship" width="193" height="193" border="0"></a></div></td>
	<td width="15%">&nbsp;</td>
    <td width="43%"><div align="center"><a href="Admin_Peserta_Internship.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Peserta Internship','','images/internship_.png',1)"><img src="images/internship.png" name="Peserta Internship" width="193" height="193" border="0"></a></div></td>
  </tr>
  <tr>
    <td><div align="center" class="style34"><a href="Admin_Pengajuan_Internship.php">Pengajuan Internship</a></div></td>
    <td>&nbsp;</td>
    <td><div align="center"><span class="style34"><a href="Admin_Peserta_Internship.php">Peserta KP/Penelitian</a></span></div></td>
	<td>&nbsp;</td>
    <td><div align="center"><span class="style34"><a href="Admin_Peserta_Internship.php">Peserta Magang Industri</a></span></div></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div align="center"></div>
</div>
</div>
<!-- Internship section end -->
<!-- Contact start -->
	<div id="comment" class="comment">
    <div class="section third-section">
    <div class="container">
    <div class="title">
    <h1 style="color:#05B1EB">Comment</h1>
   	  </div>
            <br />
            <!-- <form action="ADMIN_proses.php" method="POST" name="comment"> -->
            <table width="584" height="60" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>

          <td width="11%" height="60" align="center" valign="middle"><div align="center"><a href="javascript:fxSearch()"><img src="images/search.png"  width="39" height="39"></a></div></td>
          <td width="37%" valign="middle"><input type="text" pattern="[a-zA-Z0-9]" title="Input numbers and characters only" name="text_search" id="text_search" onkeypress="javascript:fxSearchEnter(event)" style="height:10px"></td>
          <td width="22%">&nbsp;</td>
          <td width="9%"><label for="select"></label>
              <select onchange="fxDropdown(value)" name="pagerow" id="pagerow">
                
               <?php
               echo '<option value="5" '.(($pagerow=='5')?'selected="selected"':"").'> 5 </option>';
               echo '<option value="10" '.(($pagerow=='10')?'selected="selected"':"").'> 10 </option>';
               echo '<option value="25" '.(($pagerow=='25')?'selected="selected"':"").'> 25 </option>';
               echo '<option value="50" '.(($pagerow=='50')?'selected="selected"':"").'> 50 </option>';
                 
                 ?>
            </select>
          </td>
          <td width="21%"><div align="center" class="style1">Records per page</div></td>
        </tr>
      </table>

      <div align="center"></div>
      <table width="211" border="0" align="center">
        <tr>
          <td width="40" align="center" valign="middle"><div align="right"><a href="javascript:paging_first()"><img src="images/first.png" alt="" width="30" height="30" /></a> </div></td>
          <td width="40" align="center" valign="middle"><div align="center"><a href="javascript:paging_previous()"><img src="images/previous.png" width="30" height="30" /></a></div></td>
         <td width="32" align="center" valign="middle"><div align="center">
               <?php echo "<input type='text' pattern='[0-9]' title='Numbers only' name='page' id='page' value='$page' style='width:30px; height:13px' onkeypress='paging(event)' />"?> 
        </div></td>
         <?php Print '<td width="40" align="center" valign="middle"><div align="center"><a href="javascript:paging_next('.$result.')"><img src="images/next.png" width="30" height="31" /></a></div></td> '?>
         <?php Print '<td width="40" align="center" valign="middle"><div align="center"><a href="javascript:paging_last('.$result.')"><img src="images/last.png" width="30" height="31" /></a></div></td> '?>
        </tr>
      </table><br>

    </td>
      </tr>
    </table>
    <table width="95%" height="130" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#33C6F4" >
      <tr>
        <td width="3%" height="46" bgcolor="#05B1EB"><div align="center" class="style5 style35">No</div></td>
        <td width="7%" bgcolor="#05B1EB"><div align="center" class="style36">Tanggal</div></td>
        <td width="16%" bgcolor="#05B1EB"><div align="center" class="style36">Nama</div></td>
        <td width="19%" bgcolor="#05B1EB"><div align="center" class="style36">Email</div></td>
        <td width="55%" bgcolor="#05B1EB"><div align="center" class="style36">Comment</div></td>
      </tr>

      <?php 
      $query_select_comment = mysql_query("SELECT GUID, FIRSTNAME, EMAIL, DTMCRT, COMMENT FROM comment ORDER BY DATE(DTMCRT) DESC LIMIT {$pagenum},{$rec} ");
      $i=1;
      while($row = mysql_fetch_assoc($query_select_comment)){
        Print '<tr>';
        Print '<td width="3%" height="40" align="center" valign="middle" bgcolor="#D3F3FE" style="color:#031B2C">'.$i++."</div></td>";
        Print '<td align="left" valign="middle" bgcolor="#D3F3FE" style="color:#031B2C; padding-left:10px">'.$row['DTMCRT']."</div></td>";
        Print '<td align="left" valign="middle" bgcolor="#D3F3FE" style="color:#031B2C; padding-left:10px">'.$row['FIRSTNAME']."</div></td>";
        Print '<td align="center" valign="middle" bgcolor="#D3F3FE" style="color:#031B2C">'.$row['EMAIL']."</div></td>";
        Print '<td align="left" valign="middle" bgcolor="#D3F3FE" style="color:#031B2C; padding-left:10px">'.$row['COMMENT']."</div></td>";
        Print '</tr>';
      }
      ?>
    </table>
    <p align="center">
      <?php echo "Page ".$page." of ".$result ?>
    </div>
      </div>
</div>
</form>
<!-- comment section end -->
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
    
    <script type="text/javascript">
        
          function fxDropdown(value){
            var jmldata = parseInt(value);
            alert(jmldata);
            document.getElementById("action").value = 'linePerPage';
            document.forms['comment'].submit();
          }


          function fxSearch()
          {
              var txt_src = document.getElementById("text_search").value;
              var pattern = /[a-zA-Z0-9]/;
              if (pattern.test(txt_src)){
              document.getElementById("action").value = 'Search';
              document.forms[0].action='ADMIN.php';
              document.forms[0].submit();
              }
          }

          function fxSearchEnter(kp)
          {
            if (kp.keyCode == 13){
              var txt_src = document.getElementById("text_search").value;
              var pattern = /[a-zA-Z0-9]/;
              if (pattern.test(txt_src)){
              document.getElementById("action").value = 'Search';
              document.forms['comment'].submit();
              }
            }
          }

           function paging(kp){
              if (kp.keyCode == 13){
                var txt_src = document.getElementById("page").value;
              var pattern = /[0-9]/;
              if (pattern.test(txt_src)){
              document.getElementById("action").value = 'Search';
              document.forms['comment'].submit();
              }
                
              }
           }

           function paging_next(max_page){
            var curpage = parseInt(document.getElementById("page").value)+1; 
            if(curpage<=max_page){
            document.getElementById("action").value = 'Search';
            document.getElementById("page").value = curpage ;
            alert(document.getElementById("page").value);
            document.forms['comment'].submit();
            }
           }

           function paging_first(){
            document.getElementById("action").value = 'Search';
            document.getElementById("page").value = '1' ;
            alert(document.getElementById("page").value);
            document.forms['comment'].submit();
           }

            function paging_last(max_page){
            document.getElementById("action").value = 'Search';
            document.getElementById("page").value = max_page ;
            alert(document.getElementById("page").value);
            document.forms['comment'].submit();
           }

           function paging_previous(){
            var curpage = parseInt(document.getElementById("page").value)-1; 
            if(curpage!=0){
            document.getElementById("action").value = 'Search';
            document.getElementById("page").value = curpage ;
            alert(document.getElementById("page").value);
            document.forms['comment'].submit();
          }

         
        }
           
           
 </script>

</body>
</html>
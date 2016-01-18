<?php
session_start();
include("db_connection.php");
if(!isset($_SESSION['username'])){
  header("location:index.php");
}

// cek
if(isset($_SESSION['bikinsekolah'])){
  eksyen('Please complete your college detail','add-college.php');
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

          #mnotif {position: fixed; bottom: 30px; right: 70px; z-index: 99;}
          -->
        </style>
        <script type="text/javascript">
        //disable enter -->
        function stopRKey(evt) {
          var evt = (evt) ? evt : ((event) ? event : null);
          var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
          if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
        }

        document.onkeypress = stopRKey;
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
<body>
<link rel="stylesheet" href="css/morris.css">
<script src="js/raphael-min.js"></script>
<script src="js/morris.min.js"></script>
<?php
	$unit = base64_decode($_GET['u']);
	$bulan = base64_decode($_GET['b']);
	$tahun = base64_decode($_GET['t']);

	// pending
	$q = mysql_query("select count(GUID) as total from internship_registration where status='PENDING' and UNIT_ID='$unit' and START_DATE like '$tahun-$bulan-%'");
	$d = mysql_fetch_array($q);

	// approved
	$q1 = mysql_query("select count(GUID) as total from internship_registration where status='APPROVED' and UNIT_ID='$unit' and START_DATE like '$tahun-$bulan-%'");
	$d1 = mysql_fetch_array($q1);

	// in progress
	$q2 = mysql_query("select count(GUID) as total from internship_registration where status='IN PROGRESS' and UNIT_ID='$unit' and START_DATE like '$tahun-$bulan-%'");
	$d2 = mysql_fetch_array($q2);

	// rejected
	$q3 = mysql_query("select count(GUID) as total from internship_registration where status='REJECTED' and UNIT_ID='$unit' and START_DATE like '$tahun-$bulan-%'");
	$d3 = mysql_fetch_array($q3);

	// done
	$q4 = mysql_query("select count(GUID) as total from internship_registration where status in ('FINISHED','DONE') and UNIT_ID='$unit' and START_DATE like '$tahun-$bulan-%'");
	$d4 = mysql_fetch_array($q4);
?>
<h1 class="text-center">Report <?=ambildata($unit,'unit','UNIT_NAME');?><br><?=bulandariangka($bulan);?> <?=$tahun;?></h1>

<div id="myfirstchart" style="height: 250px;"></div>

<script>
new Morris.Bar({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    { year: 'Pending', value: <?=$d['total'];?> },
    { year: 'Approved', value: <?=$d1['total'];?> },
    { year: 'In Progress', value: <?=$d2['total'];?> },
    { year: 'Rejected', value: <?=$d3['total'];?> },
    { year: 'Finished', value: <?=$d4['total'];?> }
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'year',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value']
});
</script>

<h3>Table Data</h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<th class="text-center">Pending</th>
			<th class="text-center">Approved</th>
			<th class="text-center">In Progress</th>
			<th class="text-center">Rejected</th>
			<th class="text-center">Finished</th>
		</tr>
	</thead>
	<tbody>
		<tr class="text-center">
			<td><?=$d['total'];?></td>
			<td><?=$d1['total'];?></td>
			<td><?=$d2['total'];?></td>
			<td><?=$d3['total'];?></td>
			<td><?=$d4['total'];?></td>
		</tr>
	</tbody>
</table>

<table class="table table-condensed table-bordered" id="tbl">
  <thead>
    <tr>
      <th class="col-md-1 text-center">No</th>
      <th class="col-md-2 text-center">Nama</th>
      <th class="col-md-2 text-center">Program</th>
      <th class="text-center">Topik/Referensi</th>
      <th class="col-md-2 text-center">Periode</th>
      <th class="col-md-1 text-center">Status</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $i = 1;
  $q = mysql_query("select * from internship_registration where UNIT_ID='$unit' and START_DATE like '$tahun-$bulan-%' order by field(status,'PENDING','APPROVED','IN PROGRESS','REJECTED','FINISHED','DONE')");
  while($d = mysql_fetch_array($q)){ 
  ?>
    <tr>
      <td class="text-center">
      	<?=$i;?>
      	<input type="hidden" name="iduserdetail[]" id="inputIduserdetail" class="form-control" value="<?=$d['USER_DETAIL_ID'];?>">
      </td>
      <td class="text-center"><?=ambildata($d['USER_DETAIL_ID'],'user_detail','FIRSTNAME');?></td>
      <td class="text-center"><?=ambildata($d['PROGRAM_ID'],'internship_program','PROGRAM');?></td>
      <td class="text-center">
        <?php
        $pr = ambildata($d['PROGRAM_ID'],'internship_program','PROGRAM');
        if($pr == "Magang Industri"){
          echo ambildata($d['INTERNSHIP_PROJECT_ID'],'program','PROGRAM_NAME');
        }else{
          echo ambildata($d['MASTER_TOPIC_ID'],'master_topic','TOPIC_NAME');
        }
        ?>
      </td>
      <td class="text-center"><?=$d['START_DATE'];?> / <?=$d['END_DATE'];?></td>
      <td class="text-center"><?=$d['STATUS'];?></td>
    </tr>
  <?php $i++; } ?>
  </tbody>
</table>

<script type="text/javascript">window.print(); window.close(); </script>
</body>
</html>
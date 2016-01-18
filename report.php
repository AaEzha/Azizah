<link rel="stylesheet" href="css/morris.css">
<script src="js/raphael-min.js"></script>
<script src="js/morris.min.js"></script>
<?php
if(isset($_POST['unit'])){
	$unit = mysql_real_escape_string($_POST['unit']);
	$bulan = mysql_real_escape_string($_POST['bulan']);
	$tahun = mysql_real_escape_string($_POST['tahun']);

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
<?=tabel();?>
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

<div class="col-lg-3 col-lg-offset-3">
	<a href="report_print.php?u=<?=base64_encode($unit);?>&b=<?=base64_encode($bulan);?>&t=<?=base64_encode($tahun);?>" class="btn btn-primary btn-block btn-lg" target="_blank"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
</div>
<div class="col-lg-3">
	<a href="?p=report" class="btn btn-primary btn-block btn-lg"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Refresh</a>
</div>
<h2></h2>
<?php }else{
?>
<h1 class="text-center">Report</h1>
<form action="" method="POST" class="form-horizontal" role="form">

		<div class="form-group">
			<label for="inputUnit" class="col-sm-2 control-label">Filter:</label>
			<div class="col-sm-4">
				<select name="unit" id="inputUnit" class="form-control" required="required">
				<?php
				$q = mysql_query("select * from unit");
				while($d = mysql_fetch_array($q)){
				?>
					<option value="<?=$d['GUID'];?>"><?=$d['UNIT_CODE'];?> - <?=$d['UNIT_NAME'];?></option>
				<?php } ?>
				</select>
			</div>
			<div class="col-sm-2">
				<select name="bulan" id="inputBulan" class="form-control" required="required">
				<?php
				$arb = array("01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");
				foreach ($arb as $key => $value) {
				?>
					<option value="<?=$key;?>"><?=$value;?></option>
				<?php } ?>
					
				</select>
			</div>
			<div class="col-sm-2">
				<select name="tahun" id="inputTahun" class="form-control" required="required">
				<?php
				for($i=2015; $i<=2020; $i++){
				?>
					<option value="<?=$i;?>"><?=$i;?></option>
				<?php } ?>
				</select>
			</div>
		</div>

		

		<div class="form-group">
			<div class="col-sm-8 col-sm-offset-2">
				<button type="submit" class="btn btn-primary btn-block">Submit</button>
			</div>
		</div>
</form>
<?php
}
?>
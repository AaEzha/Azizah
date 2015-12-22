<h1 class="title">Quota</h1>
<?php

?>
<div class="text-center">
<form action="" method="POST" class="form-inline" role="form">

	<div class="form-group">
		<label class="sr-only" for="">label</label>
		<select name="bulan" id="inputBulan" class="form-control input-lg" required="required">
			<option value="01">January</option>
			<option value="02">February</option>
			<option value="03">March</option>
			<option value="04">April</option>
			<option value="05">May</option>
			<option value="06">June</option>
			<option value="07">July</option>
			<option value="08">August</option>
			<option value="09">September</option>
			<option value="10">October</option>
			<option value="11">November</option>
			<option value="12">December</option>
		</select>
	</div>

	<div class="form-group">
		<select name="tahun" id="inputTahun" class="form-control input-lg" required="required">
		<?php for($x=2015;$x<=2020;$x++){ ?>
			<option value="<?=$x;?>"><?=$x;?></option>
		<?php } ?>
		</select>
	</div>		

	<button type="submit" name="pilih" class="btn btn-primary input-lg">Check</button>
</form>
</div>
<?php
if(isset($_POST['pilih'])){
	$bulan = $_POST['bulan'];
	$tahun = $_POST['tahun'];
?>
	<h2 class="text-center"><?=bulandariangka($bulan);?> <?=$tahun;?></h2>
	<form action="proses_quota.php" method="post">
	<?=tabel();?>
	<table class="table table-bordered table-condensed" id="tbl">
		<thead>
			<tr>
				<th class="col-lg-1 text-center">No</th>
				<th>Name</th>
				<th class="col-lg-1 text-center">Week 1</th>
				<th class="col-lg-1 text-center">Week 2</th>
				<th class="col-lg-1 text-center">Week 3</th>
				<th class="col-lg-1 text-center">Week 4</th>
				<th class="col-lg-1 text-center">Week 5</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$q = mysql_query("select * from quota where MONTH='$bulan' and YEAR='$tahun'");
			$i=1;
			$jum = mysql_num_rows($q);
			if($jum<1){
				$username = $_SESSION['username'];
				mysql_query("insert into quota(GUID,USER_DETAIL_ID,MONTH,YEAR,DTMCRT,USRCRT)
							select uuid(),ud.GUID,'$bulan','$tahun',now(),'Automation' from user_detail ud
							join member_of_group mog on mog.user_detail_id=ud.guid
							join ms_group mg on mg.guid=mog.ms_group_id
							where mg.group_name='lcu'
							");
				$q = mysql_query("select * from quota where MONTH='$bulan' and YEAR='$tahun'");
			}
			while($d = mysql_fetch_array($q)){ ?>
			<tr>
				<td class="text-center"><?=$i;?></td> 
				<td><input type="hidden" name="userid<?=$i;?>" id="inputUserid" class="form-control" value="<?=$d['USER_DETAIL_ID'];?>"><?=konvert2('user_detail','guid',$d['USER_DETAIL_ID'],'firstname');?> <?=konvert2('user_detail','guid',$d['USER_DETAIL_ID'],'lastname');?></td>
				<td><input type="text" name="w1<?=$i;?>" id="inputW11" class="form-control text-center input-sm" value="<?=$d['WEEK1'];?>" required="required" maxlength="3" <?=angka();?>></td>
				<td><input type="text" name="w2<?=$i;?>" id="inputW12" class="form-control text-center input-sm" value="<?=$d['WEEK2'];?>" required="required" maxlength="3" <?=angka();?>></td>
				<td><input type="text" name="w3<?=$i;?>" id="inputW13" class="form-control text-center input-sm" value="<?=$d['WEEK3'];?>" required="required" maxlength="3" <?=angka();?>></td>
				<td><input type="text" name="w4<?=$i;?>" id="inputW14" class="form-control text-center input-sm" value="<?=$d['WEEK4'];?>" required="required" maxlength="3" <?=angka();?>></td>
				<td><input type="text" name="w5<?=$i;?>" id="inputW15" class="form-control text-center input-sm" value="<?=$d['WEEK5'];?>" required="required" maxlength="3" <?=angka();?>></td>
			</tr>
			<?php 
			$i++; 
			}
			?>
		</tbody>
	</table>
	<div class="row">
		<div class="col-lg-offset-4 col-lg-4"><button type="submit" class="btn btn-primary btn-block">Save</button></div>
	</div>
		<input type="hidden" name="jum" id="inputJum" class="form-control" value="<?=$jum;?>">
		<input type="hidden" name="bulan" id="inputBulan" class="form-control" value="<?=$bulan;?>">
		<input type="hidden" name="tahun" id="inputTahun" class="form-control" value="<?=$tahun;?>">
	</form>
<?php	
}
?>
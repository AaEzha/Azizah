<?php
$unit = ambildata($_SESSION['iddetail'],'user_detail','UNIT_ID');

// ambil jumlah total quota per unit
$qqu = mysql_query("select QUOTA from quota_per_unit where UNIT_ID='$unit'");
$dqu = mysql_fetch_array($qqu);
$quota_per_unit = $dqu['QUOTA'];
?>
<br><h1>Quota per Topic <small>| Your Unit Quota: <?=$quota_per_unit;?></small></h1>
<?php
$tgl = date('d');
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

if(isset($_POST['topik'])){
	$topik = $_POST['topik'];
	$quota = $_POST['quota'];

	$quotanya=0;
	for($x=0; $x<count($topik); $x++){
		$quotanya=$quota[$x]+$quotanya;
	}

	if($quotanya>$quota_per_unit){
		eksyen('Total keseluruhan tidak boleh melebihi dari '.$quota_per_unit.' orang','?p=quota_lcu');
	}

	for($x=0; $x<count($topik); $x++){
		$qcek = mysql_query("select TOPIC_ID from quota where TOPIC_ID='".$topik[$x]."' and MONTH='".date('m')."' and YEAR='".date('Y')."'");
		$jcek = mysql_num_rows($qcek);
		if($jcek==0){
			// insert
			$query = "insert into quota(GUID,TOPIC_ID,MONTH,YEAR,DTMCRT,USRCRT,".$qw.") values(uuid(),'".$topik[$x]."','".date('m')."','".date('Y')."',now(),'".$_SESSION['username']."','".$quota[$x]."')";
		}else{
			// update
			$query = "update quota set ".$qw."='".$quota[$x]."' where TOPIC_ID='".$topik[$x]."' and MONTH='".date('m')."' and YEAR='".date('Y')."'";
		}
		//print_r($query."<br>");
		$query = mysql_query($query) or die("Query #".$x." is failed");
	}
}
?>
<div class="col-md-8">
<form action="" method="post">
	<?=tabel();?>
	<table class="table" id="tbl">
		<thead>
			<tr>
				<th class="col-md-1 text-center">No</th>
				<th>Topic</th>
				<th class="col-md-2 text-center">Quota this Week</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i = 1;
		$q = mysql_query("select * from selected_topic where UNIT_ID='$unit'");
		while($d = mysql_fetch_array($q)){
			// quota per topik dari tabel QUOTA
			$que = mysql_query("select * from quota where TOPIC_ID='".$d['MASTER_TOPIC_ID']."' and YEAR='".date('Y')."' and MONTH='".date('m')."'");
			$jque = mysql_num_rows($que);
			if($jque>=1){
				$dque = mysql_fetch_array($que);
			}
		?>
			<tr>
				<td class="text-center"><?=$i;?></td>
				<td><?=ambildata($d['MASTER_TOPIC_ID'],'master_topic','TOPIC_NAME');?><input type="hidden" name="topik[]" id="inputTopik[]" class="form-control" value="<?=$d['MASTER_TOPIC_ID'];?>"></td>
				<td class="text-center"><input type="text" name="quota[]" id="inputQuota[]" class="form-control input-sm text-center" value="<?php echo ($jque>=1)? $dque[$qw] : 0;?>" onkeypress="return isNumber(event)" maxlength="3"></td>
			</tr>
		<?php $i++; } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2"></td>
				<td>
					<button type="submit" class="btn btn-primary btn-block">Update</button>
				</td>
			</tr>
		</tfoot>
	</table>
</form>
</div>
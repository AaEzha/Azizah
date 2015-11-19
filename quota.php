<h1>Quota per Unit</h1>
<?php
if(isset($_POST['quota'])){
	$qcek = mysql_query("select * from quota_per_unit");
	$jcek = mysql_num_rows($qcek);
	if($jcek==0){
		$query = 'INSERT INTO quota_per_unit (GUID,UNIT_ID,QUOTA,DTMCRT,USRCRT) VALUES ';
		$quota = $_POST['quota'];
		$unit = $_POST['unit'];
	    $query_parts = array();
	    for($x=0; $x<count($unit); $x++){
	        $query_parts[] = "(uuid(),'" . $unit[$x] . "', '" . $quota[$x] . "',now(),'".$_SESSION['username']."')";
	    }
	    $query .= implode(',', $query_parts);

	    $q = mysql_query($query);
	    if($q){
	    	eksyen('Sukses','?p=quota');
	    }else{
	    	eksyen('Gagal','?p=quota');
	    }
	}else{
		$quota = $_POST['quota'];
		$unit = $_POST['unit'];
		for($x=0; $x<count($unit); $x++){
	        $sql = "update quota_per_unit set DTMUPD=now(), USRUPD='".$_SESSION['username']."', QUOTA='".$quota[$x]."' where UNIT_ID='".$unit[$x]."'";
	        mysql_query($sql);
	    }
	    eksyen('Sukses','?p=quota');
	}
}
?>
<form action="" method="post">
	<?=tabel();?>
	<table class="table" id="tbl">
		<thead>
			<tr>
				<th class="col-md-1 text-center">No</th>
				<th>Unit</th>
				<th class="col-md-1 text-center">Quota</th>
				<th class="col-md-1 text-center">Interns</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i = 1;
		$q = mysql_query("select * from unit");
		while($d = mysql_fetch_array($q)){
			// jumlah intern per unit
			$a = mysql_query("select * from internship_registration ir
							  join unit u on ir.UNIT_ID=u.GUID where u.GUID='".$d['GUID']."'");
			$ja = mysql_num_rows($a);
			$da = mysql_fetch_array($a);

			// jumlah quota per unit
			$b = mysql_query("select * from quota_per_unit where UNIT_ID='".$d['GUID']."'");
			$db = mysql_fetch_array($b);
		?>
			<tr>
				<td class="text-center"><?=$i;?></td>
				<td><?=$d['UNIT_CODE'];?> - <?=$d['UNIT_NAME'];?> <input type="hidden" name="unit[]" id="inputUnit" class="form-control" value="<?=$d['GUID'];?>"></td>
				<td class="text-center"><input type="text" name="quota[]" id="inputQuota" class="form-control input-sm text-center" value="<?=$db['QUOTA']?$db['QUOTA']:'0';?>" onkeypress="return isNumber(event)" maxlength="3"></td>
				<td class="text-center"><?=$ja;?></td>
			</tr>
		<?php $i++; } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2"></td>
				<td>
					<button type="submit" class="btn btn-primary btn-block">Update</button>
				</td>
				<td></td>
			</tr>
		</tfoot>
	</table>
</form>
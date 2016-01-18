<h1 class="title">Statistics</h1>
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
}

?>

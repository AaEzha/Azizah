<h1 class="text-center">Project</h1>
<?php	
$idprojek = $_GET['i'];

$q = mysql_query("SELECT * FROM program");
while($d = mysql_fetch_array($q)){

?>
<table class="table table-bordered table-condensed">
	<tr>
		<td class="col-md-1"><p>Title</p></td>
		<td><p><?=$d['PROGRAM_NAME'];?></p></td>
	</tr>
	<tr>
		<td><p>Detail</p></td>
		<td><?=$d['PROGRAM_DETAIL'];?></td>
	</tr>
	<tr>
		<td>Requirement</td>
		<td><?=$d['PROGRAM_NEED'];?></td>
	</tr>
	<tr>
		<td>Periode</td>
		<td><?=tanggal($d['PROGRAM_START']);?> s.d. <?=tanggal($d['PROGRAM_END']);?></td>
	</tr>
</table>

<?php } ?>
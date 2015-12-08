<?php	
$idprojek = $_GET['i'];

$q = mysql_query("SELECT * FROM program WHERE GUID='$idprojek'");
$d = mysql_fetch_array($q);

?>
<h1 class="text-center">Internship Detail</h1>
<table class="table">
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
		<td><?=$d['PROGRAM_START'];?> - <?=$d['PROGRAM_END'];?></td>
	</tr>
</table>
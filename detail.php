<?php	
$idprojek = $_GET['i'];

$q = mysql_query("SELECT * FROM program WHERE GUID='$idprojek'");
$d = mysql_fetch_array($q);

?>
<h1>Internship Detail</h1>
<table class="table">
	<tr>
		<td class="col-md-1">Title</td>
		<td><?=$d['PROGRAM_NAME'];?></td>
	</tr>
	<tr>
		<td>Detail</td>
		<td><?=$d['PROGRAM_DETAIL'];?></td>
	</tr>
	<tr>
		<td>Requirement</td>
		<td><?=$d['PROGRAM_NEED'];?></td>
	</tr>
	<tr>
		<td>Periode</td>
		<td></td>
	</tr>
</table>
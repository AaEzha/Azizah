<?php
include("db_connection.php");

echo ("
		 <form action='Admin.php' method='POST'>
		<input type='hidden' name='LinePerPage' id='LinePerPage' value='5'>
		<input type='hidden' name='key' id='key' value=''>
		<input type='hidden' name='rec' id='rec' value='5'>
		<input type='hidden' name='page' id='page' value='1'>
		</form>
		");

	echo ("<SCRIPT LANGUAGE='JavaScript'>
	                document.forms[0].submit();
	                </SCRIPT>");
?>
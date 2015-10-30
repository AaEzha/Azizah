<?php
include("db_connection.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>Master Group </title>
</head>

<body>
  <form action="msgroup_proses.php" method="POST">
	<table align="center">
		<tr>
		</tr>
		
    <tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
<td>
      <select id="username" name="username" onChange="onChange()">
                    <?php
 $fya=mysql_query("SELECT u.username, ud.user_id FROM user as u JOIN user_detail as ud ON u.guid = ud.user_id");
                    while ($row=mysql_fetch_array($fya)){
                    $user=$row["username"];
                    $guid=$row["user_id"];
          echo "<option value=\"$user\">$user</option>";
          } ?>
      </select>   
             </td>

			<td>
			<select id="group_name" name="group_name" onChange="onChange()">
                      <?php
 $fya=mysql_query("SELECT group_name FROM ms_group");
                    while ($row=mysql_fetch_array($fya)){
                    $ala=$row["group_name"];
          echo "<option value=\"$ala\">$ala</option>";
          } ?>
                      </select>
             </td>
             <td>
             	<button type="submit" name="btnSave" id="btnSave">Save</button>
             </td>
		</tr>

	</table>
</form>

</body>
</html>
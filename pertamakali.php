<?php
include 'db_connection.php';
// hapus tabel-tabel
mysql_query("truncate assessment");
mysql_query("truncate guestbook");
mysql_query("truncate institute");
mysql_query("truncate internship_registration");
mysql_query("truncate member_of_group");
mysql_query("truncate message");
mysql_query("truncate message_notif");
mysql_query("truncate quota");
mysql_query("truncate quota_per_unit");
mysql_query("truncate selected_topic");
mysql_query("truncate testimonial");
mysql_query("truncate unit_leader");
mysql_query("truncate user");
mysql_query("truncate user_detail");
mysql_query("truncate user_education");

// uuid user
$a = mysql_query("select uuid() as iduser");
$aa = mysql_fetch_array($a);
$iduser = $aa['iduser'];
mysql_query("insert into user values('$iduser','aa',md5('aa'),'','1',now(),now(),now(),'admin')");

// uuid user_detail
$ab = mysql_query("select uuid() as iduser");
$aab = mysql_fetch_array($ab);
$iddetail = $aab['iduser'];
mysql_query("insert into user_detail(GUID,USER_ID,FIRSTNAME,DTMCRT,USRCRT) values('$iddetail','$iduser','Admin',now(),'Admin')");

// member of group
mysql_query("insert into member_of_group values(uuid(),'3c806e53-3dcf-11e5-901c-00ff7f4e65c4','$iddetail',now(),'Admin',now(),'Admin')");
eksyen('Selesai','index.php');
?>
<?php
session_start();
include("db_connection.php");

try{

mysql_query("SET autocommit = 0");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = mysql_real_escape_string($_POST['txt_user_id']);
    $password = mysql_real_escape_string($_POST['txt_password']);
	$id_card = mysql_real_escape_string($_POST['txt_id_card']);
	$nis_nim = mysql_real_escape_string($_POST['txt_nis_nim']);
    $first_name = mysql_real_escape_string($_POST['txt_first_name']);
    $last_name = mysql_real_escape_string($_POST['txt_last_name']);
    $place_of_birth = mysql_real_escape_string($_POST['txt_place_of_birth']);
    $date_of_birth = mysql_real_escape_string($_POST['txt_date_of_birth']);
    $gender = mysql_real_escape_string($_POST['gender']);
    $user_address = mysql_real_escape_string($_POST['txt_user_address']);
    $phone1 = mysql_real_escape_string($_POST['txt_phone1']);
    $phone2 = mysql_real_escape_string($_POST['txt_phone2']);
    $email = mysql_real_escape_string($_POST['txt_email']);
    $hobby = mysql_real_escape_string($_POST['txt_hobby']);
    //$user_id = mysql_real_escape_string($_POST['txt_user_id']);
    $password = mysql_real_escape_string($_POST['txt_password']);
    $education_level_id = mysql_real_escape_string($_POST['education_level']);
    $institute_id = mysql_real_escape_string($_POST['institute']);
    $major_id = mysql_real_escape_string($_POST['major']);
    $concern_id = mysql_real_escape_string($_POST['concern']);
  	$aboutme = mysql_real_escape_string($_POST['txt_aboutme']);

    $bool = true;
    mysql_query("START TRANSACTION");
   // $query_check_username_and_email = mysql_query("SELECT us.USERNAME, ud.EMAIL FROM user_detail as ud JOIN user as us ON ud.user_id = us.guid");
    $query_check_username_and_email = mysql_query("SELECT COUNT(*) as count FROM user_detail as ud JOIN user as us ON ud.user_id = us.guid where us.USERNAME = '$username' and ud.email='$email'");
     while($row = mysql_fetch_array($query_check_username_and_email)){
        $count = $row['count'];
    //     $table_emails = $row['EMAIL'];
    //     if($username == $table_users){
    //         $bool = false;
    //         
         }
    Print '<script>alert("'.$count.'");</script>';

        if($count== 0){

                    //--------------------------photo----------------------------------//
                    $tmp_name  = $_FILES['file_photo']['tmp_name']; //nama local temp file di server
                    $file_size = $_FILES['file_photo']['size']; //ukuran file (dalam bytes)
                    $fp = fopen($tmp_name, 'r'); // open file (read-only, binary)
                    $file_type = $_FILES['file_photo']['type']; //tipe filenya (langsung detect MIMEnya)
                    $photo = fread($fp, $file_size) or die("Tidak dapat membaca source file"); // read file
                    $photo = mysql_real_escape_string($photo) or die("Tidak dapat membaca source file"); // parse image ke string
                    fclose($fp); // tuptup file
                    //--------------------------photo----------------------------------//

                    //--------------------------cv----------------------------------//
                    $tmp_name  = $_FILES['file_cv']['tmp_name']; //nama local temp file di server
                    $file_size = $_FILES['file_cv']['size']; //ukuran file (dalam bytes)
                    
                    $fp = fopen($tmp_name, 'r'); // open file (read-only, binary)
                    $file_type = $_FILES['file_cv']['type']; //tipe filenya (langsung detect MIMEnya)
                    $cv = fread($fp, $file_size) or die("Tidak dapat membaca source file"); // read file
                    $cv = mysql_real_escape_string($cv) or die("Tidak dapat membaca source file"); // parse image ke string
                    fclose($fp); // tuptup file
                    //--------------------------cv----------------------------------//


                    //--------------------------start of create user----------------------------------//

                    mysql_query("INSERT INTO `user`(`GUID`, `USERNAME`, `PASSWORD`, `ISLOGIN`, `LASTLOGIN`, `DTMCRT`, `DTMUPD`, `USRUPD`) VALUES (uuid(),'$username',md5('$password'),'A',CURRENT_DATE(),CURRENT_DATE(),CURRENT_DATE(),'$username')");

                    $query = mysql_query("SELECT user.guid FROM user WHERE username= '$username'");
                    $userid = "";
                    while($row = mysql_fetch_assoc($query)) //display all rows from query
                        {
                            $userid = $row['guid'];
                        }
                    //--------------------------end create user----------------------------------//

                    mysql_query("INSERT INTO `user_detail`(`GUID`, `USER_ID`, `UNIT_ID`, `FIRSTNAME`, `LASTNAME`, `ID_CARD`, `NIM_NIS`, `EMAIL`, `PLACE_OF_BIRTH`, `DATE_OF_BIRTH`, `GENDER`, `USER_ADDRESS`, `HOBBY`, `PHONE1`, `PHONE2`, `CONCERN`, `ABOUT_ME`, `CV`, `PHOTO`, `DTMCRT`, `USRCRT`, `DTMUPD`, `USRUPD`) 
                        VALUES (uuid(),'$userid','','$first_name','$last_name','$id_card','$nis_nim','$email','$place_of_birth','$date_of_birth','$gender','$user_address','$hobby','$phone1','$phone2','$concern_id','$aboutme','$cv','$photo',CURRENT_DATE(),'$last_name',CURRENT_DATE(),'admin')");


                    $query_username_guid = mysql_query("SELECT u.USERNAME, ud.GUID FROM user as u JOIN user_detail as ud ON u.guid = ud.user_id WHERE USERNAME = '$username'");
                    while($row = mysql_fetch_array($query_username_guid)){
                    $user_detail_id=$row['GUID'];
                    }

                    $query_group_guid = mysql_query("SELECT GUID FROM ms_group WHERE GROUP_NAME = 'USER'");
                    while($row = mysql_fetch_array($query_group_guid3)){
                        $msgroup_guid=$row['GUID'];
                    }

                    mysql_query(
                        "INSERT INTO `user_education`
                        (`GUID`, `USER_DETAIL_ID`, `EDUCATION_LEVEL_ID`, `INSTITUTE_ID`, `MAJOR_ID`, `NAME_TRAINING`, `CERTIFICATE`, `TYPE_EDUCATION`, `START_YEAR`, `END_YEAR`, `DTMCRT`, `USRCRT`, `DTMUPD`, `USRUPD`) 
                VALUES  (uuid(),'$user_detail_id','$education_level_id','$institute_id','$major_id','','','','$year','$year',CURRENT_DATE(),'$username',CURRENT_DATE(),'$username')");


                    $query_insert_member_of_group = mysql_query("INSERT INTO `member_of_group`
                    (`GUID`, `MS_GROUP_ID`, `USER_DETAIL_ID`, `DTMCRT`, `USRCRT`, `DTMUPD`, `USRUPD`) 
                    VALUES (uuid(),'$msgroup_guid','$user_id',CURRENT_DATE,'admin',CURRENT_DATE,'$username')");   


                    Print '<script>alert("Registered!");</script>';
                    mysql_query("COMMIT");
                    header("Location: index.php");
        }
        else{
            Print '<script>alert("Username or email has been taken!");</script>';
            Print '<script>window.location.assign("index.php");</script>';
        }

    }


}
catch(Exception $e){
    mysql_query('ROLLBACK');
    Print '<script>alert("Error!");</script>';
    Print '<script>window.location.assign("index.php");</script>';
}
?>


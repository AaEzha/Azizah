<?php
session_start();
include("db_connection.php"); 

          if($_SESSION['user']){
            }
            else {
              header("location:index.php");
              }
              $user = $_SESSION['user'];


$query = mysql_query("Select GUID from user WHERE username = '$user'");

while($row = mysql_fetch_assoc($query)) //display all rows from query
    {
      $user_id = $row['GUID']; 
    }

if(isset($_POST['btnSave'])){
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
    //$password = mysql_real_escape_string($_POST['txt_password']);
    //echo $education_level = mysql_real_escape_string($_POST['education_level']);
    //$institution = mysql_real_escape_string($_POST['institution']);
    //echo $major= mysql_real_escape_string($_POST['major']);
    //echo $concern = mysql_real_escape_string($_POST['concern']);
  	$aboutme = mysql_real_escape_string($_POST['txt_aboutme']);

    //--------------------------photo----------------------------------//
    $tmp_name  = $_FILES['file_photo']['tmp_name']; //nama local temp file di server
    if($tmp_name != '')
    {
        $file_size = $_FILES['file_photo']['size']; //ukuran file (dalam bytes)
        $fp = fopen($tmp_name, 'r'); // open file (read-only, binary)
        $file_type = $_FILES['file_photo']['type']; //tipe filenya (langsung detect MIMEnya)

        if ($file_type == "image/jpeg" && $file_size > 0 && $file_size < 65536) {
        $photo = fread($fp, $file_size) or die("Tidak dapat membaca source file"); // read file
        $photo = mysql_real_escape_string($photo) or die("Tidak dapat membaca source file"); // parse image ke string
        fclose($fp); // tuptup file
        }
        else {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('File type does not exist or file is too large')
                window.location.href='edit profile_user.php';
                </SCRIPT>");
        }

            $query1 = mysql_query("UPDATE user_detail SET 
        FIRSTNAME='$first_name',
        LASTNAME='$last_name',
        ID_CARD='$id_card',
        NIM_NIS='$nis_nim',
        EMAIL='$email',
        PLACE_OF_BIRTH='$place_of_birth',
        DATE_OF_BIRTH='$date_of_birth',
        GENDER='$gender',
        USER_ADDRESS='$user_address',
        HOBBY='$hobby',
        PHOTO='$photo',
        PHONE1='$phone1',
        PHONE2='$phone2',
        ABOUT_ME='$aboutme',
        DTMUPD=CURRENT_DATE,
        USRUPD='ADMIN' WHERE USER_ID ='$user_id'"); 
    }

    else
    {
        $query1 = mysql_query("UPDATE user_detail SET 
        FIRSTNAME='$first_name',
        LASTNAME='$last_name',
        ID_CARD='$id_card',
        NIM_NIS='$nis_nim',
        EMAIL='$email',
        PLACE_OF_BIRTH='$place_of_birth',
        DATE_OF_BIRTH='$date_of_birth',
        GENDER='$gender',
        USER_ADDRESS='$user_address',
        HOBBY='$hobby',
        PHONE1='$phone1',
        PHONE2='$phone2',
        ABOUT_ME='$aboutme',
        DTMUPD=CURRENT_DATE,
        USRUPD='ADMIN' WHERE USER_ID ='$user_id'"); 
    }

    if (!$query1) {
        echo die('Error updating record: ' . mysql_error());
    }
    else {
      echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Record update successfully')
                window.location.href='USER.php';
                </SCRIPT>");
    }
    }
    

    //--------------------------cv----------------------------------//
    //$tmp_name  = $_FILES['file_cv']['tmp_name']; //nama local temp file di server
    //$file_size = $_FILES['file_cv']['size']; //ukuran file (dalam bytes)
    
    //$fp = fopen($tmp_name, 'r'); // open file (read-only, binary)
    //$file_type = $_FILES['file_cv']['type']; //tipe filenya (langsung detect MIMEnya)
    //$cv = fread($fp, $file_size) or die("Tidak dapat membaca source file"); // read file
    //$cv = mysql_real_escape_string($cv) or die("Tidak dapat membaca source file"); // parse image ke string
    //fclose($fp); // tuptup file
 


if(isset($_POST['btnAdd'])){
        $first_name = mysql_real_escape_string($_POST['txt_first_name']);
        $institute_id = mysql_real_escape_string($_POST['institute']);
        $major_id = mysql_real_escape_string($_POST['major']);
        $year = mysql_real_escape_string($_POST['year']);

//----------------------Institute ID---------------------//
    $query_institute_id = mysql_query("SELECT institute.guid FROM institute WHERE institute.institute_name = '$institute_id'");
    $institute_id = "";
    while ($row = mysql_fetch_assoc($query_institute_id))
    {
        $institute_id = $row['guid'];
    }


//----------------------Major ID---------------------//
    $query_major_id = mysql_query("SELECT major.guid FROM major WHERE major_name = '$major_id'");
    $major_id = "";
    while ($row = mysql_fetch_assoc($query_major_id))
    {
        $major_id = $row['guid'];
    }

    $query_2 = mysql_query("INSERT INTO `user_education`(`GUID`, `USER_DETAIL_ID`, `EDUCATION_LEVEL_ID`, `INSTITUTE_ID`, `MAJOR_ID`, `NAME_TRAINING`, `CERTIFICATE`, `TYPE_EDUCATION`, `START_YEAR`, `END_YEAR`, `DTMCRT`, `USRCRT`, `DTMUPD`, `USRUPD`) VALUES (uuid(),'$user_id','','$institute_id','$major_id','','','','$year','$year',CURRENT_DATE(),'$first_name',CURRENT_DATE(),'$first_name')");

    if (!$query_2) {
    echo die('Error inserting record: ' . mysql_error());
    }
    else {
         echo "Record updated successfully";
    }
}

if(isset($_POST['btnCancel'])){
    header("location:USER.php");
    }


?>



<?php
session_start();
include("db_connection.php");
$user = $_SESSION['user'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $program = mysql_real_escape_string($_POST['program']);
    $topic_name = mysql_real_escape_string($_POST['concern']);
    $start_date = mysql_real_escape_string($_POST['txt_start_date']);
    $end_date = mysql_real_escape_string($_POST['txt_end_date']);

    //----------------------Topic ID---------------------//
    $query_topic_id = mysql_query("SELECT master_topic.guid FROM master_topic WHERE master_topic.topic_name = '$topic_name'");
    $topic_id = "";
    while ($row = mysql_fetch_assoc($query_topic_id))
    {
        $topic_id = $row['guid'];
    }

    //--------------------------proposal----------------------------------//
    $tmp_name  = $_FILES['file_proposal']['tmp_name']; //nama local temp file di server
    $file_size = $_FILES['file_proposal']['size']; //ukuran file (dalam bytes)
    $fp = fopen($tmp_name, 'r'); // open file (read-only, binary)
    $file_type = $_FILES['file_proposal']['type']; //tipe filenya (langsung detect MIMEnya)
    $proposal = fread($fp, $file_size) or die("Tidak dapat membaca source file"); // read file
    $proposal = mysql_real_escape_string($proposal) or die("Tidak dapat membaca source file"); // parse image ke string
    fclose($fp); // tuptup file
    //--------------------------proposal----------------------------------//

    //--------------------------cover letter----------------------------------//
    $tmp_name  = $_FILES['file_cover_letter']['tmp_name']; //nama local temp file di server
    $file_size = $_FILES['file_cover_letter']['size']; //ukuran file (dalam bytes)
    $fp = fopen($tmp_name, 'r'); // open file (read-only, binary)
    $file_type = $_FILES['file_cover_letter']['type']; //tipe filenya (langsung detect MIMEnya)
    $cover_letter = fread($fp, $file_size) or die("Tidak dapat membaca source file"); // read file
    $cover_letter = mysql_real_escape_string($cover_letter) or die("Tidak dapat membaca source file"); // parse image ke string
    fclose($fp); // tuptup file
    //--------------------------cover letter----------------------------------//

    $query = mysql_query("SELECT user.guid FROM user WHERE username= '$user'");
    $userid = "";
    while($row = mysql_fetch_assoc($query)) //display all rows from query
        {
            $userid = $row['guid'];
        }

        $query_internship_reg = mysql_query(
            "INSERT INTO `internship_registration`
            (`GUID`, `USER_DETAIL_ID`, `EDUCATION_LEVEL_ID`, `MASTER_TOPIC`, `INTERNSHIP_PROJECT_ID`, 
                `PROGRAM_ID`, `START_DATE`, `END_DATE`, `PROPOSAL`, `COVER_LETTER`, `STATUS`, `DTMCRT`, 
                `USRCRT`, `DTMUPD`, `USRUPD`) 
        VALUES (uuid(),'$userid','','$topic_id','','','$start_date','$end_date','$proposal','$cover_letter','IN PROGRESS',CURRENT_DATE(),'$user',CURRENT_DATE(),'$user')");
        
        if(!$query_internship_reg)
        {
            echo die('Error inserting record: ' . mysql_error());
        }
        else
        {
            echo "Record inserted successfully";
            header("Location:USER.php");
        }

}

?>
<?php
require 'bin/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'ssl://smtp.googlemail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'donotreply.gmf.aeroasia@gmail.com';                 // SMTP username
$mail->Password = 'tidakbolehkosong';                           // SMTP password
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('donotreply.gmf.aeroasia@gmail.com', 'GMF AeroAsia');
$mail->addAddress($_SESSION['emailnya'], $_SESSION['namanya']);     // Add a recipient
$mail->addReplyTo($_SESSION['emailp'], $_SESSION['namap']);
$mail->addCC($_SESSION['emailp']);
/*$mail->addBCC('bcc@example.com');*/

/*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name*/

$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $_SESSION['judulnya'];
$mail->Body    = '<p>As we concern to your current message, here we respond.<p>
                    <p>'.$_SESSION['teks'].'</p>';
$mail->AltBody = $_SESSION['teks'];

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
    unset($_SESSION['namanya']);
    unset($_SESSION['emailnya']);
    unset($_SESSION['emailp']);
    unset($_SESSION['namap']);
    unset($_SESSION['teks']);
    unset($_SESSION['judulnya']);
}
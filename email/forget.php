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
/*$mail->addReplyTo('info@example.com', 'Information');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');*/

/*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name*/

$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Retrieving GMF Account';
$mail->Body    = '<p>This is your new password : '.$_SESSION['passwordnya'].'.<p>
					<p>Enjoy your account.</p>';
$mail->AltBody = 'This is your new password : '.$_SESSION['passwordnya'].'.';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
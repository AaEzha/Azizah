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
$mail->Subject = 'Activate your GMF AeraAsia account';
$mail->Body    = '<p>Thank you for registering. To access our full website, you have to activate your account by click this link below<p>
					<p><a href="'.URL.'/activator.php?L='.$_SESSION['emailnya'].'&D='.$_SESSION['idnya'].'">Activate your account</a></p>
					<p>Or you can copy this below and paste to your favourite browser:</p>
					<p>'.URL.'/activator.php?L='.$_SESSION['emailnya'].'&D='.$_SESSION['idnya'].'</p>
					<p>Enjoy your account.</p>';
$mail->AltBody = 'Activate your account through this: '.URL.'/activator.php?L='.$_SESSION['emailnya'].'&D='.$_SESSION['idnya'].'';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
    unset($_SESSION['emailnya']);
    unset($_SESSION['idnya']);
    unset($_SESSION['namanya']);
}
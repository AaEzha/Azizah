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
$mail->Subject = 'GMF AeroAsia Internship Program';
$mail->Body    = '<p>Hai '.$_SESSION['namanya'].', your internship program is over. Thank you.<p>
                    <p>For further information and Thank You Letter, you should log in to GMF AeroAsia\'s Web with your own account.</p>
					<p>Enjoy your account.</p>';
$mail->AltBody = 'Hai '.$_SESSION['namanya'].', your internship program is over. Thank you. For further information and Thank You Letter, you should log in to GMF AeroAsia\'s Web with your own account. Enjoy your account.';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
    unset($_SESSION['namanya']);
    unset($_SESSION['emailnya']);
}
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {

    // SMTP configuration
    $mail->isSMTP();

    $mail->Host       = 'smtpout.secureserver.net';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'support@drscalper.com';
    $mail->Password   = 'Danny@12123';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Sender
    $mail->setFrom(
        'support@drscalper.com',
        'Dr. Scalper Website'
    );

    // Recipient
    $mail->addAddress(
        'support@drscalper.com'
    );

    // Email
    $mail->Subject = 'Dr. Scalper SMTP Test';

    $mail->Body =
        'This is a test email sent using GoDaddy SMTP from the Dr. Scalper website.';

    $mail->send();

    echo 'SMTP EMAIL SENT SUCCESSFULLY';

} catch (Exception $e) {

    echo 'SMTP ERROR:<br><br>';
    echo htmlspecialchars($mail->ErrorInfo);

}

?>
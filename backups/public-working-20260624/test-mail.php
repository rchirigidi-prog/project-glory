<?php

require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();

    $mail->Host = 'smtp.hostinger.com';

    $mail->SMTPAuth = true;

    $mail->Username = 'prayer@singthyglory.com';

    $mail->Password = 'Prayer#2026';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    $mail->Port = 465;

    $mail->setFrom(
        'prayer@singthyglory.com',
        'SingThyGlory Test'
    );

    $mail->addAddress(
        'prayer@singthyglory.com'
    );

    $mail->Subject = 'SMTP Test Email';

    $mail->Body =
    'This is a test email from SingThyGlory.';

    $mail->send();

    echo "✅ Email Sent Successfully";

} catch (Exception $e) {

    echo "❌ Mailer Error:<br><br>";

    echo $mail->ErrorInfo;

}
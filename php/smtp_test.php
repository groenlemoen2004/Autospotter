<?php
require 'vendor/autoload.php'; // Adjust path as needed
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'mail.autospotters.co.za';
    $mail->SMTPAuth = true;
    $mail->Username = 'info@autospotter.co.za';
    $mail->Password = 'Estian2004#S'; // Change to your password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 465;

    $mail->setFrom('info@autospotter.co.za', 'Test Email');
    $mail->addAddress('estianjesterhuizen@gmail.com'); // Change to your email

    $mail->isHTML(true);
    $mail->Subject = 'SMTP Test Email';
    $mail->Body    = 'This is a test email.';

    $mail->send();
    echo 'Email sent successfully';
} catch (Exception $e) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
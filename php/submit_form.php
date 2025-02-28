<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

session_start(); // Start the session to store the message

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capture form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    if (!empty($_POST['honeypot'])) {
        // This is a bot
        die("Bot detected!");
    }

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'estianjesterhuizen@gmail.com'; // Your Gmail address
        $mail->Password = 'shdv mtzz dibs juqw'; // Your Gmail password or App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('estianjesterhuizen@gmail.com', 'Autospotters'); // Your Gmail address and your name
        $mail->addAddress('info@autospotters.co.za'); // Recipient email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Us Form Submission';
        $mail->Body    = "
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Message:</strong></p>
        <p>$message</p>
        ";

        $mail->send();
        
        echo json_encode([
            'success' => true,
            'message' => 'Application has been sent!'
        ]);
        $_SESSION['popup_message'] = 'Application has been sent!'; // Store success message
    } catch (Exception $e) {
        // If an error occurs, return a JSON error response
        echo json_encode([
            'success' => false,
            'message' => "Application could not be sent. Mailer Error: {$mail->ErrorInfo}"
        ]);
        $_SESSION['popup_message'] = "Application could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    exit;
}

?>

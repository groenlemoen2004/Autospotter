<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

session_start(); // Start the session to store the message

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capture form data and sanitize it
    $fullName = htmlspecialchars($_POST['fullName']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $downPayment = htmlspecialchars($_POST['downPayment']);
    $income = htmlspecialchars($_POST['income']);
    $debtReview = htmlspecialchars($_POST['debtReview']);
    $license = htmlspecialchars($_POST['license']);
    $message = htmlspecialchars($_POST['message']);
    $vehicleMake = htmlspecialchars($_POST['vehicleMake']);  // Auto-filled
    $vehicleModel = htmlspecialchars($_POST['vehicleModel']); // Auto-filled
    $stockNumber = htmlspecialchars($_POST['stockNumber']); // Auto-filled
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
        $mail->setFrom('estianjesterhuizen@gmail.com', 'AutoSpotter');
        $mail->addAddress('info@autospotters.co.za'); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Vehicle Finance Application';
        $mail->Body    = "
            <h1>New Vehicle Finance Application</h1>
            <p><strong>Full Name:</strong> $fullName</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Down Payment:</strong> $downPayment</p>
            <p><strong>Income:</strong> $income</p>
            <p><strong>Under Debt Review:</strong> $debtReview</p>
            <p><strong>Valid Drivers License:</strong> $license</p>
            <p><strong>Vehicle Make:</strong> $vehicleMake</p>
            <p><strong>Vehicle Model:</strong> $vehicleModel</p>
            <p><strong>Stock Number:</strong> $stockNumber</p>
            <p><strong>Additional Information:</strong></p>
            <p>$message</p>
        ";

        $mail->send();

        // Return a JSON response for the front end
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
        $_SESSION['popup_message'] = "Application could not be sent. Mailer Error: {$mail->ErrorInfo}"; // Store error message
    }
}

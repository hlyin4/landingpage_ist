<?php
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $name = $_POST['Name'] ?? '';
        $email = $_POST['Email'] ?? '';
        $message = $_POST['message'] ?? '';

        $mail = new PHPMailer(true);
        // $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sethuprasathm@gmail.com';
        $mail->Password = 'hftppcuzbkbvuksr';
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 587; 

        $senderName = 'SethuPrasathm';
        $senderEmail = 'sethuprasathm@gmail.com';

        $mail->setFrom($senderEmail, $senderName);
        $mail->addAddress('info@ist.app');
        $mail->isHTML(true);								 
        $mail->Subject = 'Contact Form Submission';
        $mail->Body = "
            <html>
            <body>
                <h2>New Contact Form Submission</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Message:</strong></p>
                <p>$message</p>
            </body>
            </html>
        ";
        $mail->AltBody = 'Body in plain text for non-HTML mail clients';
        $mail->send();
        session_start();
        $_SESSION['message'] = 'success';
        echo "<script>window.location.href='index.php';</script>";
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request!";
}

?>

<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include necessary files and autoload
require '/home/u664069117/domains/barangaysilangstms.online/public_html/PHPMailer/src/PHPMailer.php';
require '/home/u664069117/domains/barangaysilangstms.online/public_html/PHPMailer/src/SMTP.php';
require '/home/u664069117/domains/barangaysilangstms.online/public_html/PHPMailer/src/Exception.php';
require '/home/u664069117/domains/barangaysilangstms.online/public_html/vendor/autoload.php';

// Function to generate a random verification code
function generateVerificationCode($length = 6) {
    $characters = '0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}

// Create a new instance of PHPMailer
$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp-relay.brevo.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'dauntlessbarangay@gmail.com';
    $mail->Password = 't0hSbN5FBdmZnpK6';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Email settings
    $mail->setFrom('dauntlessbarangay@gmail.com', 'Barangay System Registration');
    $mail->addAddress($_POST['email']); // Add recipient email dynamically
    $mail->addReplyTo('dauntlessbarangay@gmail.com', 'Barangay System Registration');
    $mail->isHTML(true);

    // Generate a random verification code
    $verificationCode = generateVerificationCode();

    // Set email subject and body with the generated verification code
    $mail->Subject = 'Verification Code';
    $mail->Body = 'Your verification code is: <b>' . $verificationCode . '</b>'; 
    $mail->AltBody = 'Your verification code is: ' . $verificationCode;

    // Send the email
    $mail->send();
    
    // Store verification code in session
    $_SESSION['verification_code'] = $verificationCode;

    // Output success message with verification code
    echo 'Verification code sent successfully';
} catch (Exception $e) {
    // Output error message if sending fails
    echo "Error: {$mail->ErrorInfo}";
}
?>


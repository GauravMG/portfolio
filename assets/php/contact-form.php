<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');  // Sanitize name input
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);     // Validate email
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');  // Sanitize message input
    $subject = htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8');  // Sanitize subject input

    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';      // Set the SMTP server to send through
    $mail->SMTPAuth   = true;
    $mail->Username   = 'projects18.gaurav@gmail.com'; // SMTP username
    $mail->Password   = 'imcwrletqapeific';  // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('projects18.gaurav@gmail.com', 'Gaurav Projects 18');
    $mail->addAddress('projects18.gaurav@gmail.com', 'Gaurav Projects 18');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Lead from Portfolio : ' . $_POST['subject'];
    $mail->Body    = "Hey Admin, <br><br> New lead from portfolio website - <br><br> <b>From:</b $name <br> <b>E-Mail:</b> $email <br><br> <b>Message:</b> <br> $message <br><br> Regards, <br> Team Leads";

    $mail->send();
    echo 'We have registered your enquiry. Someone from our team is currently going through your message and will connect with you shortly.';
} catch (Exception $e) {
    echo "We apologize that we are unable to register your enquiry at the moment. We are working on it. Meanwhile you can connect with us on call using the contact number provided above.";
}

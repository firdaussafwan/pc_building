<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

// Data From Form
$client_name = $_POST["your-name"] ;
$client_email = $_POST["your-email"] ;
$client_subject = $_POST["your-subject"] ;
$client_message = $_POST["your-message"] ;

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'superduperemail3530@gmail.com';
    $mail->Password   = 'invyjxhjuuzhllmc';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // $mail->Host       = 'mail.arinex.com';
    // $mail->Username   = '';
    // $mail->Password   = '';
	// $mail->SMTPAuth = false; // turn on SMTP authentication

    $mail->setFrom($client_email, $client_name);
    $mail->addAddress('firdaus3530@gmail.com');

    $mail->Subject = $client_subject ;
    $mail->Body    = "This Email is send by: " . $client_email . "=====" .  $client_message;

    $mail->send();
    echo '<script>alert("Email sent successfully!");</script>';
    echo '<script>window.location.href = "index.php";</script>';
} catch (Exception $e) {
    echo '<script>alert("Email sending failed. Error: ' . $mail->ErrorInfo . '");</script>';
    echo '<script>window.location.href = "index.php";</script>';
}
?>

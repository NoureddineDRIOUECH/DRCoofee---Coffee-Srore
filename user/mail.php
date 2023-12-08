<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mailer/autoload.php';

$mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'oyuncoyt@gmail.com';
    $mail->Password   = 'nourddine 2004';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
$mail->isHTML(true);  
$mail->CharSet = "UTF-8";
<?php
require_once('class.phpmailer.php');



$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.mailgun.org";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "postmaster@sandbox5a3aa643ce51463487ba5d62eb5698ab.mailgun.org";
$mail->Password = "03ac2748208c9a3b4edb155efaae3b97 ";
$mail->SetFrom("dangercoders@gmail.com");
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress("shiksha000@gmail.com");

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }
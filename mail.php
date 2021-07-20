<?php

require_once 'app/PhpMailer/PhpMailer.php';

$mailto  = $_POST['email'];
$mailSub = $_POST['subject'];
$mailMsg = $_POST['message'];

$mail = new PHPMailer();
$mail->IsSmtp();
$mail->SMTPDebug = 2;

$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Host = "smtp-mail.outlook.com";
$mail->Port = 587;

$mail->IsHTML(true);
$mail->Username = "fabio.santos@s4sys.com.br";
$mail->Password = "uska#galo2021";
$mail->setFrom("fabio.santos@s4sys.com.br");
$mail->Subject = $mailSub;
$mail->Body = $mailMsg;
$mail->AddAddress($mailto);
$mail->Send();

header('Location: index.php');
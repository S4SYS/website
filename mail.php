<?php

ini_set('SMTP','smtp-mail.outlook.com');
ini_set('smtp_port', 587);

$to_email = $_POST['email'];
$subject  = $_POST['subject'];
$message  = $_POST['message'];
$headers  = 'From: fabio.santos@s4sys.com.br';

mail($to_email,$subject,$message,$headers);

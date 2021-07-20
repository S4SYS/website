<?php
/*
ini_set( 'display_errors', 1 );
ini_set('SMTP','smtp-mail.outlook.com');
ini_set('smtp_port', 587);
ini_set('smtp_ssl', 'auto');
*/
$to_email = $_POST['email'];
$subject  = $_POST['subject'];
$message  = $_POST['message'];

$headers = [
    'From'     => 'fabio.santos@s4sys.com.br',
    'Reply-To' => 'fabio.santos@s4sys.com.br',
    'X-Mailer' => 'PHP/' . phpversion()
];

try{
    mail($to_email,$subject,$message,$headers);
} catch(\Throwable $exception){
    echo $exception->getMessage();
}


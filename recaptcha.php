<?php

if(!$_GET['token'] || empty($_GET)) header('Location: index.php');

$secret = '6LeMLngUAAAAAE4491OBpbRCvrI5QIQctQa87Lnp';

$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_GET['token']);

echo $response;
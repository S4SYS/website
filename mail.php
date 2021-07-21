<?php

require_once 'app/EmailContato.php';

echo json_encode((new EmailContato($_POST))->init());
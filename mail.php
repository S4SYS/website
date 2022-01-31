<?php

require_once 'app/adapter/EmailContatoAdapter.php';

echo json_encode((new EmailContatoAdapter($_POST))->init());


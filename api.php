<?php

require_once 'app/controller/SetorController.php';
require_once 'app/controller/TipoRequisicaoController.php';

echo json_encode([
    'setor'           => (new SetorController())->get(),
    'tipo_requisicao' => (new TipoRequisicaoController())->get() 
]);


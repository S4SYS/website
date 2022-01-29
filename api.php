<?php

require_once 'app/controller/SetorController.php';
require_once 'app/controller/TipoRequisicaoController.php';
require_once 'app/controller/RequisicaoController.php';
require_once 'app/controller/ViolacaoController.php';

final Class Api
{      
    /**
     * @param array $requestParams
     * 
     * @return string
     */
    public static function json(array $requestParams): string
    {
        switch($requestParams['acao']){
            case('index') : 
                return json_encode([
                    'setor' => (new SetorController())->get(),
                    'tipo_requisicao' => (new TipoRequisicaoController())->get()
                ]);

            case('requisicao'): 
                return json_encode((new RequisicaoController())->save($requestParams));
                
            case('consulta'): 
                return json_encode([
                    'requisicao' => (new RequisicaoController())->getByCode($requestParams),
                    'violacao'   => (new ViolacaoController())->getByCode($requestParams)
                ]);   
                
            case('violacao'):
                return json_encode((new ViolacaoController())->save($requestParams));
                    
        }
    }
}

$request = (isset($_POST['acao']) && !empty($_POST)) ? $_POST : $_GET;

echo Api::json($request); 


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
     */
    public static function json(array $requestParams)
    {
        switch($requestParams['acao']){
            case('index') : 
                return json_encode([
                    'setor' => (new SetorController())->get(),
                    'tipo_requisicao' => (new TipoRequisicaoController())->get()
                ]);

            case('requisicao'): 
                $response = (new RequisicaoController())->save($requestParams);
                if($response['success']) header('Location: ./#success');
                break;
                
            case('consulta'): 
                return json_encode([
                    'requisicao' => (new RequisicaoController())->getByCode($requestParams),
                    'violacao'   => (new ViolacaoController())->getByCode($requestParams)
                ]);   
                
            case('violacao'):
                $response = (new ViolacaoController())->save($requestParams);
                if($response['success']) header('Location: ./#success');
                break;
        }
    }
}

$request = (isset($_POST['acao']) && !empty($_POST)) ? $_POST : $_GET;

echo Api::json($request); 


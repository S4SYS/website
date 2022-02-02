<?php

if(!isset($_POST['acao']) && !isset($_GET['acao'])) die("<script>location.href='./';</script>");

@session_start();

require_once 'app/controller/SetorController.php';
require_once 'app/controller/TipoRequisicaoController.php';
require_once 'app/controller/RequisicaoController.php';
require_once 'app/controller/ViolacaoController.php';
require_once 'app/adapter/EmailPortalLgpdAdapter.php';
require_once 'app/File.php';

final class Api
{
    /**
     * @param array $requestParams
     * 
     * @return void
     */
    public static function setAction(array $requestParams): void
    {
        switch ($requestParams['acao']) {
            case ('index'):
                echo json_encode([
                    'setor' => (new SetorController())->get(),
                    'tipo_requisicao' => (new TipoRequisicaoController())->get()
                ]);
                break;

            case ('requisicao'):
                $arquivo = $_FILES['arquivo'];
                if(is_array($arquivo) && !empty($arquivo)){
                    $upload = File::upload($arquivo);
                    if(!$upload['success']) die($upload['message']); 
                    $requestParams['arquivo'] = $upload['file_name']; 
                }

                $response = (new RequisicaoController())->save($requestParams);
                if(!$response['success']) die($response['message']);

                $requisicao = $response['data'];
                $mail = (new EmailPortalLgpdAdapter($requisicao))->init();
                if(!$mail['success']) die('Falha no envio do email.');

                $_SESSION['codigo'] = $requisicao->codigo; 
                echo "<script>location.href='./#success';</script>";
                break;

            case ('consulta'):
                echo json_encode([
                    'requisicao' => (new RequisicaoController())->getByCode($requestParams),
                    'violacao'   => (new ViolacaoController())->getByCode($requestParams)
                ]);
                break;

            case ('violacao'):
                $arquivo = $_FILES['arquivo'];
                if(is_array($arquivo) && !empty($arquivo)){
                    $upload = File::upload($arquivo);
                    if(!$upload['success']) die($upload['message']); 
                    $requestParams['arquivo'] = $upload['file_name']; 
                }
                          
                $response = (new ViolacaoController())->save($requestParams);
                if(!$response['success']) die($response['message']); 
                
                $violacao = $response['data'];
                $mail = (new EmailPortalLgpdAdapter($violacao))->init();
                if(!$mail['success']) die('Falha no envio do email.');

                $_SESSION['codigo'] = $violacao->codigo;
                echo "<script>location.href='./#success';</script>";
                break;

            default:
                echo "<script>location.href='./';</script>";
                break;
        }
    }    
}

$request = (isset($_POST['acao']) && !empty($_POST)) ? $_POST : $_GET;

Api::setAction($request);

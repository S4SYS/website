<?php

require_once 'app/controller/SetorController.php';
require_once 'app/controller/TipoRequisicaoController.php';
require_once 'app/controller/RequisicaoController.php';
require_once 'app/controller/ViolacaoController.php';
require_once 'app/adapter/EmailPortalLgpdAdapter.php';

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
                echo self::getLoader();
                $response = (new RequisicaoController())->save($requestParams);
                if ($response['success']) {
                    $mail = (new EmailPortalLgpdAdapter($response))->init();
                }
                if ($mail['success']){
                    echo "<script>location.href='./#success';</script>";
                } 
                break;

            case ('consulta'):
                echo json_encode([
                    'requisicao' => (new RequisicaoController())->getByCode($requestParams),
                    'violacao'   => (new ViolacaoController())->getByCode($requestParams)
                ]);
                break;

            case ('violacao'):
                //echo self::getLoader();
                $response = (new ViolacaoController())->save($requestParams);
                (new EmailPortalLgpdAdapter($response))->init();
                
                /*
                if ($response['success']) {
                    $mail = (new EmailPortalLgpdAdapter($response))->init();
                }
                if ($mail['success']){
                    echo "<script>location.href='./#success';</script>";
                } 
                */
                break;

            default:
                echo "<script>location.href='./#success';</script>";
                break;
        }
    }

    /**
     * @return string
     */
    private static function getLoader(): string
    {
        return implode('', [
            '<link href="css/style.css" type="text/css" rel="stylesheet" />',
            '<div id="pageloader">',
            '<div class="loader text-center">',
            '<img src="images/progress.gif" alt="loader" />',
            '</div>',
            '</div>'
        ]);
    }
}

$request = (isset($_POST['acao']) && !empty($_POST)) ? $_POST : $_GET;

Api::setAction($request);

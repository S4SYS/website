<?php

if (!isset($_POST['acao']) && !isset($_GET['acao'])) die("<script>location.href='./';</script>");

@session_start();

require_once 'app/controller/SetorController.php';
require_once 'app/controller/TipoRequisicaoController.php';
require_once 'app/controller/RequisicaoController.php';
require_once 'app/controller/ViolacaoController.php';
require_once 'app/adapter/EmailPortalLgpdAdapter.php';
require_once 'app/File.php';

final class Api
{
    private static $params;

    /**
     * @param array $requestParams
     * 
     * @return void
     */
    public static function setAction(array $requestParams): void
    {
        self::$params = $requestParams;

        switch (self::$params['acao']) {
            case ('index'):
                echo json_encode([
                    'setor' => (new SetorController())->get(),
                    'tipo_requisicao' => (new TipoRequisicaoController())->get()
                ]);
                break;

            case ('requisicao'):
                $arquivo = $_FILES['arquivo'];
                self::$params['arquivo'] = $arquivo['name'];
                if ($arquivo['size'] > 0) {
                    $upload = File::upload($arquivo);
                    if (!$upload['success']) die($upload['message']);
                }

                $response = (new RequisicaoController())->save(self::$params);
                if (!$response['success']) die($response['message']);

                $requisicao = $response['data'];
                $mail = (new EmailPortalLgpdAdapter($requisicao))->init();
                if (!$mail['success']) die('Falha no envio do email.');

                $_SESSION['codigo'] = $requisicao->codigo;
                echo "<script>location.href='./#success';</script>";
                break;

            case ('consulta'):
                echo json_encode([
                    'requisicao' => (new RequisicaoController())->getByCode(self::$params),
                    'violacao'   => (new ViolacaoController())->getByCode(self::$params)
                ]);
                break;

            case ('violacao'):
                $arquivo = $_FILES['arquivo'];
                self::$params['arquivo'] = $arquivo['name'];
                if($arquivo['size'] > 0){
                    $upload = File::upload($arquivo);
                    if(!$upload['success']) die($upload['message']); 
                }
                          
                $response = (new ViolacaoController())->save(self::$params);
                if(!$response['success']) die($response['message']); 
                
                $violacao = $response['data'];
                $mail = (new EmailPortalLgpdAdapter($violacao))->init();
                if(!$mail['success']) die('Falha no envio do email.');

                $_SESSION['codigo'] = $violacao->codigo;
                echo "<script>location.href='./#success';</script>";
                break;

            case('emailConsulta'):
                echo self::getConsultaPostRedirect();
                break;    

            default:
                echo "<script>location.href='./';</script>";
                break;
        }
    }
    
    /**
     * @param string $param
     * 
     * @return string
     */
    private static function getConsultaPostRedirect(): string
    {        
        $codigo = self::$params['codigo'];

        return implode('', [
            "<form id=\"formConsulta\" action=\"consulta.php\" method=\"post\">",
            "<input type=\"hidden\" name=\"codigo\" value=\"{$codigo}\">",
            "</form>",
            "<script>",
            "document.getElementById('formConsulta').submit();",
            "</script>"
        ]);
    }
}

$request = (isset($_POST['acao']) && !empty($_POST)) ? $_POST : $_GET;

Api::setAction($request);

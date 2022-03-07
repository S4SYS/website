<?php

if (!isset($_POST['acao']) && !isset($_GET['acao'])) die("<script>location.href='./';</script>");

@session_start();

require_once 'app/controller/SetorController.php';
require_once 'app/controller/TipoRequisicaoController.php';
require_once 'app/controller/RequisicaoController.php';
require_once 'app/controller/ViolacaoController.php';
require_once 'app/controller/StatusController.php';
require_once 'app/controller/UsuarioController.php';
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
                    if (!$upload['success']){
                        $_SESSION['error_message'] = $upload['message'];
                        echo "<script>location.href='./#error';</script>";
                        exit; 
                    } 
                }

                $response = (new RequisicaoController())->save(self::$params);
                if (!$response['success']){
                    $_SESSION['error_message'] = $response['message'];
                    echo "<script>location.href='./#error';</script>";
                    exit;
                } 

                $requisicao = $response['data'];
                $mail = (new EmailPortalLgpdAdapter($requisicao))->init();
                if (!$mail['success']){
                    $_SESSION['error_message'] = 'Falha no envio de email.';
                    echo "<script>location.href='./#error';</script>";
                    exit;
                }
                        
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
                    if (!$upload['success']){
                        $_SESSION['error_message'] = $upload['message'];
                        echo "<script>location.href='./#error';</script>";
                        exit; 
                    } 
                }
                          
                $response = (new ViolacaoController())->save(self::$params);
                if (!$response['success']){
                    $_SESSION['error_message'] = $response['message'];
                    echo "<script>location.href='./#error';</script>";
                    exit;
                } 
                
                $violacao = $response['data'];
                $mail = (new EmailPortalLgpdAdapter($violacao))->init();
                if (!$mail['success']){
                    $_SESSION['error_message'] = 'Falha no envio de email.';
                    echo "<script>location.href='./#error';</script>";
                    exit;
                }
           
                $_SESSION['codigo'] = $violacao->codigo;
                echo "<script>location.href='./#success';</script>";
                break;

            case('emailConsulta'):
                echo self::getConsultaPostRedirect();
                break;
                
            case('login'):
                $dados = (new UsuarioController())->authenticate(self::$params);
                if(!$dados['success']){
                    $_SESSION['error_message'] = $dados['message'];
                    die("<script>location.href='adm/login.php?auth=false';</script>");                    
                }
                if($dados['success'] && !$dados['data']){
                    $_SESSION['error_message'] = 'Login / senha inv&aacute;lidos.';
                    die("<script>location.href='adm/login.php?auth=false';</script>");
                }
                $usuario = $dados['data'];
                $_SESSION['idUsuario']   = $usuario['id'];
                $_SESSION['nomeUsuario'] = $usuario['nome'];
                echo "<script>location.href='adm/';</script>";   
                break;
            
            case('logout'):
                @session_destroy();
                unset($_SESSION['idUsuario']);
                unset($_SESSION['nomeUsuario']);
                echo "<script>location.href='adm/';</script>";
                break;
            
            // Solicitacoes do sys adm.    
            case('get_requisicoes'): die(json_encode((new RequisicaoController())->get()));    

            case('get_violacoes')  : die(json_encode((new ViolacaoController())->get()));

            case('get_status')     : die(json_encode((new StatusController())->get()));

            // Qualquer acao nao listada acima.
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

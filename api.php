<?php

//ini_set('display_errors', 1);

if (!isset($_POST['acao']) && !isset($_GET['acao'])) die("<script>location.href='./';</script>");

@session_start();

require_once 'app/Config.php';
require_once 'app/model/Requisicao.php';
require_once 'app/model/Violacao.php';
require_once 'app/model/Status.php';
require_once 'app/controller/SetorController.php';
require_once 'app/controller/TipoRequisicaoController.php';
require_once 'app/controller/RequisicaoController.php';
require_once 'app/controller/ViolacaoController.php';
require_once 'app/controller/StatusController.php';
require_once 'app/controller/UsuarioController.php';
require_once 'app/controller/UsuarioAcaoController.php';
require_once 'app/controller/RequisicaoUsuarioAcaoController.php';
require_once 'app/controller/ViolacaoUsuarioAcaoController.php';
require_once 'app/controller/ClienteController.php';
require_once 'app/adapter/EmailPortalLgpdAdapter.php';
require_once 'app/adapter/EmailStatusChangeAdapter.php';
require_once 'app/File.php';


final class Api
{
    private static $params;

    /**
     * @param array $requestParams
     * 
     * @return void
     */
    public static function setAction(array $requestParams)
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
                $token = self::$params['token'];
                $dadosCliente = (new ClienteController())->getByToken($token);
                if(!$dadosCliente['success']) die(json_encode($dadosCliente));
                $cliente = $dadosCliente['data'];
         
                $arquivo = $_FILES['arquivo'];
                self::$params['arquivo'] = $arquivo['name'];
                if ($arquivo['size'] > 0) {
                    $upload = File::upload($arquivo);
                    if (!$upload['success']){
                        $_SESSION['error_message'] = $upload['message'];
                        echo "<script>location.href='".Config::URL_SISTEMA."/#error';</script>";
                        exit; 
                    } 
                }

                self::$params['cliente'] = $cliente;
                $response = (new RequisicaoController())->save(self::$params);
                if (!$response['success']){
                    $_SESSION['error_message'] = $response['message'];
                    echo "<script>location.href='".Config::URL_SISTEMA."/#error';</script>";
                    exit;
                } 

                $requisicao = $response['data'];
                $mail = (new EmailPortalLgpdAdapter($requisicao))->init();
                if (!$mail['success']){
                    $_SESSION['error_message'] = 'Falha no envio de email.';
                    echo "<script>location.href='".Config::URL_SISTEMA."/#error';</script>";
                    exit;
                }
                        
                $_SESSION['codigo'] = $requisicao->codigo;
                echo "<script>location.href='".Config::URL_SISTEMA."/#success';</script>";
                break;

            case ('consulta'):
                echo json_encode([
                    'requisicao' => (new RequisicaoController())->getByCode(self::$params),
                    'violacao'   => (new ViolacaoController())->getByCode(self::$params)
                ]);
                break;

            case ('violacao'):
                $token = self::$params['token'];
                $dadosCliente = (new ClienteController())->getByToken($token);
                if(!$dadosCliente['success']) die(json_encode($dadosCliente));
                $cliente = $dadosCliente['data'];
            
                $arquivo = $_FILES['arquivo'];
                self::$params['arquivo'] = $arquivo['name'];
                if($arquivo['size'] > 0){
                    $upload = File::upload($arquivo);
                    if (!$upload['success']){
                        $_SESSION['error_message'] = $upload['message'];
                        echo "<script>location.href='".Config::URL_SISTEMA."/#error';</script>";
                        exit; 
                    } 
                }
                
                self::$params['cliente'] = $cliente;
                $response = (new ViolacaoController())->save(self::$params);
                if (!$response['success']){
                    $_SESSION['error_message'] = $response['message'];
                    echo "<script>location.href='".Config::URL_SISTEMA."/#error';</script>";
                    exit;
                } 
                
                $violacao = $response['data'];          
                $mail = (new EmailPortalLgpdAdapter($violacao))->init();
                if (!$mail['success']){
                    $_SESSION['error_message'] = 'Falha no envio de email.';
                    echo "<script>location.href='".Config::URL_SISTEMA."/#error';</script>";
                    exit;
                }
           
                $_SESSION['codigo'] = $violacao->codigo;
                echo "<script>location.href='".Config::URL_SISTEMA."/#success';</script>";
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
            
            // Submits do sys adm.    
            case('get_requisicoes'): 
                $token = self::$params['token'];
                $dadosCliente = (new ClienteController())->getByToken($token);
                if(!$dadosCliente['success']) die(json_encode($dadosCliente));
                echo json_encode((new RequisicaoController())->get(['cliente' => $dadosCliente['data']]));
                break;    

            case('get_violacoes'): 
                $token = self::$params['token'];
                $dadosCliente = (new ClienteController())->getByToken($token);
                if(!$dadosCliente['success']) die(json_encode($dadosCliente));
                echo json_encode((new ViolacaoController())->get(['cliente' => $dadosCliente['data']]));
                break;

            case('get_status'):
                $token = self::$params['token'];
                $dadosCliente = (new ClienteController())->getByToken($token);
                if(!$dadosCliente['success']) die(json_encode($dadosCliente));
                echo json_encode((new StatusController())->get(['cliente' => $dadosCliente['data']]));
                break;

            case('add_status'):
                $token = self::$params['token'];
                $dadosCliente = (new ClienteController())->getByToken($token);
                if(!$dadosCliente['success']) die(json_encode($dadosCliente)); 
                echo json_encode((new StatusController())->save([
                    'id' => $_POST['id'],
                    'nome' => $_POST['nome'],
                    'cliente' => $dadosCliente['data']
                ]));
                break;

            case('edit_status'):
                $token = self::$params['token'];
                $dadosCliente = (new ClienteController())->getByToken($token);
                if(!$dadosCliente['success']) die(json_encode($dadosCliente));
                echo json_encode((new StatusController())->update([
                    'id' => $_POST['id'],
                    'nome' => $_POST['nome'],
                    'cliente' => $dadosCliente['data']
                ]));
                break;

            case('get_status_by_code') :
                $token = self::$params['token'];
                $dadosCliente = (new ClienteController())->getByToken($token);
                if(!$dadosCliente['success']) die(json_encode($dadosCliente)); 
                echo json_encode((new StatusController())->getByCode([
                    'id' => $_GET['id'],
                    'cliente' => $dadosCliente['data']
                ]));
                break;

            case('get_status_requisicao'):
                $token = self::$params['token'];
                $dadosCliente = (new ClienteController())->getByToken($token);
                if(!$dadosCliente['success']) die(json_encode($dadosCliente));
                echo json_encode([
                    'current' => (new RequisicaoController())->getStatusByCode([
                        'id' => $_GET['id'],
                        'cliente' => $dadosCliente['data']
                    ]),
                    'all' => (new StatusController())->get(['cliente' => $dadosCliente['data']])
                ]);
                break;

            case('get_status_violacao'): 
                $token = self::$params['token'];
                $dadosCliente = (new ClienteController())->getByToken($token);
                if(!$dadosCliente['success']) die(json_encode($dadosCliente));
                echo json_encode([
                    'current' => (new ViolacaoController())->getStatusByCode([
                        'id' => $_GET['id'],
                        'cliente' => $dadosCliente['data']
                    ]),
                    'all' => (new StatusController())->get(['cliente' => $dadosCliente['data']])
                ]);
                break;   

            case('edit_requisicao_status'):
                $token = self::$params['token'];
                $dadosCliente = (new ClienteController())->getByToken($token);
                if(!$dadosCliente['success']) die(json_encode($dadosCliente));
                $cliente = $dadosCliente['data']; 
                $updateRequisicao = (new RequisicaoController())->updateStatus($_POST);
                $saveUsuarioAcao = (new UsuarioAcaoController())->save([
                    'user_id'     => $_SESSION['idUsuario'],
                    'comentario'  => $_POST['comentario'],
                    'tabela'      => Requisicao::TABLE,
                    'atual_id'    => $_POST['id_status'],
                    'anterior_id' => $_POST['current_status_id'],
                    'nome_usuario'=> $_SESSION['nomeUsuario'],
                    'id_solicitacao' => $_POST['id'],
                    'codigo' => $_POST['codigo'],
                    'cliente' => $cliente
                ]);
                $saveRequisicaoUsuarioAcao = (new RequisicaoUsuarioAcaoController())->save([
                    'id_requisicao' => $_POST['id'],
                    'id_usuario_acao' => $saveUsuarioAcao['data']->id
                ]);
                $usuarioAcao = $saveUsuarioAcao['data'];
                $usuarioAcao->email = $_POST['email'];
                $usuarioAcao->cliente = $cliente;
                echo json_encode([
                    'success' => true,
                    'upsate_requisicao' => $updateRequisicao,
                    'save_usuario_acao' => $saveUsuarioAcao,
                    'save_requisicao_usuario_acao' => $saveRequisicaoUsuarioAcao,
                    'email_status_change' => (new EmailStatusChangeAdapter($usuarioAcao))->init()
                ]);
                break;
     
            case('edit_violacao_status') : 
                $token = self::$params['token'];
                $dadosCliente = (new ClienteController())->getByToken($token);
                if(!$dadosCliente['success']) die(json_encode($dadosCliente));
                $cliente = $dadosCliente['data']; 
                $updateViolacao = (new ViolacaoController)->updateStatus($_POST);
                $saveUsuarioAcao = (new UsuarioAcaoController())->save([
                    'user_id'     => $_SESSION['idUsuario'],
                    'comentario'  => $_POST['comentario'],
                    'tabela'      => Violacao::TABLE,
                    'atual_id'    => $_POST['id_status'],
                    'anterior_id' => $_POST['current_status_id'],
                    'nome_usuario'=> $_SESSION['nomeUsuario'],
                    'id_solicitacao' => $_POST['id'],
                    'codigo' => $_POST['codigo'],
                    'cliente' => $cliente
                ]);
                $saveViolacaoUsuarioAcao = (new ViolacaoUsuarioAcaoController())->save([
                    'id_violacao' => $_POST['id'],
                    'id_usuario_acao' => $saveUsuarioAcao['data']->id
                ]);
                $usuarioAcao = $saveUsuarioAcao['data'];
                $usuarioAcao->email  = $_POST['email'];
                $usuarioAcao->cliente = $cliente;
                echo json_encode([
                    'success' => true,
                    'upsate_violacao' => $updateViolacao,
                    'save_usuario_acao' => $saveUsuarioAcao,
                    'save_violacao_usuario_acao' => $saveViolacaoUsuarioAcao,
                    'email_status_change' => (new EmailStatusChangeAdapter($usuarioAcao))->init()
                ]);
                break;  
                
                // Timeline
                case('get_requisicao_log'):
                    $token = self::$params['token'];
                    $dadosCliente = (new ClienteController())->getByToken($token);
                    if(!$dadosCliente['success']) die(json_encode($dadosCliente)); 
                    echo json_encode((new RequisicaoUsuarioAcaoController())->getByCode([
                        'id' => $_GET['id'],
                        'cliente' => $dadosCliente['data']
                    ]));
                    break;

                case('get_violacao_log'):
                    $token = self::$params['token'];
                    $dadosCliente = (new ClienteController())->getByToken($token);
                    if(!$dadosCliente['success']) die(json_encode($dadosCliente)); 
                    echo json_encode((new ViolacaoUsuarioAcaoController())->getByCode([
                        'id' => $_GET['id'],
                        'cliente' => $dadosCliente['data']
                    ]));
                    break;

                // Reenvio email de alteracao de status para requisicao/violacao
                case('resend_email'):
                    $token = self::$params['token'];
                    $dadosCliente = (new ClienteController())->getByToken($token);
                    if(!$dadosCliente['success']) die(json_encode($dadosCliente));
                    $cliente = $dadosCliente['data']; 
                    
                    if($_GET['reference'] === 'violacao') 
                        $dados = (new ViolacaoUsuarioAcaoController())->getByCode([
                            'id' => $_GET['id'],
                            'cliente' => $cliente
                        ])['data'][0];
                    else
                        $dados = (new RequisicaoUsuarioAcaoController())->getByCode([
                            'id' => $_GET['id'],
                            'cliente' => $cliente
                        ])['data'][0];

                    $usuarioAcao = new UsuarioAcao();
                    $usuarioAcao->email = $dados['email'];
                    $usuarioAcao->descricao = $dados['descricao'];
                    $usuarioAcao->cliente = $cliente;                    
                    echo json_encode((new EmailStatusChangeAdapter($usuarioAcao))->init());
                    break;

            // Qualquer acao nao listada acima.
            default:
                echo "<script>location.href='".Config::URL_SISTEMA."';</script>";
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

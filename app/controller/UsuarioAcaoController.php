<?php

require_once 'app/model/Usuario.php';
require_once 'app/model/Acao.php';
require_once 'app/model/UsuarioAcao.php';
require_once 'app/dao/UsuarioAcaoDao.php';
require_once 'app/controller/StatusController.php';
require_once 'app/ApiRequest.php';

final class UsuarioAcaoController
{
    use ApiRequest;

    private $dao;
    private $idTabela;
    private $codigo;
    private $nomeUsuario;

    /**
     */
    public function __construct()
    {
        $this->dao = new UsuarioAcaoDao();
    }

    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function save(array $requestData): array
    {
        $usuario = new Usuario();
        $acao = new Acao();
        $usuarioAcao = new UsuarioAcao();

        $usuario->id = $requestData['user_id'];
        $acao->id = Acao::COD_CREATE;
        $usuarioAcao->setUsuario($usuario);
        $usuarioAcao->setAcao($acao);
        $usuarioAcao->setComentario($requestData['comentario']);
        $usuarioAcao->setTabela($requestData['tabela']);
        $usuarioAcao->setAtualId($requestData['atual_id']);
        $usuarioAcao->setAnteriorId($requestData['anterior_id']);
        
        $this->idTabela = $requestData['id_solicitacao'];
        $this->codigo   = $requestData['codigo'];
        $this->nomeUsuario = $requestData['nome_usuario'];
        $usuarioAcao->setDescricao($this->getLogDescripton($usuarioAcao));

        return $this->dao->save($usuarioAcao);
    }
    
    /**
     * @param UsuarioAcao $usuarioAcao
     * 
     * @return string
     */
    private function getLogDescripton(UsuarioAcao $usuarioAcao): string
    {
        $tabela = $usuarioAcao->getTabela();
        $statusData = $this->getStatusDataIdAnteriorAtual($usuarioAcao);
        $nomeStatusAnterior = $statusData['anterior']['data']['nome'];
        $nomeStatusAtual = $statusData['atual']['data']['nome']; 

        return implode('', [
            "Status da {$tabela} id {$this->idTabela} alterado ",
            "de {$nomeStatusAnterior} para {$nomeStatusAtual} ",
            "por {$this->nomeUsuario}.",
            "<br>",
            "C&oacute;digo da {$tabela}: ",
            "<a href=\"{$this->url}?acao=emailConsulta&codigo={$this->codigo}\">{$this->codigo}</a>"
        ]);
    }

    
    /**
     * @param UsuarioAcao $usuarioAcao
     * 
     * @return array
     */
    private function getStatusDataIdAnteriorAtual(UsuarioAcao $usuarioAcao): array
    {
        $statusController = new StatusController();

        return [
            'anterior' => $statusController->getByCode(['id' => $usuarioAcao->getAnteriorId()]),
            'atual'    => $statusController->getByCode(['id' => $usuarioAcao->getAtualId()])
        ];
    }
}
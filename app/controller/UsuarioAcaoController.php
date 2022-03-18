<?php

require_once 'app/model/Usuario.php';
require_once 'app/model/Acao.php';
require_once 'app/model/UsuarioAcao.php';
require_once 'app/dao/UsuarioAcaoDao.php';

final class UsuarioAcaoController
{
    private $dao;
    private $idTabela;
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
        $idAnterior = $usuarioAcao->getAnteriorId();
        $idAtual    = $usuarioAcao->getAtualId();

        return "Status da Requisicao id {$this->idTabela} alterado de {$idAnterior} para {$idAtual} por {$this->nomeUsuario}.";
    }
}
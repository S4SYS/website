<?php

require_once 'app/dao/RequisicaoUsuarioAcaoDao.php';
require_once 'app/model/Requisicao.php';
require_once 'app/model/UsuarioAcao.php';
require_once 'app/model/RequisicaoUsuarioAcao.php';

final class RequisicaoUsuarioAcaoController
{
    private $dao;

    public function __construct()
    {
        $this->dao = new RequisicaoUsuarioAcaoDao();        
    }

    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function save(array $requestData): array
    {
        $requisicao = new Requisicao();
        $usuarioAcao = new UsuarioAcao();
        $requisicaoUsuarioAcao = new RequisicaoUsuarioAcao();

        $requisicao->id  = $requestData['id_requisicao'];
        $usuarioAcao->id = $requestData['id_usuario_acao'];

        $requisicaoUsuarioAcao->setRequisicao($requisicao);
        $requisicaoUsuarioAcao->setUsuarioAcao($usuarioAcao);

        return $this->dao->save($requisicaoUsuarioAcao);
    }

    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function getByCode(array $requestData): array
    {
        $requisicao = new Requisicao();
        $requisicaoUsuarioAcao = new RequisicaoUsuarioAcao();

        $requisicao->setId($requestData['id']);
        $requisicao->setCliente($requestData['cliente']);
        $requisicaoUsuarioAcao->setRequisicao($requisicao);

        return $this->dao->getByCode($requisicaoUsuarioAcao);
    }
}
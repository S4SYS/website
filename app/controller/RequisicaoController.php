<?php

require_once 'app/dao/RequisicaoDao.php';
require_once 'app/model/Requisicao.php';
require_once 'app/model/Setor.php';
require_once 'app/model/TipoRequisicao.php';
require_once 'app/model/Status.php';

final class RequisicaoController
{
    private $dao;

    public function __construct()
    {
        $this->dao = new RequisicaoDao();
    }

    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function save(array $requestData): array
    {
        $requisicao     = new Requisicao();
        $setor          = new Setor();
        $tipoRequisicao = new TipoRequisicao();   
        $setor->id = $requestData['setor'];
        $tipoRequisicao->id = $requestData['tipoRequisicao'];
        $requisicao->setCodigo(date('YmdHis'));
        $requisicao->setPedido($requestData['pedido']);
        $requisicao->setCpf($requestData['cpf']);
        $requisicao->setNome($requestData['nome']);
        $requisicao->setTelefone($requestData['telefone']);
        $requisicao->setEmail($requestData['email']);
        $requisicao->setArquivo($requestData['arquivo']);
        $requisicao->setSetor($setor);
        $requisicao->setTipoRequisicao($tipoRequisicao);
        $requisicao->setCliente($requestData['cliente']);

        return $this->dao->save($requisicao);
    }
        
    
    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function get(array $requestData): array
    {   $requisicao = new Requisicao();
        $requisicao->setCliente($requestData['cliente']);
        return $this->dao->get($requisicao);
    }

    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function getByCode(array $requestData): array
    {
        $requisicao = new Requisicao();
        $requisicao->setCodigo($requestData['codigo']);

        return $this->dao->getByCode($requisicao);
    }    
    
    
    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function getStatusByCode(array $requestData): array
    {
        $requisicao = new Requisicao();
        $requisicao->setId($requestData['id']);
        $requisicao->setCliente($requestData['cliente']);

        return $this->dao->getStatusByCode($requisicao);
    }

    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function updateStatus(array $requestData): array
    {
        $requisicao = new Requisicao();
        $status = new Status();

        $requisicao->setId($requestData['id']);
        $status->id = $requestData['id_status'];
        $requisicao->setStatus($status);

        return $this->dao->updateStatus($requisicao);
    }
}
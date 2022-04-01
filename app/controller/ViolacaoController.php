<?php

require_once 'app/dao/ViolacaoDao.php';
require_once 'app/model/Violacao.php';
require_once 'app/model/Status.php';
require_once 'app/model/Cliente.php';

final class ViolacaoController
{
    private $dao;

    public function __construct()
    {
        $this->dao = new ViolacaoDao();
    }

    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function save(array $requestData): array
    {
        $violacao = new violacao();

        $violacao->setCodigo(date('YmdHis'));
        $violacao->setCpf($requestData['cpf']);
        $violacao->setEmail($requestData['email']);
        $violacao->setNome($requestData['nome']);
        $violacao->setTelefone($requestData['telefone']);
        $violacao->setDescricao($requestData['descricao']);
        $violacao->setArquivo($requestData['arquivo']);
        $violacao->setCliente($requestData['cliente']);

        return $this->dao->save($violacao);
    }

    
    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function get(array $requestData): array
    {
        $violacao = new Violacao();
        $violacao->setCliente($requestData['cliente']);
        return $this->dao->get($violacao);
    }

    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function getByCode(array $requestData): array
    {
        $violacao = new Violacao();
        $violacao->setCodigo($requestData['codigo']);

        return $this->dao->getByCode($violacao);
    }

    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function getStatusByCode(array $requestData): array
    {
        $violacao = new Violacao();
        $violacao->setId($requestData['id']);
        $violacao->setCliente($requestData['cliente']);

        return $this->dao->getStatusByCode($violacao);
    }

    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function updateStatus(array $requestData): array
    {
        $violacao = new Violacao();
        $status = new Status();

        $violacao->setId($requestData['id']);
        $status->id = $requestData['id_status'];
        $violacao->setStatus($status);

        return $this->dao->updateStatus($violacao);
    }
}
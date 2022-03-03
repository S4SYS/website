<?php

require_once 'app/dao/ViolacaoDao.php';
require_once 'app/model/Violacao.php';

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

        return $this->dao->save($violacao);
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->dao->get();
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
    
}
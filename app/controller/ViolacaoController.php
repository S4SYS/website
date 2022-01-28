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

        $violacao->setCodigo(base64_encode(date('Y-m-d H:i:s')));
        $violacao->setDescricao($requestData['descricao']);

        return $this->dao->save($violacao);
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
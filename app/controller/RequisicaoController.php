<?php

require_once 'app/dao/RequisicaoDao.php';
require_once 'app/model/Requisicao.php';
require_once 'app/model/Setor.php';
require_once 'app/model/TipoRequisicao.php';

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

        $requisicao->setCodigo($this->createRequisicaoCode($requestData['cpf']));
        $requisicao->setPedido($requestData['pedido']);
        $requisicao->setCpf($requestData['cpf']);
        $requisicao->setTelefone($requestData['telefone']);
        $requisicao->setEmail($requestData['email']);
        $requisicao->setArquivo($requestData['arquivo']);
        $requisicao->setSetor($setor);
        $requisicao->setTipoRequisicao($tipoRequisicao);

        return $this->dao->save($requisicao);
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
     * @param string $cpf
     * 
     * @return string
     */
    private function createRequisicaoCode(string $cpf): string
    {
        $now = date('Y-m-d H:i:s');

        return base64_encode("{$cpf}##{$now}");
    }
    
}
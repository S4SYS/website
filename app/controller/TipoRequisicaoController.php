<?php

require_once 'app/dao/TipoRequisicaoDao.php';
require_once 'app/model/TipoRequisicao.php';

final class TipoRequisicaoController
{
    private $dao;

    /**
     */
    public function __construct()
    {
        $this->dao = new TipoRequisicaoDao();
    }


    /**
     * @return array
     */
    public function get(): array
    {
        $rs = $this->dao->get();

        if(!$rs['success']) return $rs;
        
        $dados = $rs['data'];
        $tiposRequisicao = [];
        foreach($dados as $d){
            $tipoRequisicao = new TipoRequisicao();
            $tipoRequisicao->id = $d['id'];
            $tipoRequisicao->nome = $d['nome'];
            $tiposRequisicao[] = $tipoRequisicao;
        }

        return ['success' => true, 'data' => $tiposRequisicao];
    }
}

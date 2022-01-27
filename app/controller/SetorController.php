<?php

require_once 'app/dao/SetorDao.php';
require_once 'app/model/Setor.php';

final class SetorController
{
    private $dao;

    /**
     */
    public function __construct()
    {
        $this->dao = new SetorDao();
    }


    /**
     * @return array
     */
    public function get(): array
    {
        $rs = $this->dao->get();

        if(!$rs['success']) return $rs;

        $dados = $rs['data']; 
        $setores = [];
        foreach($dados as $d){
            $setor = new Setor();
            $setor->id = $d['id'];
            $setor->nome = $d['nome'];
            $setores[] = $setor;
        }

        return ['success' => true, 'data' => $setores];
    }
}

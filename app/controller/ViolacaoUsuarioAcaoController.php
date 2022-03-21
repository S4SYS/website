<?php

require_once 'app/dao/ViolacaoUsuarioAcaoDao.php';
require_once 'app/model/Violacao.php';
require_once 'app/model/UsuarioAcao.php';
require_once 'app/model/ViolacaoUsuarioAcao.php';

final class ViolacaoUsuarioAcaoController
{
    private $dao;

    public function __construct()
    {
        $this->dao = new ViolacaoUsuarioAcaoDao();        
    }

    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function save(array $requestData): array
    {
        $violacao = new Violacao();
        $usuarioAcao = new UsuarioAcao();
        $violacaoUsuarioAcao = new ViolacaoUsuarioAcao;

        $violacao->id  = $requestData['id_violacao'];
        $usuarioAcao->id = $requestData['id_usuario_acao'];

        $violacaoUsuarioAcao->setViolacao($violacao);
        $violacaoUsuarioAcao->setUsuarioAcao($usuarioAcao);

        return $this->dao->save($violacaoUsuarioAcao);
    }
}
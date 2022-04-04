<?php

require_once 'AbstractModel.php';
require_once 'Violacao.php';
require_once 'UsuarioAcao.php';

final class ViolacaoUsuarioAcao extends AbstractModel
{
    public $violacao;
    public $usuarioAcao;

    
    /**
     * @return Violacao
     */
    public function getViolacao(): Violacao
    {
        return $this->violacao;
    }

    
    /**
     * @param Violacao $violacao
     * 
     * @return void
     */
    public function setViolacao(Violacao $violacao)
    {
        $this->violacao = $violacao;
    }


    /**
     * @return UsuarioAcao
     */
    public function getUsuarioAcao(): UsuarioAcao
    {
        return $this->usuarioAcao;
    }

    /**
     * @param UsuarioAcao $usuarioAcao
     * 
     * @return void
     */
    public function setUsuarioAcao(UsuarioAcao $usuarioAcao)
    {
        $this->usuarioAcao = $usuarioAcao;
    }
}
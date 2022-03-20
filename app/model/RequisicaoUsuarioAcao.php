<?php

require_once 'AbstractModel.php';
require_once 'Requisicao.php';
require_once 'UsuarioAcao.php';

final class RequisicaoUsuarioAcao extends AbstractModel
{
    public $requisicao;
    public $usuarioAcao;

    /**
     * @return Requisicao
     */
    public function getRequisicao(): Requisicao
    {
        return $this->requisicao;
    }

    /**
     * @param Requisicao $requisicao
     * 
     * @return void
     */
    public function setRequisicao(Requisicao $requisicao): void
    {
        $this->requisicao = $requisicao;
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
    public function setUsuarioAcao(UsuarioAcao $usuarioAcao): void
    {
        $this->usuarioAcao = $usuarioAcao;
    }
}
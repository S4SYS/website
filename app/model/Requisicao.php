<?php

require_once 'AbstractModel.php';
require_once 'Setor.php';
require_once 'TipoRequisicao.php';

final class Requisicao extends AbstractModel
{
    public $pedido;
    public $setor;
    public $tipoRequisicao;

    /**
     * @return string
     */
    public function getPedido(): string
    {
        return $this->pedido;
    }

    /**
     * @param string $pedido
     * 
     * @return void
     */
    public function setPedido(string $pedido): void
    {
        $this->pedido = $pedido;
    }
    
    /**
     * @return Setor
     */
    public function getSetor(): Setor
    {
        return $this->setor;
    }

    /**
     * @param Setor $setor
     * 
     * @return void
     */
    public function setSetor(Setor $setor): void
    {
        $this->setor = $setor;
    }

    /**
     * @return TipoRequisicao
     */
    public function getTipoRequisicao(): TipoRequisicao
    {
        return $this->tipoRequisicao;
    }

    /**
     * @param TipoRequisicao $tipoRequisicao
     * 
     * @return void
     */
    public function setTipoRequisicao(TipoRequisicao $tipoRequisicao): void
    {
        $this->tipoRequisicao = $tipoRequisicao;
    }

}
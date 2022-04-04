<?php

require_once 'AbstractModel.php';
require_once 'Setor.php';
require_once 'TipoRequisicao.php';
require_once 'Status.php';


final class Requisicao extends AbstractModel
{
    const TABLE = 'requisicao';

    public $pedido;
    public $setor;
    public $tipoRequisicao;
    public $status;

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
    public function setPedido(string $pedido)
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
    public function setSetor(Setor $setor)
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
    public function setTipoRequisicao(TipoRequisicao $tipoRequisicao)
    {
        $this->tipoRequisicao = $tipoRequisicao;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @param Status $status
     * 
     * @return void
     */
    public function setStatus(Status $status)
    {
        $this->status = $status;
    }
    
}
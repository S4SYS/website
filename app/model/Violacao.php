<?php

require_once 'AbstractModel.php';
require_once 'Status.php';

final class Violacao extends AbstractModel
{
    public $descricao;
    public $status;


    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param string $codigo
     * 
     * @return void
     */
    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
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
    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }
}
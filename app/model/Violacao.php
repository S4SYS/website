<?php

require_once 'AbstractModel.php';

final class Violacao extends AbstractModel
{
    public $descricao;


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

}
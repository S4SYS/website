<?php

final class violacao
{
    public $id;
    public $codigo;
    public $descricao;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * 
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getCodigo(): string
    {
        return $this->codigo;
    }

    /**
     * @param string $codigo
     * 
     * @return void
     */
    public function setCodigo(string $codigo): void
    {
        $this->codigo = $codigo;
    }


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
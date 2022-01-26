<?php

final class Setor
{
    public $id;
    public $nome;

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
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * 
     * @return void
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }
    
}
<?php

abstract class AbstractModel
{
    public $id;
    public $codigo;
    public $cpf;
    public $telefone;
    public $email;
    public $arquivo;
    public $nome;
    public $descricao;
    public $ativo;

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
    public function getCpf(): string
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     * 
     * @return void
     */
    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }

    /**
     * @return string
     */
    public function getTelefone(): string
    {
        return $this->telefone;

    }

    /**
     * @param string $telefone
     * 
     * @return void
     */
    public function setTelefone(string $telefone): void
    {
        $this->telefone = $telefone;
    }


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;

    }

    /**
     * @param string $email
     * 
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    
    /**
     * @return string|null
     */
    public function getArquivo(): ?string
    {
        return $this->arquivo;

    }

    
    /**
     * @param string|null $arquivo
     * 
     * @return void
     */
    public function setArquivo(?string $arquivo): void
    {
        $this->arquivo = $arquivo;
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


    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;

    }

    /**
     * @param string $email
     * 
     * @return void
     */
    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }


    /**
     * @return bool
     */
    public function getAtivo(): bool
    {
        return $this->ativo;
    }

    /**
     * @param bool $ativo
     * 
     * @return void
     */
    public function setAtivo(bool $ativo): void
    {
        $this->ativo = $ativo;
    }
}
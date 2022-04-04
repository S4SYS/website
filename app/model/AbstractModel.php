<?php

require_once 'Cliente.php';

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
    public $cliente;

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
    public function setId(int $id)
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
    public function setCodigo(string $codigo)
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
    public function setCpf(string $cpf)
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
    public function setTelefone(string $telefone)
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
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    
    /**
     * @return string|null
     */
    public function getArquivo()
    {
        return $this->arquivo;

    }

    
    /**
     * @param string|null $arquivo
     * 
     * @return void
     */
    public function setArquivo($arquivo)
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
    public function setNome(string $nome)
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
    public function setDescricao(string $descricao)
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
    public function setAtivo(bool $ativo)
    {
        $this->ativo = $ativo;
    }

    /**
     * @return Cliente
     */
    public function getCliente(): Cliente
    {
        return $this->cliente;
    }

    /**
     * @param Cliente $cliente
     * 
     * @return void
     */
    public function setCliente(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }
}
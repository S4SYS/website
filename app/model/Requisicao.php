<?php

require_once 'Setor.php';
require_once 'TipoRequisicao.php';

final class Requisicao
{
    public $id;
    public $codigo;
    public $pedido;
    public $cpf;
    public $telefone;
    public $email;
    public $arquivo;
    public $setor;
    public $tipoRequisicao;


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
     * @return string
     */
    public function getArquivo(): string
    {
        return $this->arquivo;

    }

    /**
     * @param string $arquivo
     * 
     * @return void
     */
    public function setArquivo(string $arquivo): void
    {
        $this->arquivo = $arquivo;
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
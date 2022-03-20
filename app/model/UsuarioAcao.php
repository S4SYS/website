<?php

require_once 'AbstractModel.php';
require_once 'Usuario.php';
require_once 'Acao.php';


final class UsuarioAcao extends AbstractModel
{
    public $usuario;
    public $acao;
    public $comentario;
    public $tabela;
    public $atual_id;
    public $anterior_id;

    /**
     * @return Usuario
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     * 
     * @return void
     */
    public function setUsuario(Usuario $usuario): void
    {
        $this->usuario = $usuario;
    }

    /**
     * @return Acao
     */
    public function getAcao(): Acao
    {
        return $this->acao;
    }

    /**
     * @param Acao $acao
     * 
     * @return void
     */
    public function setAcao(Acao $acao): void
    {
        $this->acao = $acao;
    }

    /**
     * @return string
     */
    public function getComentario(): string
    {
        return $this->comentario;
    }

    /**
     * @param string $comentario
     * 
     * @return void
     */
    public function setComentario(string $comentario): void
    {
        $this->comentario = $comentario;
    }

    /**
     * @return string
     */
    public function getTabela(): string
    {
        return $this->tabela;
    }

    /**
     * @param string $tabela
     * 
     * @return void
     */
    public function setTabela(string $tabela): void
    {
        $this->tabela = $tabela;
    }

    /**
     * @return int
     */
    public function getAtualId(): int
    {
        return $this->atual_id;
    }

    /**
     * @param int $atual_id
     * 
     * @return void
     */
    public function setAtualId(int $atual_id): void
    {
        $this->atual_id = $atual_id;
    }

    /**
     * @return int
     */
    public function getAnteriorId(): int
    {
        return $this->anterior_id;
    }

    /**
     * @param int $anterior_id
     * 
     * @return void
     */
    public function setAnteriorId(int $anterior_id): void
    {
        $this->anterior_id = $anterior_id;
    }
    
}
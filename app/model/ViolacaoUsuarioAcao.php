<?php

require_once 'AbstractModel.php';
require_once 'Violacao.php';
require_once 'UsuarioAcao.php';

final class ViolacaoUsuarioAcao extends AbstractModel
{
    public $violacao;
    public $usuarioAcao;

    
    /**
     * @return Violacao
     */
    public function getViolacao(): Violacao
    {
        return $this->violacao;
    }

    
    /**
     * @param Violacao $violacao
     * 
     * @return void
     */
    public function setViolacao(Violacao $violacao): void
    {
        $this->violacao = $violacao;
    }
}
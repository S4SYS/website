<?php

require_once 'AbstractModel.php';

final class Cliente extends AbstractModel
{
    public $dominio;
    public $token;
    public $ultimo_acesso;

    /**
     * @return string
     */
    public function getDominio(): string
    {
        return $this->dominio;
    }

    /**
     * @param string $dominio
     * 
     * @return void
     */
    public function setDominio(string $dominio): void
    {
        $this->dominio = $dominio;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * 
     * @return void
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }
    
    /**
     * @return string
     */
    public function getUltimoAcesso(): string
    {
        return $this->ultimo_acesso;
    }

    /**
     * @param string $ultimo_acesso
     * 
     * @return void
     */
    public function setUltimoAcesso(string $ultimo_acesso): void
    {
        $this->ultimo_acesso = $ultimo_acesso;
    }
}
<?php

require_once 'AbstractModel.php';

final class Usuario extends AbstractModel
{
    private $login;
    private $senha;
    public  $last_login;

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * 
     * @return void
     */
    public function setLogin(string $login)
    {
        $this->login = $login;
    }


    /**
     * @return string
     */
    public function getSenha(): string
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     * 
     * @return void
     */
    public function setSenha(string $senha)
    {
        $this->senha = $senha;
    }


    /**
     * @return string
     */
    public function getLastLogin(): string
    {
        return $this->last_login;
    }

    /**
     * @param string $lastLogin
     * 
     * @return void
     */
    public function setLastLogin(string $last_login)
    {
        $this->last_login = $last_login;
    }
}
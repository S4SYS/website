<?php

require_once 'app/dao/UsuarioDao.php';
require_once 'app/model/Usuario.php';

final class UsuarioController
{
    private $dao;

    /**
     */
    public function __construct()
    {
        $this->dao = new UsuarioDao();
    }


    /**
     * @param array $requestParams
     * 
     * @return array
     */
    public function authenticate(array $requestParams): array
    {
        $usuario = new Usuario();
        $usuario->setLogin($requestParams['login']);
        $usuario->setSenha(sha1($requestParams['senha']));

        return $this->dao->authenticate($usuario);
    }
}
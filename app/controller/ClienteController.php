<?php

require_once 'app/dao/ClienteDao.php';
require_once 'app/model/Cliente.php';

final class ClienteController
{
    private $dao;

    public function __construct()
    {
        $this->dao = new ClienteDao();
    }

    /**
     * @param string $token
     * 
     * @return array
     */
    public function getByToken(string $token): array
    {
        $cliente = new Cliente();
        $cliente->setToken($token);

        return $this->dao->getByToken($cliente);
    }
}
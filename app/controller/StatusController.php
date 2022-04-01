<?php

require_once 'app/dao/StatusDao.php';
require_once 'app/model/Status.php';

final class StatusController
{
    private $dao;

    /**
     */
    public function __construct()
    {
        $this->dao = new StatusDao();
    }

    
    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function get(array $requestData): array
    {
        $status = new Status();
        $status->setCliente($requestData['cliente']);
        return $this->dao->get($status);
    }

    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function getByCode(array $requestData): array
    {
        $status = new Status();
        $status->setId($requestData['id']);
        $status->setCliente($requestData['cliente']);

        return $this->dao->getByCode($status);
    }

    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function save(array $requestData): array
    {
        $status = new Status();
        $status->setId($requestData['id']);
        $status->setNome($requestData['nome']);
        $status->setCliente($requestData['cliente']);

        return $this->dao->save($status);
    }

    /**
     * @param array $requestData
     * 
     * @return array
     */
    public function update(array $requestData): array
    {
        $status = new Status();
        $status->setId($requestData['id']);
        $status->setNome($requestData['nome']);
        $status->setCliente($requestData['cliente']);

        return $this->dao->update($status);
    }
}

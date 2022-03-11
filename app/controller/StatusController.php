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
     * @return array
     */
    public function get(): array
    {
        return $this->dao->get();
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

        return $this->dao->save($status);
    }
}

<?php

require_once 'app/dao/StatusDao.php';

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
}

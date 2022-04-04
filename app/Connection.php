<?php

require_once 'Config.php';

abstract class Connection
{           
    private $connector;    
    
    /**
     * @return PDO|null
     */
    protected function getInstance()
    {
        if($this->connector === null){
            $this->connector = new PDO('mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME, Config::DB_USER, Config::DB_PASS);
            $this->connector->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }       

        return $this->connector;
    }
}
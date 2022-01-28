<?php

abstract class Connection
{
    /*    
    const DB_HOST = 'localhost';
    const DB_NAME = 'portal_lgpd';
    const DB_USER = 'root';
    const DB_PASS = '';
    */
    
        
    const DB_HOST = 'localhost';
    const DB_NAME = 'id17253219_portal_lgpd';
    const DB_USER = 'id17253219_root';
    const DB_PASS = 'zgGr1!JD(Jh}4(mu';
    
    private $connector;    
    
    /**
     * @return PDO|null
     */
    protected function getInstance(): ?PDO
    {
        if($this->connector === null){
            $this->connector = new PDO('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME, self::DB_USER, self::DB_PASS);
            $this->connector->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }       

        return $this->connector;
    }
}
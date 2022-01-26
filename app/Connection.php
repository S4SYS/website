<?php

abstract class Connection
{
    const DB_HOST = 'localhost';
    const DB_NAME = 'portal_lgpd';
    const DB_USER = 'root';
    const DB_PASS = '';

    private static $connector;
    
    /**
     * @return void
     */
    public static function getInstance(): void
    {
        if(self::$connector === null){
            self::$connector = new PDO('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME, self::DB_USER, self::DB_PASS);
            self::$connector->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }
}
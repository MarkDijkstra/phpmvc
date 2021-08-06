<?php

namespace Core;

use PDO;

class Database
{

    /**
     * It represents a PDO instance
     *
     * @var object
     */
    public $db = null;

    /**
     * The database construct
     */
    public function __construct($table_name = null) 
    {
        if ($this->db === null) {            
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';

            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_CASE => PDO::CASE_LOWER
             );
            
            $this->db = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
        }

       // parent::__construct($table_name);
    }

    public function disconnect()
    {
        //todo
    }

    /**
     * The method return a PDO database connection.
     *
     * @return object
     */
    // protected static function DB() : PDO 
    // {
    //     return static::$db;
    // }
}
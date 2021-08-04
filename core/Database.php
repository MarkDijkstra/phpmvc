<?php

namespace Core;

use PDO;

class Database extends Query
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
    public function __construct($table_name) 
    {
        if ($this->db === null) {            
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';

            $options = [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
            
            $this->db = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
        }

        parent::__construct($table_name);
    }

    /**
     * The method return a PDO database connection.
     *
     * @return object
     */
    // protected function DB(): PDO 
    // {
    //     return static::$db;
    // }
}
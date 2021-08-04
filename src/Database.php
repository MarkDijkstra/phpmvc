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
    static $db = null;

    /**
     * The name of the table in the database that the model binds
     *
     * @var string
     */
    private $_table;

    /**
     * The model construct
     */
    public function __construct($table_name) 
    {
        if (static::$db === null) {            
            $conn_string = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
            $db = new \PDO($conn_string, DB_USER, DB_PASSWORD);

            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            static::$db = $db;
        }
        
        $this->_table = $table_name;
    }

    /**
     * The method return a PDO database connection.
     *
     * @return object
     */
    protected function DB(): PDO 
    {
        return static::$db;
    }
}
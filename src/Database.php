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
    protected $connect = null;

    /**
     * The name of the table in the database that the model binds
     *
     * @var string
     */
    private $_table;

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
        if ($this->connect === null) {            
            $conn_string = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
            $this->connect = new \PDO($conn_string, DB_USER, DB_PASSWORD);

            $this->connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        
        $this->_table = $table_name;
        $this->db = $this->connect;
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
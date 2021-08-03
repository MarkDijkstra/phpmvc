<?php

namespace Core;

use PDO;

abstract class Model 
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
     * Abstract method for getting all records from database.
     * 
     * @return array
     */
    abstract function getAll(): iterable;

    /**
     * The insert method.
     * 
     * @param array $data A set of data to be added to the database.
     * @return integer The last insert ID
     */
    public function insert(array $data): int 
    {
        if($this->_table === ""){
            throw new \Exception("Attribute _table is empty string!");
        }
        
        $marks = array_fill(0, count($data), '?');
        $fields = array_keys($data);
        $values = array_values($data);

        $stmt = $this->DB()->prepare("
            INSERT INTO " . $this->_table . "(" . implode(",", $fields) . ")
            VALUES(" . implode(",", $marks) . ")
        ");

        $stmt->execute($values);

        return $this->DB()->lastInsertId();
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
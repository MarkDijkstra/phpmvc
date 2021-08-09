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
    public $pdo = null;

    /**
     * The database construct
     */
    public function __construct($table_name = null) 
    {
        if ($this->pdo === null) {            
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset='.DB_CHAR;

            $options = array(
                PDO::ATTR_PERSISTENT         => true,
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            );

            try {
                $this->pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
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
    // protected static function DB(): PDO 
    // {
    //     return static::$pdo;
    // }
}
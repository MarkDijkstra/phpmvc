<?php

namespace Core;

use PDO;

class Query extends Database
{
    /**
    * @var string table name that is used.
    */
    private $table;
    /**
    * @var object the PDO object
    */
    private $stmt;


    private $from;
    private $columns;
    private $limit;
    private $where;
    private array $whereKeys = [];
    private $whereValues = [];
    private $sql;
    private $db;

    /**
     * The model construct
     */
    public function __construct() 
    {
        parent::__construct();
        $this->db = $this->pdo;
    }
        
    /**
     * Method queryBuilder
     *
     * @param $sql Query to run
     * @return object
     */
    private function queryBuilder(): object
    {

        // $this->sql = 'SELECT';

        // if ($this->limit) { 

        // }

        $this->sql = 'SELECT '.$this->columns.' FROM '.$this->table. ' LIMIT '.$this->limit;

        if ($this->where) {
            $this->stmt = $this->db->prepare($this->sql);
            $this->execute();
        } else {
            $this->stmt = $this->db->query($this->sql);
        }
        return $this;
    }
    
    /**
     * Method select
     *
     * @param $columns The columns that are selected
     * @return object
     */
    public function select($columns = '*'): object
    {
        if ($columns) { 
            // todo: filtering and options
        }
        
        $this->columns = $columns;
        return $this;
    }
    
    /**
     * Method from
     *
     * @param String $table Select the table to retrive the data from
     * @return object
     */
    public function from(String $table): object
    {
        $this->table = $table;
        return $this;
    }

    public function where($where = null)
    {
        $this->where = $where;
        return $this;
    }

    /**
     * Method all
     *
     * @return array
     */    
    public function all() : array
    {
        $this->queryBuilder();
        $this->stmt = $this->stmt->fetchAll();
        
        return $this->stmt;
    }

    /**
     * Method one
     *
     * @return array
     */  
    public function one() : array
    {
        $this->execute();
        $this->stmt = $this->stmt->fetch();
        
        return $this->stmt;
    }
    
    public function orderBy()
    {
        
    }

    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function count()
    {
        
    }

    public function find()
    {
        
    }

    public function findOne()
    {
        
    }
    
    public function update()
    {
       
    }

    public function delete()
    {
        
    }
    
    public function first()
    {

    }

    public function last()
    {

    }

    public function toObject()
    {

    }

    /**
     * Method toArray
     *
     * @return array
     */
    public function toArray() : array
    {
        return json_decode(json_encode((array) $this->stmt), true);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }
    
    public function dropTable($tableName = '')
    {

    }

    public function sql()
    {
        
    }
}
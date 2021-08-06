<?php

namespace Core;

use PDO;

class Query extends Database
{
 
    private $table;
    private $stmt;
    private $from;
    private $columns;

    /**
     * The model construct
     * 
     * @param $table the name of the table
     */
    public function __construct() 
    {
       parent::__construct();
    }
        
    /**
     * Method query
     *
     * @param $sql Query to run
     * @return object
     */
    private function query($sql) : object
    {
        $this->stmt = $this->db->prepare($sql);
        $this->execute();
        return $this;
    }
    
    /**
     * Method select
     *
     * @param $columns The columns that are selected
     * @return object
     */
    public function select($columns = '*') : object
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
    public function from(String $table) : object
    {
        $this->table = $table;
        return $this;
    }

    public function where()
    {
        
    }

    /**
     * Method all
     *
     * @return array
     */    
    public function all() : array
    {
        $this->query('SELECT '.$this->columns.' FROM '.$this->table);
        $this->stmt  = $this->stmt->fetchAll(PDO::FETCH_ASSOC);

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
        $this->stmt = $this->stmt->fetch(PDO::FETCH_ASSOC);
        
        return $this->stmt;
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
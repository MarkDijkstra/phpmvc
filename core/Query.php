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
    * @var object the PDO object.
    */
    private $stmt;
    /**
    * @var mixed columns that are selected.
    */
    private $columns;
    /**
    * @var int max results to output.
    */
    private $limit;



   
    private $whereKeys;
    private $whereValues;
    private $orderBy;

    private $sql;
    private $db;
    private $distinct;

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
        $this->sql = 'SELECT '.$this->columns.' FROM '.$this->table;

        if ($this->whereKeys && $this->whereValues) {
           $this->sql .= ' WHERE '.$this->whereKeys.'=? ';
        }

        if ($this->orderBy) {
            $this->sql .= ' ORDER BY '.$this->orderBy;
        }

        if ($this->limit) {
            $this->sql .= ' LIMIT '.$this->limit;
        }

        if ($this->whereKeys && $this->whereValues) {
            $this->stmt = $this->db->prepare($this->sql);
            $this->execute($this->whereValues);
        } else {
            $this->stmt = $this->db->query($this->sql);
        }
        
        return $this;
    }
    
    /**
     * Method select
     * 
     * @todo add type hinting(union types) for PHP8 https://wiki.php.net/rfc/union_types_v2
     * @param String|Array $columns The columns that are selected
     * @return object
     */
    public function select($columns = '*'): object
    {
        $this->columns = $columns;

        if (is_array($this->columns)) { 
            $this->columns = implode(',', $this->columns);
        }

        return $this;
    }
    
    /**
     * Method from
     *
     * @param String $table Select the table to retrive the data from
     * @return object
     */
    public function from(string $table = null): object
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Method where
     *
     * @todo add logic to handle complex statements
     * @param array $where the where statement
     * @return object
     */
    public function where(array $where = []): object
    {
        foreach($where as $key => $value) {
            $this->whereKeys[] = $key;
            $this->whereValues[] = $value;
        }

        $this->whereKeys =implode(',', $this->whereKeys);

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
        $this->queryBuilder();
        $this->stmt = $this->stmt->fetch();
        
        return $this->stmt;
    }



    
    public function orderBy(array $orderBy = [])
    {
        $combine = '';


 
           // if (array() === $arr) return false;


        if (array_keys($orderBy) !== range(0, count($orderBy) - 1)) {
            foreach($orderBy as $key => $value) {
              $combine .= $key . ' ' . strtoupper($value) . ',';
            }
        } else {
            foreach($orderBy as $value) {             
                $combine .= $value.',';
             }
        }

        $combine = rtrim($combine, ',');

        $this->orderBy = $combine;

        return $this;
    }
    
    /**
     * Method limit
     *
     * @param Integer $limit the max of records to show
     * @return object
     */
    public function limit($limit = null): object
    {
        $this->limit = $limit;

        return $this;
    }

    public function distinct()
    {
        
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

    public function execute(array $values)
    {
        return $this->stmt->execute($values);
    }
    
    public function dropTable($tableName = '')
    {

    }

    public function sql()
    {
        
    }
}
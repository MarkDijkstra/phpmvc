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
    /**
    * @var array order by.
    */
    private $order;
    /**
    * @var array group by.
    */
    private $group;

   
    private $whereKeys;
    private $whereValues;
   

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
        if ($this->distinct) {
            $this->sql .= 'SELECT DISTINCT ';
        } else {
            $this->sql .= 'SELECT ';
        }

        $this->sql .= $this->columns.' FROM '.$this->table;

        if ($this->whereKeys && $this->whereValues) {
           $this->sql .= ' WHERE '.$this->whereKeys.'=? ';
        }

        if ($this->group) {
            $this->sql .= ' GROUP BY '.$this->group;
        }

        if ($this->order) {
            $this->sql .= ' ORDER BY '.$this->order;
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
        return $this->dataToString('columns', $columns);
    }
    
    /**
     * Method from
     *
     * @param String $table select the table to retrive the data from
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
     * @todo add logic to handle complex WHERE statements
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
    public function all(): array
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
    public function one(): array
    {
        $this->queryBuilder();
        $this->stmt = $this->stmt->fetch();
        
        return $this->stmt;
    }

    /**
     * Method order
     *
     * @param array $order the orderby statement
     * @return object
     */
    public function order(array $order = []): object
    {
        if (array_keys($order) !== range(0, count($order) - 1)) {
            foreach($order as $key => $value) {
                $this->order .= $key . ' ' . strtoupper($value) . ',';
            }
        } else {
            foreach($order as $value) {             
                $this->order .= $value.',';
             }
        }

        $this->order = rtrim($this->order, ',');

        return $this;
    }
        
    /**
     * Method group
     *
     * @param mixed $group the columns to group
     * @return object
     */
    public function group($group = null): object
    {
        return $this->dataToString('group', $group);
    }
    
    /**
     * Method limit
     *
     * @param Integer $limit the max of records to show
     * @return object
     */
    public function limit(int $limit = null): object
    {
        $this->limit = $limit;

        return $this;
    }
    
    /**
     * Method distinct
     *
     * @return object
     */
    public function distinct(): object
    {
        $this->distinct = true;

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

    public function execute(array $values)
    {
        return $this->stmt->execute($values);
    }
    
    public function dropTable($tableName = '')
    {

    }

    public function raw()
    {
        
    }

    /**
     * Method dataToString
     * 
     * As some methods allow using both a String and Array input we make sure that 
     * arrays are always convert to a string
     *
     * @param string $type the property that we are going to set
     * @param mixed $value the data that when it is an array we convert to a string
     * @return object
     */
    public function dataToString(string $type, $value): object
    {
        $this->{$type} = $value;

        if (is_array($type)) { 
            $type = implode(',', $type);
        }

        return $this;
    }    
}
<?php

namespace Core;

use PDO;

class Query
{
 
    private $table;
    private $dbh;
    private $stmt;

    /**
     * The model construct
     * 
     * @param $table the name of the table
     */
    public function __construct($table_name) 
    {
        $this->table = $table_name;
    }
    

    public function query($query = null): void
    {
        $this->stmt = $this->db->prepare($query);
    }

    public function execute()
    {
        $this->stmt->execute();
    }



    /**
     * Method all
     *
     * @param $table the name of the table
     * @return array
     */    
    public function all($table = null): array 
    {
        if(!$table) {
           $table = $this->table;
        }
        
        $query = $this->db->prepare('SELECT * FROM '.$table);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
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

    
    /**
     * Method dropTable
     *
     * @param $tableName $tableName Name of the table.
     *
     * @return void
     */
    public function dropTable($tableName = '')
    {
        $query = "DROP TABLE $tableName";
        $result = '';

        if ($result) {
            $this->result = "Table has been dropped";
            return true;
        }

        return false;
    }

    public function sql()
    {
        
    }

}
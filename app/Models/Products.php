<?php

namespace App\Models;

use Core\Model;

class Products extends Model 
{
    private $table = 'products';

    /**
     * The model construct
     *
     */
    public function __construct() {

        /**
         * The database table name.
         */
        parent::__construct($this->table);
    }

    /**
     * Method getting all records from database.
     * [Implemented method from the Model class]
     *
     * @return array
     */
    public function getAll(): iterable 
    {
        return $this->db->query('SELECT * FROM '.$this->table)->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Method getting last 10 records from database.
     *
     * @return array
     */
    public function getLastTen(): iterable {

        return $this->db->query('SELECT o.*, c.first_name, c.last_name, '
                                . 'cn.name as country_name, d.name as device_name '
                                . 'FROM orders as o '
                                . 'LEFT JOIN customers as c ON (o.customer_id = c.id) '
                                . 'LEFT JOIN countries as cn ON (o.country_id = cn.id) '
                                . 'LEFT JOIN devices as d ON (o.device_id = d.id) '
                                . 'ORDER BY id DESC '
                                . 'LIMIT 10')
                        ->fetchAll(\PDO::FETCH_ASSOC);
    }
}
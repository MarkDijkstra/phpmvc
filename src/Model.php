<?php

namespace Core;

class Model extends Database
{
    /**
     * The model construct
     */
    public function __construct($table_name) 
    {
        parent::__construct($table_name);
    }
}
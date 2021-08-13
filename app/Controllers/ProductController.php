<?php

namespace App\Controllers;

use Core\{Controller, View, Query};

class ProductController extends Controller 
{
    /**
     * The index controller action
     * 
     * @param int $id the id of the product(s)
     * @return void
     */
    public function index(int $id = null): void 
    {
        $q = new Query;
        $results = null;

        if ($id) {
            // for this example use an associatve array so that we dont have 
            // to change the foreach loop 
            $results[0] = $q->select()->where(['id'=>$id])->from('products')->one();
        } else {
            $results = $q->select()->from('products')->order(['name' => 'asc'])->all();
        }

        View::render("products", ['products'=>$results]);
    }
}
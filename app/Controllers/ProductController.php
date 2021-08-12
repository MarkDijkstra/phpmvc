<?php

namespace App\Controllers;

use Core\{Controller, View, Query};

class ProductController extends Controller 
{
    /**
     * The index controller action
     * 
     * @return void
     */
    public function index(int $id = null): void 
    {

       // print_r($_GET);
        $q = new Query;
        $results = null;

        if ($id) {
            // for this example use an associatve array
            $results[0] = $q->select()->where(['id'=>$id])->from('products')->one();
        } else {
            $results = $q->select()->from('products')->order(['name' => 'asc'])->all();
        }

        View::render("products", ['products'=>$results]);
    }
}
<?php

namespace App\Controllers;

use Core\{Controller, View, Query, Request};

class ProductController extends Controller 
{
    /**
     * The index controller action
     * 
     * @return void
     */
    public function index(): void 
    {
        $id = Request::getParam('id');
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
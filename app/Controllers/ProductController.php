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
        $q = new Query;
        $results = null;

       // $id =2;

        if ($id) {
           // $results= 
        } else {
            $results = $q->select()->from('products')->orderBy(['name' => 'asc'])->all();
        }

        View::render("products", ['products'=>$results]);
    }
}
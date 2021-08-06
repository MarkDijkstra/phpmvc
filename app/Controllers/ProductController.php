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
        $products = new Query;
        $results = null;

       // $id =2;

        if ($id) {
           // $results= $products->db->findOne($id);
        } else {
            $results = $products->select()->from('products')->all();
        }

        View::render("products", ['products'=>$results]);
    }
}
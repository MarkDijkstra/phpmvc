<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class ProductController extends Controller 
{
    /**
     * The index controller action
     * 
     * @return void
     */
    public function index(int $id = null): void 
    {
        $products = new \App\Models\Products;
        $results = null;

       // $id =2;

        if ($id) {
            //$results= $products->db->findOne($id);
        } else {
            $results = $products->all();
        }

        View::render("products", ['products'=>$results]);
    }
}
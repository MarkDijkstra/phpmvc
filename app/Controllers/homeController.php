<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class HomeController extends Controller 
{
    /**
     * The index controller action
     * 
     * @return void
     */
    public function index(): void 
    {
        View::render("home");
    }
}
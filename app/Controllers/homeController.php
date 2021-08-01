<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\View;
use Core\Validator;

class Home extends Controller 
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
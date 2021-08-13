<?php

use Core\Route;

Route::get('/', ['HomeController','index']);
Route::get('products/{id}', ['ProductController','index']);
Route::get('404', ['NotfoundController','index']);
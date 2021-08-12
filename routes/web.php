<?php

use Core\Route;

Route::get('/', ['HomeController','index']);
Route::get('products/{id}{category}/{test}', ['ProductController','index']);
Route::get('404', ['NotfoundController','index']);

return [
    "GET" => [
        "/" => "HomeController@index",
        "products" => "ProductController@index",
        "404" => "NotfoundController@index"
    ]
];







<?php

return [
    "GET" => [
        "/" => "HomeController@index",
        "about" => "AboutController@index",
        "products" => "ProductController@index",
        "404" => "NotfoundController@index"
    ]
];
<?php

return [
    "GET" => [
        "/" => "HomeController@index",
        "about" => "AboutController@index",
        "products/:id" => "ProductController@index",
        "404" => "NotfoundController@index"
    ]
];
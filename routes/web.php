<?php

return [
    "GET" => [
        "/" => "HomeController@index",
        "about" => "AboutController@index",
        "product" => "ProductController@index",
        "404" => "NotfoundController@index"
    ]
];
<?php

namespace Core;

class Url
{
    /**
     * The base path
     *
     * @var string
     */
    protected $base;

    public function __construct() 
    {   
        $path = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://". $_SERVER["SERVER_NAME"]. dirname($_SERVER["PHP_SELF"]);
        $path = str_replace('/public', '', $path);
        $this->base = $path;
    }

    public function path(string $path): string 
    {
        return $this->base.$path;
    }
}
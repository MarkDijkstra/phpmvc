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
        $path = str_replace(PUBLIC_DIR, '', $path);
        $this->base = $path;
    }

    /**
     * Path
     *
     * @param string $path the url to navigate to
     * @return string
     */
    public function path(string $path): string 
    {
        return $this->base.$path;
    }
    
    /**
     * Home path
     *
     * @return string
     */
    public function home(): string 
    {
        return $this->base.'/';
    }
    
    /**
     * Resource path
     *
     * @param string $path the file thats beeing called
     * @return string
     */
    public function resource(string $path): string 
    {
        return RESOURCES_DIR.'/'.$path;
    }
    
    public function relativePath()
    {
    }

    public function absolutePath()
    {
    }
}
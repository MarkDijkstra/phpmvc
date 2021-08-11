<?php

namespace Core;

class Url
{
    private static function basePath(): string 
    {
        $path = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://". $_SERVER["SERVER_NAME"]. dirname($_SERVER["PHP_SELF"]);
        return str_replace(PUBLIC_DIR, '', $path);
    }

    /**
     * Path
     *
     * @param string $path the url to navigate to
     * @return string
     */
    public static function path(string $path): string 
    {
        return self::basePath().$path;
    }
    
    /**
     * Home path
     *
     * @return string
     */
    public static function home(): string 
    {
        return self::basePath().DEFAULT_ROUTE;
    }
    
    /**
     * Resource path
     *
     * @param string $path the file thats beeing called
     * @return string
     */
    public static function resource(string $path): string 
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
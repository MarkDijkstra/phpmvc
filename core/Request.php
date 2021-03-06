<?php

namespace Core;

class Request 
{
    /**
     * The array of request parameters
     *
     * @var object
     */
    static $params = [];

    /**
     * The static method for getting certain parameter
     *
     * @return mixed It will return null if the parameter is not sent
     */
    public static function getParam(string $name, string $default = null): ?string 
    {
        if (isset(self::$params[$name])) {
            return self::$params[$name];
        } else {
            return $default;
        }
    }

    /**
     * The static method for getting all set parameter
     *
     * @return array It will return an empty array if the parameter is not sent
     */
    public static function getParams(): array
    {
        if (isset(self::$params)) {
            return self::$params;
        } else {
            return [];
        }
    }

    /**
     * The method for setting request parameters
     *
     * @return void
     */
    public static function setParams(array $params): void 
    {
        self::$params = $params;
    }
}
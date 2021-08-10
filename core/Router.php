<?php

namespace Core;

use Core\Request;

class Router 
{
    /**
     * The array of the routes.
     *
     * @var object
     */
    protected $routes = [];

    /**
     * The current route details
     *
     * @var object
     */
    private $route = null;

    /**
     * The current route path
     */
    private $routePath = null;

    public function __construct() 
    {
        $routes = APPLICATION_PATH . "/routes/web.php";

        if (!is_file($routes)) {
            throw new \Exception("There is no route defined.");
        }

        $this->routes = include $routes;
    }

    /**
     * The decode controller method.
     * 
     * For example: Home@index will be [ "controller" => "Home", "action" => "index" ]
     *
     * @param string $route A string representation of route
     * @return array The route details
     */
    private function decodeControler(string $route): iterable 
    {
        $controller = explode("@", $route);
        return [
            "controller" => $controller[0],
            "action" => $controller[1],
        ];
    }

    /**
     * The check route method.
     * 
     * @param string $url The route URL
     * @param string $method The request method (GET, POST ...)
     * @return mixed Route details or false if route is not found
     */
    private function checkRoute(string $url, string $method): iterable 
    {    
        $url = ltrim($url, '/');
        $url = explode('/', $url)[1];
//print_r($url[1]);

      //  print_r($url);

        if (array_key_exists($url, $this->routes[$method])) {
            $route = $this->routes[$method][$url];
        } else {
            $route = $this->routes[$method]['404'];
        }

        $route = $this->decodeControler($route);
        $namespace = 'App\Controllers\\';
        $route['controller'] = $namespace . $route['controller'];
        $this->routePath =$url;
        return $route;   

        // foreach ($this->routes[$method] as $route_path => $route) {       
        //     // if ($route_path !== '/'){
        //     //     $route_path = ltrim($route_path, '/');
        //     // }
        //     if ($url === $route_path) {
        //         $route = $this->decodeControler($route);
        //         $namespace = 'App\Controllers\\';
        //         $route['controller'] = $namespace . $route['controller'];
        //         $this->routePath = $route_path;
        //         return $route;        
        //     }
        // }
        //return null;
    }

    /**
     * Check if method is callable.
     *
     * @param object $controller_object The controller object
     * @return void
     */
    private function methodCallable(Controller $controller_object): void 
    {
        if (is_callable(array($controller_object, $this->route['action']))) {
            $action = $this->route['action'];
            $controller_object->$action();
        } else {
            throw new \Exception("Method " . $this->route['action'] . " in controller " . $this->route['controller'] . " is not a callable.");
        }
    }

    /**
     * Check if method exists.
     *
     * @param object $controller_object The controller object
     * @return void
     */
    private function methodExists(Controller $controller_object): void 
    {
        if (method_exists($controller_object, $this->route['action'])) {
            $this->methodCallable($controller_object);
        } else {
            throw new \Exception("Method " . $this->route['action'] . " in controller " . $this->route['controller'] . " is not defined.");
        }
    }

    /**
     * Run route
     *
     * @return void
     */
    private function runRoute(): void 
    {
        if (class_exists($this->route['controller'])) {
            $controller_object = new $this->route['controller']();
            $this->methodExists($controller_object);
        } else {
            throw new \Exception("Controller class " . $this->route['controller'] . " not found");
        }
    }

    /**
     * Dispatch the route
     * 
     * @return void
     */
    public function dispatch(): void 
    { 
        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];


       // $url = $this->cleanUrl($url); 
        $this->route = $this->checkRoute($url, $method);

        if ($this->route === null) {
            throw new \Exception('No route matched.', 404);
        }

        $this->extractUrlParams($url);
        $this->runRoute();
    }

    /**
     * Clean URL and remove project dir
     *
     * @param string $url The clean url.
     * @return void
     */
    private function cleanUrl($url)
    {
        // $url = ltrim($url, '/');
        // $url = substr($url, strpos($url, '/') + 1);
        // $url = explode('/', $url)[0];

        // if ($url === "") {
        //     $url = DEFAULT_ROUTE;
        // }

        $url = ltrim($url, '/');
        $url = explode('/', $url);



        return $url;
    }

    /**
     * Routes
     *
     * @return object The object of the routes.
     */
    public function getRoutes(): object
    {
        return $this->routes;
    }

    /**
     * The method for extracting parameters from request.
     * 
     * @param $url A set of data to be added to the database.
     * @return void
     */
    public function extractUrlParams(string $url): void 
    {
        $params_string = str_replace($this->routePath, "", $url);
        if (substr($params_string, 0, 1) === "/") {
            $params_string = substr($params_string, 1);
        }
        $params = [];
        $arr = explode("/", $params_string);


        
//print_r( $arr );

        for ($index = 0; $index < count($arr); $index++) {
            if (isset($arr[$index + 1])) {
                $params[$arr[$index]] = $arr[$index + 1];
            } else {
                $params[$arr[$index]] = null;
            }
            $index++;
        }
        Request::setParams($params);
    }
}
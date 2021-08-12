<?php
namespace Core;

use Core\Request;

class Route 
{


public $ddd;
    public static function get(string $route, array $controllerAction = [])
    {

        //self::$ddd;
        $url = $_SERVER['REQUEST_URI'];
    

        if (self::match($route, $url)) {
           
            $params = self::urlToParams($route, $url);
            $controller['controller'] = $controllerAction[0];
            $controller['action'] = $controllerAction[1];
            $namespace = 'App\Controllers\\';
            $controller['controller'] = $namespace . $controller['controller'];

            Request::setParams($params);

            self::run($controller);
        }
    }

    /**
     * Method match
     *
     * @param string $route the route that we are going to
     * @param string $url the url
     *
     * @return bool
     */
    private static function match(string $route, string $url): bool
    {
        $url = str_replace(BASE_DIR, "", $url);

        if ($url !== "/") {
            $url = ltrim($url, '/');
        }

        $slicedUrl = explode('/', $url);
        $slicedRoute = explode('/', $route);

        if ($slicedUrl[0] == $slicedRoute[0]) {
            return true;
        }

        return false;
    }


    /**
     * Url to params, we remove the first part and seperate params from the url
     *
     * @param string $route the route that we are going to use
     * @param string $url the url
     * @return array
     */
    private static function urlToParams(string $route, string $url): array
    {
      
        $params = [];

        $url = str_replace(BASE_DIR, "", $url);

        if ($url !== "/") {
            $url = ltrim($url, '/');
        }

        $slicedUrl = explode('/', $url);
        $slicedRoute = explode('/', $route);
        $routeToParams = explode('{', $route);

           

         if ($routeToParams[0]) {
           // print_r($slicedUrl);
            unset($routeToParams[0]);        
            // foreach($routeToParams as $param){
            //     $param = str_replace(['}/','}'],'',$param);
            //     $params[] .= $param;
            // }
            // $keys= str_replace(['}/','}'],'',$routeToParams);

            // $params = array_combine($keys, $values);

        }

        // $dissected['path'] = $slicedUrl[0];
        // $dissected['route'] = $slicedRoute[0];
        //$dissected['params'] = $params;

        return $params;
    }

    /**
     * The decode controller method
     * 
     * @param array $controller a representation of the action and controller
     * @return array The route details
     */
    // private static function decodeControler(array $controller): iterable 
    // {
    //     $controller = explode("@", $controller);
    //     return [
    //         "controller" => $controller[0],
    //         "action" => $controller[1],
    //     ];
    // }

    /**
     * Check if method is callable
     *
     * @param object $controller_object The controller object
     * @return void
     */
    private static function methodCallable(Controller $controller_object, array $controller): void 
    {
        if (is_callable(array($controller_object, $controller['action']))) {
            $action = $controller['action'];
            $controller_object->$action();
        } else {
            throw new \Exception("Method " . $controller['action'] . " in controller " . $controller['controller'] . " is not a callable.");
        }
    }

    /**
     * Check if method exists
     *
     * @param object $controller_object The controller object
     * @return void
     */
    private static function methodExists(Controller $controller_object, array $controller): void 
    {
        if (method_exists($controller_object, $controller['action'])) {
            self::methodCallable($controller_object, $controller);
        } else {
            throw new \Exception("Method " . $controller['action'] . " in controller " . $controller['controller'] . " is not defined.");
        }
    }

    /**
     * Run route
     *
     * @return void
     */
    private static function run(array $controller): void 
    {
        if (class_exists($controller['controller'])) {
            $controller_object = new $controller['controller']();
            self::methodExists($controller_object, $controller);
        } else {
            throw new \Exception("Controller class " . $controller['controller'] . " not found");
        }
    }
}
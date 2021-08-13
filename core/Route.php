<?php
namespace Core;

use Core\Request;

class Route 
{ 
    /**
     * Get the routes
     *
     * @param string $route the route to match
     * @param array $controllerAction controller and action
     * @return void
     */
    public static function get(string $route, array $controllerAction = []): void
    {
        $url = $_SERVER['REQUEST_URI'];

        if (self::match($route, $url)) {           
            $params = self::urlToParams($route, $url);            
            $controller['controller'] = $controllerAction[0];
            $controller['action'] = $controllerAction[1];
            $namespace = 'App\Controllers\\';
            $controller['controller'] = $namespace . $controller['controller'];

            Request::setParams($params);

            self::run($controller);
        } else {
            // include NOTFOUND view
        }
    }

    /**
     * This will check if the route matches to the current URL 
     *
     * @param string $route the route that we are going to
     * @param string $url the set url
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
     * Output the params as an associative array
     * At this moment this will only support /post/{id} where there's just 1 parameter present
     *
     * @param string $route the route that we are going to use
     * @param string $url the url
     * @return array
     */
    private static function urlToParams(string $route, string $url): array
    {
        $params = [];

        $url = str_replace(BASE_DIR, "", $url);
        $slicedUrl = [];

        if ($url !== "/") {
            $url = ltrim($url, '/');
            $slicedUrl = explode('/', $url);
        }
        
        $routeToParams = explode('{', $route);

        if ($routeToParams[0]) {
            unset($routeToParams[0]); 
            unset($slicedUrl[0]);
            $i = 1;
            foreach($routeToParams as $key){
                $key = str_replace(['}/', '}'], '', $key);
                $params[$key] = $slicedUrl[$i++] ?? '';
            }
        }

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
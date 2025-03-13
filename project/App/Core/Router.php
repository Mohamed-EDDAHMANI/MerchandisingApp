<?php

namespace App\Core;

use App\Middleware\Validation\ValidationMiddleware;


class Router
{

    private $routes = [];
    private $ValidationMiddleware;

    public function __construct()
    {
        $this->ValidationMiddleware = new ValidationMiddleware();
    }

    public function get($uri, $controllerAction)
    {
        $this->routes['GET'][$uri] = $controllerAction;
    }

    public function post($uri, $controllerAction)
    {
        $this->routes['POST'][$uri] = $controllerAction;
    }

    // header('Content-Type: application/json');
    // echo json_encode($this->routes[$method][$uri]);
    // exit;

    public function dispatch($method, $uri)
    {
        // var_dump($method);
        // var_dump($uri);
        // exit;
        //validate the request
        if ($method == 'POST') {
            $this->ValidationMiddleware->validate($_POST);
        }

        // Check if the route exists directly (without parameters) 
        if (isset($this->routes[$method][$uri])) {
            $this->callAction($this->routes[$method][$uri]);
            return;
        }

        foreach ($this->routes[$method] as $route => $controllerAction) {
            // Convert route to a regex pattern to match dynamic parameters

            $pattern = self::convertRouteToPattern($route);

            // Check if the URI matches the route pattern
            if (preg_match($pattern, $uri, $matches)) {
          
                array_shift($matches);

                $this->callAction($controllerAction, ['id' => $matches['id']]);
                return;
            }
        }

        // No matching route found
        header("HTTP/1.0 404 Not Found");
        echo '404 Not Found';
    }

    // Convert a route with placeholders (e.g., {id}) to a regex pattern
    public static function convertRouteToPattern($route)
    {
        // Replace {id} with a regex capture group
        $pattern = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[^\/]+)', $route);

        // Add start and end delimiters
        return '@^' . $pattern . '$@';
    }

    private function callAction($controllerAction, $parameters = [])
    {
        list($controller, $action) = explode('@', $controllerAction);
        $controller = 'App\\Controllers\\' . $controller;
        $controllerInstance = new $controller();
        
        // Call the action with parameters
        call_user_func_array([$controllerInstance, $action], $parameters);
    }
}
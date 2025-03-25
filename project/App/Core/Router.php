<?php

namespace App\Core;

use App\Middleware\Validation\ValidationMiddleware;
use App\Middleware\Auth\GateMiddleware;


class Router
{

    private $routes = [];
    private $validationMiddleware;
    private $gateMiddleware;

    public function __construct()
    {
        $this->validationMiddleware = new ValidationMiddleware();
        $this->gateMiddleware = new GateMiddleware();
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
        // var_dump($this->routes[$method][$uri]);
        // exit;
        //validate the request
        if ($method == 'POST') {
            $this->validationMiddleware->validate($_POST);
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
        echo '404 Not Found Router';
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

        //check if the user have the permission to call this method 
        $roleFolder = $this->gateMiddleware->handlePolicis($action);
        $controller = 'App\\Controllers\\' . $roleFolder . '\\'. $controller;

        $controllerInstance = new $controller();

        // Call the action with parameters
        call_user_func_array([$controllerInstance, $action], $parameters);
    }
}
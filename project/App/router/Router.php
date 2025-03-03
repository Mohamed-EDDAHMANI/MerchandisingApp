<?php

namespace App\Core;

class Router
{
    private $routes = [];

    public function get($route, $controller): void
    {
        $this->routes['GET'][$route] = $controller;
    }

    public function post($route, $controller): void
    {
        $this->routes['POST'][$route] = $controller;
    }

    public function put($route, $controller): void
    {
        $this->routes['PUT'][$route] = $controller;
    }

    public function delete($route, $controller): void
    {
        $this->routes['DELETE'][$route] = $controller;
    }

    public function patch($route, $controller): void
    {
        $this->routes['PATCH'][$route] = $controller;
    }

  

    public function dispatch($url, $method)
    {

        $path = parse_url($url, PHP_URL_PATH);

        if (isset($this->routes[$method][$path])) {

            $pathController = "App\\Controllers\\";

            $controllerMethod = $this->routes[$method][$path];

            $controllerMethod = explode( '@', $controllerMethod);

            $countrollerName = $controllerMethod[0];

            $methodName = $controllerMethod[1];

            $controllerPath = $pathController . $countrollerName;

            // var_dump($controllerPath);
            // echo '<br>';
            // var_dump($path);
            // echo '<br>';
            // var_dump($methodName);
            // echo '<br>';
           
            if (class_exists($controllerPath) && method_exists($controllerPath ,$methodName)) {
                
                $controller = new $controllerPath();

                $controller->$methodName();
                return;
            }
        }
    }
}
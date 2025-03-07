<?php 
require "../vendor/autoload.php";
session_start();
use App\Core\Router;
use App\Middleware\AuthMiddleware;

// Load protected routes from the config file
$protectedRoutes = require "../config/protected_routes.php";

$uri = $_SERVER['REQUEST_URI'];

// Check if the URI matches any protected route
foreach ($protectedRoutes as $route => $roles) {
    $pattern = Router::convertRouteToPattern($route);
    if (preg_match($pattern, $uri)) {
        AuthMiddleware::handleAuthentification();
        AuthMiddleware::handleAuthorisation($roles);
        break;
    }
}

$router = new Router();
require_once "../config/routes.php";
$router->dispatch($_SERVER['REQUEST_METHOD'], $uri);
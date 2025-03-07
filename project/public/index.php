<?php 
require "../vendor/autoload.php";
session_start();
use App\Core\Router;
use App\Middleware\AuthMiddleware;

// Load protected routes from the config file
$protectedRoutes = require "../config/protected_routes.php";

$uri = $_SERVER['REQUEST_URI'];

// Check if the URI matches any protected routes without a session
AuthMiddleware::handleAuthentification();

AuthMiddleware::handleAuthorisation($protectedRoutes , $uri);


$router = new Router();
require_once "../config/routes.php";
$router->dispatch($_SERVER['REQUEST_METHOD'], $uri);
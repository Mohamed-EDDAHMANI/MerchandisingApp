<?php 
require "../vendor/autoload.php";
session_start();
use App\Core\Router;

$router = new Router();
require_once "../App/config/routes.php";
$router->dispatch($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);
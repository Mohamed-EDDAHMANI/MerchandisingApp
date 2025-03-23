<?php
require "../vendor/autoload.php";
session_start();
use App\Core\Router;
use App\Middleware\Auth\AuthMiddleware;

// use Config\Database;

// $db = Database::getConnection();

// $firstName = 'Houssam';
// $lastName = 'Grich';
// $email = 'houssam@gmail.com';
// $password = 'password';
// $roleId = 1;

// $passwordHashed = password_hash($password , PASSWORD_BCRYPT);
// $sql = "INSERT INTO users (first_name, last_name, email, password, role_id) VALUES (:first_name, :last_name, :email, :password, :role_id)";
// $stmt = $db->prepare($sql);
// $stmt->bindParam(':first_name', $firstName);
// $stmt->bindParam(':last_name', $lastName);
// $stmt->bindParam(':email', $email);
// $stmt->bindParam(':password', $passwordHashed);
// $stmt->bindParam(':role_id', $roleId);
// $stmt->execute();

// exit();


// Load protected routes from the config file
$protectedRoutes = require "../config/protected_routes.php";

$uri = $_SERVER['REQUEST_URI'];

// Check if the URI matches any protected routes without a session
// AuthMiddleware::handleAuthentification($protectedRoutes , $uri);
// var_dump($_SESSION['role']);
// exit;

$router = new Router();
require_once "../config/routes.php";
$router->dispatch($_SERVER['REQUEST_METHOD'], $uri);
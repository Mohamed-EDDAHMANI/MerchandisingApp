<?php

namespace App\Middleware;

class AuthMiddleware
{
    public static function handleAuthentification()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /auth/login");
            exit();
        }
        
    }
    public static function handleAuthorisation($protectedRoutes , $uri)
    {
        foreach ($protectedRoutes as $route => $roles) {
            $pattern = '@^' . preg_replace('/\{([a-z]+)\}/', '(?P<\1>[^\/]+)', $route) . '$@';
            if (preg_match($pattern, $uri)) {
                if (!in_array($_SESSION['user']['role'], $roles)) {
                    header("Location: /notFound");
                    exit();
                }
                break;
            }
        }
    }
}

<?php

namespace App\Auth\Middleware;

class AuthMiddleware
{
    public static function handleAuthentification($protectedRoutes , $uri)
    {
        if (in_array($uri, array_keys($protectedRoutes)) && !isset($_SESSION['user'])) {
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

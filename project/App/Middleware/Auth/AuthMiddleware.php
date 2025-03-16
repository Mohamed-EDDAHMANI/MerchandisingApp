<?php

namespace App\Middleware\Auth;

class AuthMiddleware
{
    public static function handleAuthentification($protectedRoutes , $uri)
    {
        if (in_array($uri, array_keys($protectedRoutes)) && !isset($_SESSION['user'])) {
            header("Location: /auth/login");
            exit();
        }
        
    }
}

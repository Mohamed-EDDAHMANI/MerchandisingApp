<?php

namespace App\Middleware\Auth;

class AuthMiddleware
{
    public static function handleAuthentification($protectedRoutes , $uri)
    {
        if (in_array($uri, $protectedRoutes) && !isset($_SESSION['user'])) {
            header("Location: /login");
            exit();
        }
        
    }
}

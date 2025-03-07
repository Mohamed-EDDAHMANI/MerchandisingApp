<?php

namespace App\Middleware;

class AuthMiddleware
{
    public static function handleAuth($roles)
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /auth/login");
            exit();
        }
        
    }
}

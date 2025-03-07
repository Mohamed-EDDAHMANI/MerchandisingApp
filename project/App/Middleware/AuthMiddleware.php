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
    public static function handleAuthorisation($roles)
    {
        if (!in_array($_SESSION['user']['role'], $roles)) {
            header("Location: /notFound");
            exit();
        }
        
    }
}

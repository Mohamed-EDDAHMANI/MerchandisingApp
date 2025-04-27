<?php

namespace App\Utils\Redirects;


class Redirect
{

    // Method for redirection with an optional status code
    public static function to($url)
    {
        header("Location: " . $url);
        exit;
    }

    public static function roleRedirect($role)
    {
        switch ($role) {
            case "admin":
                self::to("/admin/dashboard");
                break;
            case "manager":
                // var_dump('seccses');
                // exit;
                self::to("/manager/dashboard");
                break;
            case "employee":
                self::to("/employee/home");
                break;
            default:
                self::to("/notFound");
                break;
        }
    }

    public static function back()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            self::to($_SERVER['HTTP_REFERER']);
        } else {
            self::to('/');
        }
    }

    public static function route($routeName, $params = [], $statusCode = 302)
    {
        $url = '/' . $routeName . '/' . implode('/', $params);
        self::to($url);
    }
}

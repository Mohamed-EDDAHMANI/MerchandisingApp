<?php

namespace App\Utils\Redirects;


class Redirect
{

    // Method for redirection with an optional status code
    public static function to($url)
    {
        header("Location: " . $url);
        exit(); // Always call exit after header redirection to ensure the script stops executing.
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
                self::to("/employee/platform");
                break;
            default:
                self::to("/notFound");
                break;
        }
    }

    // Method for redirecting back to the previous page
    public static function back($statusCode = 302)
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            self::to($_SERVER['HTTP_REFERER'], $statusCode);
        } else {
            // If no referer is available, redirect to the home page (or any other default page)
            self::to('/');
        }
    }

    // Method for redirecting to a specific route (e.g., controller or route)
    public static function route($routeName, $params = [], $statusCode = 302)
    {
        // You can generate the URL here depending on your routing system.
        // For example, using a URL structure like "/controller/method"
        // Here it's just an example.
        $url = '/' . $routeName . '/' . implode('/', $params);
        self::to($url);
    }
}

<?php

namespace App\Middleware\Auth;

use App\Middleware\Auth\Permissions;
use App\Utils\Redirects\Redirect;
use App\Utils\Sessions\Session;

class GateMiddleware
{

    private $redirect;
    private $session;

    public function __construct()
    {
        $this->redirect = new Redirect();
        $this->session = new Session();
    }

    public function handlePolicis($method)
    {
        $useRole = ($method == 'logout') ? 'public' : $this->session->get('role');

        if (!isset($useRole)) {
            $useRole = 'public';
        }

        foreach (Permissions::$permissions as $role => $permissions) {
            if ($role == $useRole) {
                $permissionsArray = explode('|', $permissions);
                if (in_array($method, $permissionsArray)) {
                    return $role;
                }
                $this->redirect->to('/notFound');
            }
        }
    }
}

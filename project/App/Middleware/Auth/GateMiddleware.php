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
        $useRole = $this->session->get('role');
        if(!isset($useRole)){
            foreach (Permissions::$permissions as $role => $pirmission) {
                if($role == 'public') {
                    $pirmissions = explode('|', $pirmission);
                    if (in_array($method, $pirmissions)) {
                        return;
                    }
                    $this->redirect->to('notFound');
                }
            }
        }
        foreach (Permissions::$permissions as $role => $pirmission) {
            if($useRole == $role) {
                $pirmissions = explode('|', $pirmission);
                if (in_array($method, $pirmissions)) {
                    return;
                }
                $this->redirect->to('notAuthorize');
            }
        }
    }
}

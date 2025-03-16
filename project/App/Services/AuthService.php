<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;

class AuthService
{

    private $authRepository;
    private $session;

    public function __construct()
    {
        $this->authRepository = new AuthRepository();
        $this->session = new Session();
    }

    public function login($email, $password)
    {
        $result = $this->authRepository->login($email, $password);
        //create user session manager / employee
        if (is_array($result)) {
            $this->session->set("user", $result[0]);
            $this->session->set("data", $result[1]);
            $this->session->set("role", $result[2]);
            Redirect::roleRedirect($result[2]);
        } else {
            //create admine session
            $this->session->set("user", $result[0]);
            $this->session->set("data", null);
            $this->session->set("role", 'admin');
            Redirect::roleRedirect('admin');
            return false;
        }
    }
}


?>
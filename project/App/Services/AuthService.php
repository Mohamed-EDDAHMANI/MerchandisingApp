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
            $this->session->set("store", $this->authRepository->getStoreName($result[0]));
            $this->session->set("data", $result[1]);
            $this->session->set("role", $result[2]);
            Redirect::roleRedirect($result[2]);
        } elseif (is_object($result)) {
            //create admine session
            $this->session->set("user", $result);
            $this->session->set("data", null);
            $this->session->set("role", 'admin');
            Redirect::roleRedirect('admin');
            return false;
        } else {
            $this->session->setError('error', 'incorrect email or password !!');
            Redirect::to('/login');
        }
    }


    public function logout()
    {
        session_destroy();
        $_SESSION = array();
        Redirect::to('/login');
    }
}


?>
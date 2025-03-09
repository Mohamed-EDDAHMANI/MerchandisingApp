<?php

namespace App\Services;

use App\Repositories\AuthRepository;

class AuthService {

    private $authRepository;

    public function __construct() {
        $this->authRepository = new AuthRepository();
    }

    public function login($email, $password) {
        $result = $this->authRepository->login($email, $password);
        $table = ucfirst($result[2]);
        //create user session manager / employee
        if (is_array($result) && $result[0] instanceof User && $result[1] instanceof $table) {
            var_dump($result);
            exit;
            $_SESSION['user'] = $result[0];
            $_SESSION['data'] = $result[1];
            $_SESSION['table'] = $result[2];
            header('Location: /');
        } else {
            //create admine session
            $_SESSION['error'] = $result;
            return false;
        }
    }
}


?>
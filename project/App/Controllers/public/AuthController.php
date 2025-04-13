<?php 

namespace App\Controllers\public;

use App\Services\AuthService;
use App\Controllers\BaseController;

class AuthController extends BaseController{
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function getLoginPage() {
        $this->view('auth/login');
    }

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password']; 
        $this->authService->login($email, $password);
    }
    public function logout() {
        $this->authService->logout();
    }

    public function notAutorise() {
        $this->view('notAutorise');
    }
}

?>
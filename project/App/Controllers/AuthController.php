<?php 

namespace App\Controllers;

use App\Services\AuthService;

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

    public function getSignupPage() {
        require 'views/auth/signup.php';
    }

    public function logout() {
        $this->authService->logout();
    }
}

?>
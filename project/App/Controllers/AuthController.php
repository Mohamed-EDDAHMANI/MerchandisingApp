<?php 

class AuthController {
    private $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function getLoginPage() {
        require 'views/auth/login.php';
    }

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $this->authService->login($email, $password);
    }

    public function getSignupPage() {
        require 'views/auth/signup.php';
    }

    public function signup() {
        $data = $_POST;
        $this->authService->signup($data);
    }

    public function logout() {
        $this->authService->logout();
    }
}

?>
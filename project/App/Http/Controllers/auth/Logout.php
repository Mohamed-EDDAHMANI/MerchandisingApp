<?php 

class User {
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../../View/auth/login.php");
        exit();
    }
}
$user = new User();
$user->logout();



?>
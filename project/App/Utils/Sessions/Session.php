<?php 
namespace App\Utils\Sessions;


class Session {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function setError($key, $message) {
        $_SESSION['error'] = [
            'type' => $key,  
            'message' => $message 
        ];
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public function destroy() {
        session_destroy();
    }

    public function has($key) {
        return isset($_SESSION[$key]);
    }
}
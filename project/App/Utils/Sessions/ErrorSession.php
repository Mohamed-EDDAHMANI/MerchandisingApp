<?php 

namespace App\Utils\Sessions;

class ErrorSession extends Session{

    public function getError($key) {
        if ($this->has($key)) {
            $message = $this->get($key);
            $this->clearError($key); 
            return $message;
        }
        return null;
    }

    public function hasError($key) {
        return $this->has($key);
    }

    public function clearError($key) {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function clearAllErrors() {
        session_unset();
    }
}


?>
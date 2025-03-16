<?php

namespace App\Utils\Sessions;

class UserSession extends Session {

    public function setUser($user) {
        $this->set('user_id', $user);
        $this->set('role', $user);
        $this->set('user', $user);
        $this->set('user', $user);
        $this->set('user', $user);
    }

    public function getUser() {
        return $this->get('user');
    }

    public function isAuthenticated() {
        return $this->has('user');
    }

    public function logout() {
        $this->destroy();
    }
}












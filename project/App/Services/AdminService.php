<?php

namespace App\Services;

use App\Repositories\adminRepository;
use App\Core\Sessions\Session;

class AdminService {

    private $adminRepository;
    private $session;

    public function __construct() {
        $this->adminRepository = new AdminRepository();
        $this->session = new Session();
    }

    public function createUser($data) {
        $result = $this->adminRepository->createUser($data);
        if ($result) {
            $this->session->set('success', 'User created successfully');
            return $result;
        }
    }
}


?>
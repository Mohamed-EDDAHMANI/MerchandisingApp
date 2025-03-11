<?php

namespace App\Services;

use App\Repositories\adminRepository;

class AdminService {

    private $adminRepository;

    public function __construct() {
        $this->adminRepository = new AdminRepository();
    }

    public function createUser($data) {
        $this->adminRepository->createUser($data);
    }
}


?>
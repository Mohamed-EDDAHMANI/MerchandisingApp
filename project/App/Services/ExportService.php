<?php

namespace App\Services;

use App\Repositories\adminRepository;
use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;

class ExportService
{

    private $adminRepository;
    private $session;

    public function __construct()
    {
        $this->adminRepository = new AdminRepository();
        $this->session = new Session();
    }

    public function createUser($data)
    {
        $result = $this->adminRepository->createUser($data);
        if ($result) {
            $this->session->setError('success', 'User created successfully');
        } else {
            $this->session->setError('error', 'email already exists');
        }
        Redirect::to('/admin/utilisateurs');//i want redirect to this rout 
    }
}
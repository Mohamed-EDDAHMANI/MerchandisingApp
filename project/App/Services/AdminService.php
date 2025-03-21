<?php

namespace App\Services;

use App\Repositories\AdminRepository;
use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;

class AdminService
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

    public function getData()
    {
        $users = $this->adminRepository->getAllUsers();
        $stors = $this->adminRepository->getAllStores();
        return ['users' => $users, 'stores' => $stors];
    }

    public function getUserById($id)
    {
        $json = file_get_contents("php://input");
        $filters = json_decode($json, true);

        $user = $this->adminRepository->getUserById($id);
        echo json_encode($user);
        exit;
    }

    public function sortUsers()
    {
        $json = file_get_contents("php://input");
        $filters = json_decode($json, true);

        $role = $filters['role'] ?? null;
        $store = $filters['store'] ?? null;
        $isValid = $filters['is_valid'] ?? null;

        $users = $this->adminRepository->sortUsers($role, $store, $isValid);


        echo json_encode($users);
        exit;
    }

    public function updateUser($data, $id)
    {
        $this->adminRepository->updateUser($data, $id);
        $this->session->setError('success', 'User updated successfully');
        Redirect::to('/admin/utilisateurs'); 
    }

    public function toggleUserStatus($id)
    {
        $this->adminRepository->toggleUserStatus($id);
        $this->session->setError('success', 'User status Updated successfully');
        Redirect::to('/admin/utilisateurs'); 
    }
}


?>
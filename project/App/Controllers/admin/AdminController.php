<?php 

namespace App\Controllers\Admin;

use App\Services\AdminService;
use App\Utils\Redirects\Redirect;
use App\Utils\Sessions\Session;
use App\Controllers\BaseController;

class AdminController extends BaseController{
    private $adminService;
    private $session;

    public function __construct() {
        $this->adminService = new AdminService();
        $this->session = new Session();
    }

    public function dashboard() {
        $data = $this->session->get('user');
        $statistecs = $this->adminService->getStatistics();
        $this->view('admin/dashboard', ['user' => $data, 'statistecs' => $statistecs]);
    }

    public function getUsers() {
        $users = $this->session->get('user');
        $data = $this->adminService->getData();
        $this->view('admin/users',['user' => $users, 'data' => $data]);
    }
    public function sortUsers() {
        $users = $this->adminService->sortUsers();
        $this->view('admin/users',$users);
    }

    public function getUserById($id) {
        return $this->adminService->getUserById($id);
    }

    public function createUser() {
        $data = $_POST;
        $this->adminService->createUser($data);
    }

    public function updateUser($id) {
        $data = $_POST;
        $this->adminService->updateUser($data, $id);
    }

    public function toggleUserStatus($id) {
        $this->adminService->toggleUserStatus($id);
    }
    public function deleteUser($id) {
        $this->adminService->deleteUser($id);
    }

    public function getStorePerformance(){
        $sales = $this->adminService->getStorePerformance();
        echo json_encode($sales);
        exit;
    }
}

?>
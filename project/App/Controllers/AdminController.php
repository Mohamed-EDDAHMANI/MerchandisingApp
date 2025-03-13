<?php 

namespace App\Controllers;

use App\Services\AdminService;
use App\Utils\Redirects\Redirect;

class AdminController extends BaseController{
    private $adminService;

    public function __construct() {
        $this->adminService = new AdminService();
    }

    public function dashboard() {
        $this->view('admin/dashboard');
    }

    public function getUsers() {
        //i have to get users from the database
        $data = $this->adminService->getData();
        $this->view('admin/users',$data);
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

    // public function getPointsDeVente() {
    //     $pointsDeVente = $this->adminService->getAllPointsDeVente();
    //     require 'views/admin/points-de-vente.php';
    // }

    // public function createPointDeVente() {
    //     $data = $_POST;
    //     $this->adminService->createPointDeVente($data);
    // }

    // public function updatePointDeVente($id) {
    //     $data = $_POST;
    //     $this->adminService->updatePointDeVente($id, $data);
    // }

    // public function deletePointDeVente($id) {
    //     $this->adminService->deletePointDeVente($id);
    // }
}

?>
<?php 

namespace App\Controllers;

use App\Services\AdminService;

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
        // $users = $this->adminService->getAllUsers();
        // $pointsDeVente = $this->adminService->getAllPointsDeVente();
        $this->view('admin/users');
    }

    public function createUser() {
        $data = $_POST;
        $this->adminService->createUser($data);
    }

    public function getPointsDeVente() {
        $pointsDeVente = $this->adminService->getAllPointsDeVente();
        require 'views/admin/points-de-vente.php';
    }

    public function createPointDeVente() {
        $data = $_POST;
        $this->adminService->createPointDeVente($data);
    }

    public function updatePointDeVente($id) {
        $data = $_POST;
        $this->adminService->updatePointDeVente($id, $data);
    }

    public function deletePointDeVente($id) {
        $this->adminService->deletePointDeVente($id);
    }
}

?>
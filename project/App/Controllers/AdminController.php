<?php 

namespace App\Controllers;

class AdminController extends BaseController{
    private $adminService;

    public function __construct() {
        // $this->adminService = $adminService;
    }

    public function dashboard() {
        $this->view('admin/dashboard');
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
<?php 

namespace App\Controllers\manager;

use App\Services\ManagerService;
use App\Controllers\BaseController;

class ManagerController extends BaseController {

    private $managerService ;
    public function __construct(){
        $this->managerService = new ManagerService();
    }

    public function index() {
        $categories = $this->managerService->getAllCategories();
        $data = ['categories' => $categories];
        return $this->view('manager/dashboard', $data);
    }

    public function createCategory() {
        $this->managerService->createCategory($_POST);
    }

    public function getCategoryById($id) {
        return $this->managerService->getCategoryById($id);
    }

    public function udpateCategory($id) {
        return $this->managerService->udpateCategory($_POST , $id);
    }

}
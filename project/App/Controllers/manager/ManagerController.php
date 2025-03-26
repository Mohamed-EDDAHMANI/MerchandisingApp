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
        $products = $this->managerService->getAllProducts();
        $data = ['categories' => $categories, 'products' => $products];
        return $this->view('manager/dashboard', $data);
    }

    public function createCategory() {
        $this->managerService->createCategory($_POST);
    }

    public function getCategoryById($id) {
        return $this->managerService->getCategoryById($id);
    }
    public function getProductById($id) {
        return $this->managerService->getProductById($id);
    }

    public function updateCategory($id) {
        return $this->managerService->updateCategory($_POST , $id);
    }
    public function updateProduct($id) {
        return $this->managerService->updateProduct($_POST , $id);
    }

    public function deleteCategory($id) {
        return $this->managerService->deleteCategory($id);
    }
    public function deleteProduct($id) {
        return $this->managerService->deleteProduct($id);
    }
    public function createProduct() {
        return $this->managerService->createProduct($_POST);
    }
    public function sortProduct() {
        return $this->managerService->sortProduct($_POST);
    }

}
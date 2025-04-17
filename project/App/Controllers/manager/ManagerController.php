<?php 

namespace App\Controllers\manager;

use App\Services\ManagerService;
use App\Controllers\BaseController;
use App\Utils\Sessions\Session;

class ManagerController extends BaseController {

    private $managerService ;
    private $session ;
    public function __construct(){
        $this->managerService = new ManagerService();
        $this->session = new Session();
    }

    public function index() {
        $user = $this->session->get('user');
        $categories = $this->managerService->getAllCategories();
        $products = $this->managerService->getAllProducts();
        $suppliers = $this->managerService->getAllSuppliersWithCategories();
        $orders = $this->managerService->getAllOrdersWithSupplierAndProduct();
        $employees = $this->managerService->getEmployees($user->getId());
        $objectifs = $this->managerService->getObjectifs();
        $statistecs = $this->managerService->getStatistics($user);
        // var_dump($products['sortProducts']);
        // exit;
        // $productTopSales = $this->sortProdeuctsBySales($products);
        $data = ['categories' => $categories, 'products' => $products['products'], 'suppliers' => $suppliers, 'orders' => $orders,
         'employees' => $employees, 'objectifs' => $objectifs, 'user' => $user, 'statistecs' => $statistecs, 'productsTopSales' => $products['sortProducts']];

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

    public function getSalesChart()
    {
        $storeID = $this->session->get('user')->getStoreId();
        $sales = $this->managerService->getSalesChart($storeID);
        echo json_encode($sales);
        exit;
    }
    public function getCategoriesData()
    {
        $storeID = $this->session->get('user')->getStoreId();
        $sales = $this->managerService->getCategoriesData($storeID);
        echo json_encode($sales);
        exit;
    }
    public function getEmployeesSales()
    {
        $storeID = $this->session->get('user')->getStoreId();
        $sales = $this->managerService->getEmployeesSales($storeID);
        // header('Content-Type: application/json');
        echo json_encode($sales);
        exit;
    }

}
<?php 

namespace App\Services;

use App\Repositories\ManagerRepository;
use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;

class ManagerService{

    private $managerRepository;
    private $session;

    public function __construct(){
        $this->managerRepository = new ManagerRepository();
        $this->session = new Session();
    }

    public function getAllCategories(){
        return $this->managerRepository->getAllCategories();
    }
    public function getAllProducts(){
        $userData = $this->session->get('user');
        return $this->managerRepository->getAllProducts( $userData->getStoreId());
    }

    public function createCategory($data){
        $result = $this->managerRepository->createCategory($data);
        if ($result) {
            $this->session->setError('success', 'Category created successfully');
        } else {
            $this->session->setError('error', 'Category name already exists');
        }
        Redirect::to('/manager/dashboard#categories');//i want redirect to this rout and clickon a button with js 
    }
    
    public function getCategoryById($id)
    {
        $json = file_get_contents("php://input");
        $filters = json_decode($json, true);
        
        $category = $this->managerRepository->getCategoryById($id);
        echo json_encode($category);
        exit;
    }
    public function getProductById($id)
    {
        $json = file_get_contents("php://input");
        $filters = json_decode($json, true);
        
        $product = $this->managerRepository->getProductById($id);
        echo json_encode($product);
        exit;
    }

    public function updateCategory($data , $id){
        $result = $this->managerRepository->updateCategory($data, $id);
        if ($result) {
            $this->session->setError('success', 'Category updated successfully');
        } else {
            $this->session->setError('error', 'Category name already exists');
        }
        Redirect::to('/manager/dashboard#categories');//i want redirect to this rout and clickon a button with js 
    }
    public function updateProduct($data , $id){
        $result = $this->managerRepository->updateProduct($data, $id);
        if ($result) {
            $this->session->setError('success', 'Product updated successfully');
        } else {
            $this->session->setError('error', 'Product name already exists');
        }
        Redirect::to('/manager/dashboard#products');//i want redirect to this rout and clickon a button with js 
    }
    public function deleteCategory($id){
        $result = $this->managerRepository->deleteCategory($id);
        if ($result) {
            $this->session->setError('success', 'Category Deleted successfully');
        } else {
            $this->session->setError('error', 'Error Deleting Category');
        }
        Redirect::to('/manager/dashboard#categories');//i want redirect to this rout and clickon a button with js 
    }
    public function createProduct($data){
        $userData = $this->session->get('user');
        $result = $this->managerRepository->createProduct($data, $userData->getStoreId());
        if ($result) {
            $this->session->setError('success', 'Product Created successfully');
        } else {
            $this->session->setError('error', 'Error creating or name Already Exist!');
        }
        Redirect::to('/manager/dashboard#products');//i want redirect to this rout and clickon a button with js 
    }
    
}


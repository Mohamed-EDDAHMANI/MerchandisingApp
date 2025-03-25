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

    public function udpateCategory($data , $id){
        $result = $this->managerRepository->udpateCategory($data, $id);
        if ($result) {
            $this->session->setError('success', 'Category updated successfully');
        } else {
            $this->session->setError('error', 'Category name already exists');
        }
        Redirect::to('/manager/dashboard#categories');//i want redirect to this rout and clickon a button with js 
    }
}


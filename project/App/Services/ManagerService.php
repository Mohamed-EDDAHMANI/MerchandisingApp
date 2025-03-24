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
}


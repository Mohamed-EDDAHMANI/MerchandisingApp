<?php 

namespace App\Controllers;

use App\Services\ManagerService;

class ManagerController extends BaseController {

    private $managerService ;
    public function __construct(){
        $this->managerService = new ManagerService();
    }

    public function index() {
        return $this->view('manager/dashboard');
    }

    public function createCategory() {
        $this->managerService->createCategory($_POST);
    }

}
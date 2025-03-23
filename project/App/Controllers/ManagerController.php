<?php 

namespace App\Controllers;

class ManagerController extends BaseController {

    private $managerService ;
    public function __construct(){
        $this->managerService = new ManagerService();
    }

    public function index() {
        return $this->view('manager/dashboard');
    }

    public function createTag() {

    }

}
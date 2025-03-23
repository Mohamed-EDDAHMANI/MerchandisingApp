<?php 

namespace App\Controllers;

class ManagerController extends BaseController {

    public function index() {
        return $this->view('manager/dashboard');
    }

}
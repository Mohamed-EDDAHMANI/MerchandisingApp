<?php 

namespace App\Controllers;

use App\Services\AdminService;
use App\Utils\Redirects\Redirect;

class StoreController extends BaseController{
    private $adminService;

    public function __construct() {
        $this->adminService = new AdminService();
    }

    public function getPointsDeVente(){
        $this->view('admin/store');
    }
}
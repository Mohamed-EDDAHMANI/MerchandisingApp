<?php 

namespace App\Controllers;

use App\Services\StoreService;
use App\Utils\Redirects\Redirect;

class StoreController extends BaseController{
    private $storeService;

    public function __construct() {
        $this->storeService = new StoreService();
    }

    public function getPointsDeVente(){
        $data = $this->storeService->getPointsDeVente();
        $this->view('admin/store', $data);
    }

    public function createPointDeVente(){
        $data = $_POST;
        $this->storeService->createPointDeVente($data);
    }

    
}
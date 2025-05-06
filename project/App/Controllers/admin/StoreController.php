<?php 

namespace App\Controllers\Admin;

use App\Services\StoreService;
use App\Utils\Sessions\Session;
use App\Controllers\BaseController;

class StoreController extends BaseController{
    private $storeService;
    private $session;

    public function __construct() {
        $this->storeService = new StoreService();
        $this->session = new Session();
    }

    public function getPointsDeVente(){
        $data = $this->storeService->getPointsDeVente();
        $user = $this->session->get('user');
        $data['user'] = $user;
        $this->view('admin/store', $data);
    }
    
    public function getPointsDeVenteById($id){
        $this->storeService->getPointsDeVenteById($id);
    }

    public function createPointDeVente(){
        $data = $_POST;
        $this->storeService->createPointDeVente($data);
    }

    public function updatePointDeVente($id){
        $data = $_POST;
        $this->storeService->updatePointDeVente($data, $id);
    }
    
    public function deletePointDeVente($id){
        $this->storeService->deletePointDeVente( $id);
    }
    public function getMerchandising(){
        $data = $this->storeService->getPointsDeVentePanding();
        $user = $this->session->get('user');
        $this->view('admin/merchandising', ['data' => $data , 'user' => $user]);
    }
}
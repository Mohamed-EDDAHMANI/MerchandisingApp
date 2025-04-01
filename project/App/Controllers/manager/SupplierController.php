<?php 

namespace App\Controllers\manager;

use App\Services\SupplierService;
use App\Controllers\BaseController;
use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;

class SupplierController extends BaseController {

    private $supplierService ;
    private $session ;
    public function __construct(){
        $this->supplierService = new SupplierService();
        $this->session = new Session();
    }

    public function createSupplier(){
        $result = $this->supplierService->createSupplier($_POST);
        if ($result === true) {
            $this->session->setError('success', 'Supplier created successfully');
        } else {
            $this->session->setError('error', 'Error creating Supplier !!');
        }
        Redirect::to('/manager/dashboard#suppliers');
    }

    public function getSupplierById($id){
        $json = file_get_contents("php://input");
        $supplier =  $this->supplierService->getSupplierById($id);
        echo json_encode($supplier);
        exit;
    }

    public function updateSupplier($id){
        $result =  $this->supplierService->updateSupplier($_POST, $id);
        if ($result === true) {
            $this->session->setError('success', 'Supplier Update successfully');
        } else {
            $this->session->setError('error', 'Error Updating Supplier !!');
        }
        Redirect::to('/manager/dashboard#suppliers');
    }
    public function deleteSupplier($id){
        $result =  $this->supplierService->deleteSupplier($id);
        if ($result === true) {
            $this->session->setError('success', 'Supplier Deleted successfully');
        } else {
            $this->session->setError('error', 'Error Deleting Supplier !!');
        }
        Redirect::to('/manager/dashboard#suppliers');
    }
}
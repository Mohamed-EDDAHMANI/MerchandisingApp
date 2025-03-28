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
}
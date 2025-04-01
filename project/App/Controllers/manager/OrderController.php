<?php 

namespace App\Controllers\Manager;

use App\Services\OrderService;
use App\Controllers\BaseController;
use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;

class OrderController extends BaseController{

    private $orderService;
    private $session;

    public function __construct(){
        $this->orderService = new OrderService();
        $this->session = new Session();
    }

    public function createOrder(){
        $result = $this->orderService->createOrder($_POST);
        if ($result === true) {
            $this->session->setError('success', 'Supplier created successfully');
        } else {
            $this->session->setError('error', 'Error creating Supplier !!');
        }
        Redirect::to('/manager/dashboard#suppliers');
    }
}





?>
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
        $userData = $this->session->get('data');
        $result = $this->orderService->createOrder($_POST ,$userData->getId());
        if ($result === true) {
            $this->session->setError('success', 'Order created successfully');
        } else {
            $this->session->setError('error', 'Error creating Order !!');
        }
        Redirect::to('/manager/dashboard#orders');
    }
}





?>
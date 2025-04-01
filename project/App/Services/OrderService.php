<?php 

namespace App\Services;
use App\Repositories\OrderRepository;

class OrderService {
    private $orderRepository;


    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function createOrder($data){
        return $this->orderRepository->createOrder($data);
    }

}
<?php 

namespace App\Services;
use App\Repositories\OrderRepository;

class OrderService {
    private $orderRepository;


    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function createOrder($data, $manager_id){
        $result = $this->orderRepository->createOrder($data, $manager_id);
        if ($result == true) {
            return ['status' => 'success', 'message' => 'Order created successfully.'];
      
        } else {
            return ['status' => 'error', 'message' => 'Failed to create order.'];
        }
    }
    public function confirmOrder($id){
        $result = $this->orderRepository->confirmOrder($id);
        if ($result) {
            $isUpdated = $this->orderRepository->AddQuantity($result->getQuantity(), $result->getProductId());
            if ($isUpdated) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function getOrderByid($id){
        return $this->orderRepository->getOrderByid($id);
    }
}
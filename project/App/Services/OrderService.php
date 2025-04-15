<?php

namespace App\Services;
use App\Repositories\OrderRepository;

class OrderService
{
    private $orderRepository;


    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function createOrder($data, $manager_id)
    {
        $result = $this->orderRepository->createOrder($data, $manager_id);
        if ($result == true) {
            return ['status' => 'success', 'message' => 'Order created successfully.'];

        } else {
            return ['status' => 'error', 'message' => 'Failed to create order.'];
        }
    }
    public function confirmOrder($id, $userId)
    {
        $result = $this->orderRepository->confirmOrder($id, $userId);
        if ($result === true) {
            return true;
        } elseif ($result === false) {
            return false;
        } elseif (is_string($result)) {
            return false;
        }
        return false;
    
    }
    public function getOrderByid($id)
    {
        return $this->orderRepository->getOrderByid($id);
    }
}
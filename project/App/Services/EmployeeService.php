<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;

class EmployeeService
{

    private $employeeRepository;
    private $session;

    public function __construct()
    {
        $this->employeeRepository = new EmployeeRepository();
        $this->session = new Session();
    }
    public function getProductList()
    {
        $products = $this->employeeRepository->getProductList();
        return $products;
    }
    public function getProductsSorted($keyword)
    {
        return $this->employeeRepository->getProductsSorted($keyword);
    }
    public function createSales($salesData): mixed
    {
        $userId = $this->session->get('user')->getId();
        $employeeId = $this->session->get('data')->getId();
        return $this->employeeRepository->createSales($salesData, $userId, $employeeId);
    }
    public function getObjectifsList($userId)
    {
        return $this->employeeRepository->getObjectifsList($userId);
    }
}
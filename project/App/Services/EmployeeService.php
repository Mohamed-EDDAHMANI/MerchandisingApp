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
}
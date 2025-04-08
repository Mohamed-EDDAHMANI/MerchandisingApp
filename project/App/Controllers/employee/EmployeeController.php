<?php 

namespace App\Controllers\employee;

use App\Controllers\BaseController;
use App\Services\EmployeeService;

class EmployeeController extends BaseController{

    private $employeeService;

    public function __construct() {
        $this->employeeService = new EmployeeService();
    }

    public function index()
    {
        $products = $this->employeeService->getProductList();
        return  $this->view('employee/home', ['products' => $products]);
    }

    public function getProducts($keyword = null)
    {
        $json = file_get_contents("php://input");
        $filters = json_decode($json, true);
        $keyword = isset($filters['name']) ? $filters['name'] : null;

        $products = $this->employeeService->getProductsSorted($keyword);
        echo json_encode($products);
        exit;
    }

    public function createEmployee()
    {
        // Logic to create a new employee
        return view('employee/createEmployee');
    }

    public function updateEmployee($id)
    {
        // Logic to update an existing employee
        return view('employee/updateEmployee', ['id' => $id]);
    }

    public function deleteEmployee($id)
    {
        // Logic to delete an employee
        return view('employee/deleteEmployee', ['id' => $id]);
    }
}
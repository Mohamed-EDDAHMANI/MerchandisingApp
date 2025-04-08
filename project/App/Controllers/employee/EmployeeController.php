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

    public function getEmployeeById($id)
    {
        // Logic to get employee by ID
        return view('employee/employeeDetails', ['id' => $id]);
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
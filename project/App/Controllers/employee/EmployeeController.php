<?php 

namespace App\Controllers\employee;

use App\Controllers\BaseController;
use App\Services\EmployeeService;
use App\Utils\Sessions\Session;

class EmployeeController extends BaseController{

    private $employeeService;
    private $session;

    public function __construct() {
        $this->employeeService = new EmployeeService();
        $this->session = new Session();
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

    public function createSales()
    {
        $json = file_get_contents("php://input");
        $filters = json_decode($json, true);
        $sales = isset($filters['sales']) ? $filters['sales'] : null;

        $res = $this->employeeService->createSales($sales);
        echo json_encode($res);
        if ($res === true) {
            $this->session->setError('success', 'Supplier Deleted successfully');
        } else {
            $this->session->setError('error', 'Error Deleting Supplier !!');
        }
        exit;
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
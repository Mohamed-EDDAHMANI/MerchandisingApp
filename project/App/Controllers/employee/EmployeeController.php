<?php 

namespace App\Controllers\employee;

use App\Controllers\BaseController;
use App\Services\EmployeeService;
use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;

class EmployeeController extends BaseController{

    private $employeeService;
    private $session;

    public function __construct() {
        $this->employeeService = new EmployeeService();
        $this->session = new Session();
    }

    public function index()
    {
        $employeeId = $this->session->get('data')->getId();
        $userId = $this->session->get('user')->getId();
        $products = $this->employeeService->getProductList();
        $objectifs = $this->employeeService->getObjectifsList($employeeId);
        $reports = $this->employeeService->getReports($userId);
        $statistics = $this->employeeService->getStatistics($employeeId);
        $userData = $this->session->get('user');

        return  $this->view('employee/home', ['products' => $products, 'objectifs' => $objectifs, 'reports' => $reports, 'statistics' => $statistics, 'userData' => $userData]);
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
        echo json_encode(['success' => $res]);
        if ($res == true) {
            $this->session->setError('success', 'Supplier Deleted successfully');
        } else {
            $this->session->setError('error', 'Error Stock Quentity !!');
        }
        exit;
    }
    public function getSales()
    {
        $json = file_get_contents("php://input");
        $filters = json_decode($json, true);
        $sales = isset($filters['key']) ? $filters['key'] : null;

        $employeeId = $this->session->get('data')->getId();
        $sales = $this->employeeService->getSales($sales, $employeeId);
        echo json_encode($sales);
        exit;
    }
    public function createReport()
    {
        $userId = $this->session->get('user')->getId();
        $res = $this->employeeService->createReport($_POST, $userId);
        if ($res == true) {
            $this->session->setError('success', 'Report Created successfully');
        } else {
            $this->session->setError('error', 'Error Creating Report !!');
        }
        Redirect::to('/employee/home');
        exit;
    }
}
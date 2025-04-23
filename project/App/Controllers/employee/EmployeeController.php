<?php

namespace App\Controllers\employee;

use App\Controllers\BaseController;
use App\Services\EmployeeService;
use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;

class EmployeeController extends BaseController
{

    private $employeeService;
    private $session;

    public function __construct()
    {
        $this->employeeService = new EmployeeService();
        $this->session = new Session();
    }

    public function index()
    {
        $employeeId = $this->session->get('data')->getId();
        $userId = $this->session->get('user')->getId();
        $store = $this->session->get('store');
        $products = $this->employeeService->getProductList();
        $objectifs = $this->employeeService->getObjectifsList($employeeId);
        $reports = $this->employeeService->getReports($userId);
        $statistics = $this->employeeService->getStatistics($employeeId);
        $userData = $this->session->get('user');
        return $this->view('employee/home', ['products' => $products, 'objectifs' => $objectifs, 'reports' => $reports, 'statistics' => $statistics, 'userData' => $userData, 'store' => $store]);
    }

    public function getProducts($keyword = null)
    {
        $json = file_get_contents("php://input");
        $storeId = $this->session->get('user')->getStoreId();
        $filters = json_decode($json, true);
        $keyword = isset($filters['name']) ? $filters['name'] : null;

        $products = $this->employeeService->getProductsSorted($keyword, $storeId);
        echo json_encode($products);
        exit;
    }

    public function createSales()
    {
        header('Content-Type: application/json');

        try {
            $json = file_get_contents("php://input");
            if ($json === false) {
                throw new \Exception('Failed to read input data');
            }

            $filters = json_decode($json, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON input: ' . json_last_error_msg());
            }

            $sales = $filters['sales'] ?? null;
            if ($sales === null) {
                throw new \Exception('Sales data is required');
            }

            $res = $this->employeeService->createSales($sales);

            echo json_encode([
                'success' => $res
            ]);
        } catch (\Exception $e) {
            http_response_code(500); 
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ]);
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
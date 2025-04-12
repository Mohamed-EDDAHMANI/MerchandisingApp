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
        $achievedCount = 0;
        $notAchievedCount = 0;
        $userId = $this->session->get('user')->getId();
        $employeeId = $this->session->get('data')->getId();
        $res = $this->employeeRepository->createSales($salesData, $userId, $employeeId);
        if ($res === true) {
            $objectifsData = $this->employeeRepository->getObjectifsList($employeeId);
            foreach ($objectifsData as $objectif) {
                if ($objectif->getAchievement_status() === 'Achieved') {
                    $achievedCount++;
                } else {
                    $notAchievedCount++;
                }
            }
            $this->employeeRepository->updatePerformance($achievedCount, $notAchievedCount, $employeeId);
            return true;
        } else {
            return false;
        }
    }
    public function getObjectifsList($userId)
    {
        return $this->employeeRepository->getObjectifsList($userId);
    }
}
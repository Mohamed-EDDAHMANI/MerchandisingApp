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
    public function getProductsSorted($keyword, $storeId)
    {
        return $this->employeeRepository->getProductsSorted($keyword, $storeId);
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
            if ($objectifsData) {
                foreach ($objectifsData as $objectif) {
                    if ($objectif->getAchievement_status() === 'Achieved') {
                        $achievedCount++;
                    } else {
                        $notAchievedCount++;
                    }
                }
                $this->employeeRepository->updatePerformance($achievedCount, $notAchievedCount, $employeeId);
            }
            return true;
        } else {
            return false;
        }
    }
    public function getObjectifsList($userId)
    {
        return $this->employeeRepository->getObjectifsList($userId);
    }
    public function createReport($report, $userId)
    {
        return $this->employeeRepository->createReport($report, $userId);
    }
    public function getSales($key, $employeeId)
    {
        return $this->employeeRepository->getSales($key, $employeeId);
    }
    public function getReports($userId)
    {
        return $this->employeeRepository->getReports($userId);
    }
    public function getStatistics($employeeId)
    {
        $objectifsData = $this->employeeRepository->getObjectifsList($employeeId);
        $montant = 0;
        $quantity = 0;
        $achievedCount = 0;
        $notAchievedCount = 0;
        if($objectifsData){
            foreach ($objectifsData as $objectif) {
                $montant += $objectif->getTotal_sales_amount();
                $quantity += $objectif->getTotal_quantity_sold();
                if ($objectif->getAchievement_status() === 'Achieved') {
                    $achievedCount++;
                } else {
                    $notAchievedCount++;
                }
            }
            $totalObjectives = $achievedCount + $notAchievedCount;
            return [
                'montant' => $montant,
                'quantity' => $quantity,
                'persontage' => $totalObjectives > 0 
                ? ($achievedCount / $totalObjectives) * 100 
                : 0,
            ];
        }else{
            $statistics = $this->employeeRepository->getStatistics($employeeId);
            return [
                'montant' => $statistics['total_sales_amount'],
                'quantity' => $statistics['total_quantity_sold'],
                'persontage' => 0,
            ];
        }
    }
}
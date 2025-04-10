<?php

namespace App\Models;

class Employee
{
    private $id;
    private $isValid;
    private $salary;
    private $performance;
    private $userId;
    private $montantTotal;
    private $quantityTotal;

    // Constructor
    public function __construct($employee){
        $this->id = $employee['employee_id'] ?? null;
        $this->isValid = $employee['employee_valid'] ?? null;
        $this->salary = $employee['employee_salary'] ?? null;
        $this->performance = $employee['performance'] ?? null;
        $this->userId = $employee['user_id'] ?? null;
    }


    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getIsValid()
    {
        return $this->isValid;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function getPerformance()
    {
        return $this->performance;
    }

    public function getUserId()
    {
        return $this->userId;
    }
    public function getMontantTotal()
    {
        return $this->montantTotal;
    }
    public function getQuantityTotal()
    {
        return $this->quantityTotal;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;
    }

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    public function setPerformance($performance)
    {
        $this->performance = $performance;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    public function setMontantTotal($montantTotal)
    {
        $this->montantTotal = $montantTotal;
    }
    public function setQuantityTotal($quantityTotal)
    {
        $this->quantityTotal = $quantityTotal;
    }
}

?>
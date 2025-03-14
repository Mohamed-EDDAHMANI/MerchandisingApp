<?php

namespace App\Models;

class Manager
{
    private $id;
    private $isValid;
    private $salary;
    private $userId;

    // Constructor
    public function __construct($manager){
        $this->id = $manager['manager_id'] ?? null;
        $this->isValid = $manager['manager_valid'] ?? null;
        $this->salary = $manager['manager_salary'] ?? null;
        $this->userId = $manager['user_id'] ?? null;
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

    public function getUserId()
    {
        return $this->userId;
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

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}

?>

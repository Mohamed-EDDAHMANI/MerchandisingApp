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
        $this->id = $manager['id'];
        $this->isValid = $manager['is_valid'];
        $this->salary = $manager['salary'];
        $this->userId = $manager['user_id'];
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

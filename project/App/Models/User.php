<?php

namespace App\Models;

class User
{
    private $id;
    private $password;
    private $email;
    private $firstName;
    private $lastName;
    private $storeId;
    private $roleId;
    private $createdAt;
    private $updatedAt;
    private $manager;
    private $employee;
    private $role;
    private $store;

    // Constructor
    public function __construct($user){
        $this->id = $user['id'];
        $this->password = $user['password'] ?? null;
        $this->email = $user['email'];
        $this->firstName = $user['first_name'] ?? null;
        $this->lastName = $user['last_name'] ?? null;
        $this->storeId = $user['store_id'] ?? null;
        $this->roleId = $user['role_id'] ?? null;
        $this->createdAt = $user['created_at'] ?? null;
        $this->updatedAt = $user['updated_at'] ?? null;
    }
    

    public function setStore(Store $store) {
        $this->store = $store;
    }

    public function setManager(Manager $manager) {
        $this->manager = $manager;
    }

    public function setRole(Role $role) {
        $this->role = $role ;
    }

    public function setEmployee(Employee $employee) {
        $this->employee = $employee;
    }

    //get instences
    public function getManager() {
        return $this->manager;
    }
    public function getEmployee() {
        return $this->employee;
    }
    public function getRole() {
        return $this->role;
    }
    public function getStore() {
        return $this->store;
    }

    public function getFullName() {
        return $this->firstName . ' ' . $this->lastName;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getStoreId()
    {
        return $this->storeId;
    }

    public function getRoleId()
    {
        return $this->roleId;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;
    }

    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
}

?>

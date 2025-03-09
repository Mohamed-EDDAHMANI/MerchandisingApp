<?php

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

    // Constructor
    public function __construct($id, $password, $email, $firstName = null, $lastName = null, $storeId, $roleId, $createdAt = null, $updatedAt = null)
    {
        $this->id = $id;
        $this->password = $password;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->storeId = $storeId;
        $this->roleId = $roleId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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

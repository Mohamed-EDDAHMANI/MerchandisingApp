<?php

namespace App\Models;

class Role
{
    private $id;
    private $role;

    // Constructor
    public function __construct($role){
        $this->id = $role['role_id'] ?? null;
        $this->role = $role['role_name'] ?? null;
    }


    public function getId()
    {
        return $this->id;
    }
    public function getRole()
    {
        return $this->role;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }
}
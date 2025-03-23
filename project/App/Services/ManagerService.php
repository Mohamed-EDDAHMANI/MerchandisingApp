<?php 

namespace App\Services;

class ManagerService{

    private $managerRepository;

    public function __construct(){
        $this->managerRepository = new ManagerRepository();
    }
}


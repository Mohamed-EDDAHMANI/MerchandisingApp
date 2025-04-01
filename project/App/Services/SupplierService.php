<?php

namespace App\Services;

use App\Repositories\SupplierRepository;

class SupplierService
{

    private $supplierRepository;

    public function __construct()
    {
        $this->supplierRepository = new SupplierRepository();
    }

    public function createSupplier($data){
        return $this->supplierRepository->createSupplier($data);
    }

    public function getSupplierById($id){
        return $this->supplierRepository->getSupplierById($id);
    }

    public function deleteSupplier($id){
        return $this->supplierRepository->deleteSupplier($id);
    }


    
    
}
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
}
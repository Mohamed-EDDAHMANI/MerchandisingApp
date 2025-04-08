<?php

namespace App\Models;

class Sale
{
    private $saleId;
    private $productId;
    private $employeeId;
    private $storeId;
    private $quantity;
    private $total;
    private $date;

    // Constructor
    public function __construct($sale)
    {
        $this->saleId = $sale['sale_id'] ?? null;
        $this->productId = $sale['product_id'];
        $this->employeeId = $sale['employee_id'];
        $this->storeId = $sale['store_id'];
        $this->quantity = $sale['quantity'];
        $this->total = $sale['total'];
        $this->date = $sale['date'] ?? null;
    }

    // Getters
    public function getSaleId() {
        return $this->saleId;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function getEmployeeId() {
        return $this->employeeId;
    }

    public function getStoreId() {
        return $this->storeId;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getDate() {
        return $this->date;
    }

    // Setters
    public function setSaleId($saleId) {
        $this->saleId = $saleId;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
    }

    public function setEmployeeId($employeeId) {
        $this->employeeId = $employeeId;
    }

    public function setStoreId($storeId) {
        $this->storeId = $storeId;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function setDate($date) {
        $this->date = $date;
    }
}

<?php

namespace App\Models;

class Order {
    private $order_id;
    private $supplier_id;
    private $manager_id;
    private $product_id;
    private $quantity;
    private $is_done;
    private $created_at;
    private $date_of_affect;
    private $supplier_name;
    private $product_name;

    public function __construct($order) {
        $this->order_id = $order['order_id'] ?? null;
        $this->supplier_id = $order['supplier_id'] ?? 0;
        $this->manager_id = $order['manager_id'] ?? 0;
        $this->product_id = $order['product_id'] ?? 0;
        $this->quantity = $order['quantity'] ?? 0;
        $this->is_done = $order['is_done'] ?? false;
        $this->created_at = $order['created_at'] ?? null;
        $this->date_of_affect = $order['date_of_affect'] ?? null;
    }

    public function getOrderId(): ?int {
        return $this->order_id;
    }

    public function getSupplierId(): int {
        return $this->supplier_id;
    }

    public function getManagerId(): int {
        return $this->manager_id;
    }

    public function getProductId(): int {
        return $this->product_id;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    public function isDone(): bool {
        return $this->is_done;
    }

    public function getCreatedAt(): ?string {
        return $this->created_at;
    }

    public function getDateOfAffect(): ?string {
        return $this->date_of_affect;
    }
    public function getSupplierName(): ?string {
        return $this->supplier_name;
    }
    public function getProductName(): ?string {
        return $this->product_name;
    }

    public function setSupplierId(int $supplier_id): void {
        $this->supplier_id = $supplier_id;
    }

    public function setManagerId(int $manager_id): void {
        $this->manager_id = $manager_id;
    }

    public function setProductId(int $product_id): void {
        $this->product_id = $product_id;
    }

    public function setQuantity(int $quantity): void {
        $this->quantity = $quantity;
    }

    public function setIsDone(bool $is_done): void {
        $this->is_done = $is_done;
    }

    public function setCreatedAt(string $created_at): void {
        $this->created_at = $created_at;
    }

    public function setDateOfAffect(?string $date_of_affect): void {
        $this->date_of_affect = $date_of_affect;
    }
    public function setSupplierName($supplier_name): void {
        $this->supplier_name = $supplier_name;
    }
    public function setProductName($product_name): void {
        $this->product_name = $product_name;
    }
}

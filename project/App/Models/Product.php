<?php
namespace App\Models;

class Product {
    private $product_id;
    private $product_name;
    private $trade_price;
    private $sale_price;
    private $profit;
    private $category_id;
    private $product_count;
    private $category_name;
    private $totalSalesQuantity;

    // Constructor using an associative array
    public function __construct($data) {
        $this->product_id = $data['product_id'] ?? null;
        $this->product_name = $data['product_name'] ?? null;
        $this->trade_price = $data['trade_price'] ?? null;
        $this->sale_price = $data['sale_price'] ?? null;
        $this->profit = $data['profit'] ?? null;
        $this->category_id = $data['category_id'] ?? null;
    }

    // Getters
    public function getProductId() { return $this->product_id; }
    public function getProductName() { return $this->product_name; }
    public function getTradePrice() { return $this->trade_price; }
    public function getSalePrice() { return $this->sale_price; }
    public function getProfit() { return $this->profit; }
    public function getCategoryId() { return $this->category_id; }
    public function getProductCount() { return $this->product_count; }
    public function getCategoryName() { return $this->category_name; }
    public function getTotalSalesQuantity() { return $this->totalSalesQuantity; }

    // Setters
    public function setProductId($product_id) { $this->product_id = $product_id; }
    public function setProductName($product_name) { $this->product_name = $product_name; }
    public function setTradePrice($trade_price) { $this->trade_price = $trade_price; }
    public function setSalePrice($sale_price) { $this->sale_price = $sale_price; }
    public function setProfit($profit) { $this->profit = $profit; }
    public function setCategoryId($category_id) { $this->category_id = $category_id; }
    public function setProductCount($product_count) { $this->product_count = $product_count; }
    public function setCategoryName($category_name) { $this->category_name = $category_name; }
    public function setTotalSalesQuantity($totalSalesQuantity) { $this->totalSalesQuantity = $totalSalesQuantity; }
}

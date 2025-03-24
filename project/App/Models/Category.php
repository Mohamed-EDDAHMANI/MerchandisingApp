<?php

namespace App\Models;

class Category {
    private $category_id;
    private $category_name;
    private $description;
    private $product_count;

    // Constructor
    public function __construct($category) {
        $this->category_id = $category['category_id'] ?? null;
        $this->category_name = $category['category_name'] ?? null;
        $this->description = $category['description'] ?? null;
    }

    // Getter for category_id
    public function getCategoryId() {
        return $this->category_id;
    }

    // Setter for category_id
    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }

    // Getter for category_name
    public function getCategoryName() {
        return $this->category_name;
    }

    // Setter for category_name
    public function setCategoryName($category_name) {
        $this->category_name = $category_name;
    }

    // Getter for description
    public function getDescription() {
        return $this->description;
    }

    // Setter for description
    public function setDescription($description) {
        $this->description = $description;
    }

    // Getter for product_count
    public function getProductCount() {
        return $this->product_count;
    }

    // Setter for product_count
    public function setProductCount($product_count) {
        $this->product_count = $product_count;
    }
}

?>

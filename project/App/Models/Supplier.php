<?php

namespace App\Models;

class Supplier {
    private $id;
    private $name;
    private $contactPhone;
    private $city;
    private $postalCode;
    private $country;
    private $phone;
    private $email;
    private $status;
    private $categoryId;
    private $categoryName;
    
    // Constructor
    public function __construct($supplierData) {
        $this->id = $supplierData['supplier_id'] ?? null;
        $this->name = $supplierData['supplier_name'] ?? null;
        $this->contactPhone = $supplierData['contact_phone'] ?? null;
        $this->city = $supplierData['city'] ?? null;
        $this->postalCode = $supplierData['postal_code'] ?? null;
        $this->country = $supplierData['country'] ?? null;
        $this->phone = $supplierData['phone'] ?? null;
        $this->email = $supplierData['email'] ?? null;
        $this->status = $supplierData['status'] ?? null;
        $this->categoryId = $supplierData['category_id'] ?? null;
        $this->categoryName = $supplierData['category_name'] ?? null;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getContactPhone() {
        return $this->contactPhone;
    }

    public function getCity() {
        return $this->city;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function getCategoryName() {
        return $this->categoryName;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setContactPhone($contactPhone) {
        $this->contactPhone = $contactPhone;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }

    public function setCategoryName($categoryName) {
        $this->categoryName = $categoryName;
    }
}

?>

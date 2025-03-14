<?php 

namespace App\Models;

class Store {
    private $id;
    private $name;
    private $address;
    private $city;
    private $status;
    private $parkingSpace;
    private $createdAt;
    private $updatedAt;

    // Constructor
    public function __construct($storeData) {
        $this->id = $storeData['id'] ?? null;
        $this->name = $storeData['name'] ?? null;
        $this->address = $storeData['address'] ?? null;
        $this->city = $storeData['city'] ?? null;
        $this->status = $storeData['status'] ?? null;
        $this->parkingSpace = $storeData['parking_space'] ?? false;
        $this->createdAt = $storeData['created_at'] ?? null;
        $this->updatedAt = $storeData['updated_at'] ?? null;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCity() {
        return $this->city;
    }

    public function getStatus() {
        return $this->status;
    }

    public function hasParkingSpace() {
        return $this->parkingSpace;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    // Setters
    public function setName(string $name) {
        $this->name = $name;
    }

    public function setAddress(string $address) {
        $this->address = $address;
    }

    public function setCity(string $city) {
        $this->city = $city;
    }

    public function setStatus(string $status) {
        $this->status = $status;
    }

    public function setParkingSpace(bool $parkingSpace) {
        $this->parkingSpace = $parkingSpace;
    }

    public function setUpdatedAt(string $updatedAt) {
        $this->updatedAt = $updatedAt;
    }
}

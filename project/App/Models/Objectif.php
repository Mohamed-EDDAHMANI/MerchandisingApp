<?php
namespace App\Models;

class Objectif {
    private $objectif_id;
    private $frequency;
    private $type;
    private $target;
    private $created_at;
    private $expiration_date;
    private $manager_id;
    private $total_quantity_sold;
    private $total_sales_amount;
    private $achievement_status;
    private $percentage;

    // Constructeur avec un tableau associatif
    public function __construct($data) {
        $this->objectif_id = $data['objectif_id'] ?? null;
        $this->frequency = $data['frequency'] ?? null;
        $this->type = $data['type'] ?? null;
        $this->target = $data['target'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
        $this->expiration_date = $data['expiration_date'] ?? null;
        $this->manager_id = $data['manager_id'] ?? null;
    }

    // Getters
    public function getObjectifId() {
        return $this->objectif_id;
    }

    public function getFrequency() {
        return $this->frequency;
    }

    public function getType() {
        return $this->type;
    }

    public function getTarget() {
        return $this->target;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getExpirationDate() {
        return $this->expiration_date;
    }

    public function getManagerId() {
        return $this->manager_id;
    }
    public function getTotal_quantity_sold() {
        return $this->total_quantity_sold;
    }
    public function getTotal_sales_amount() {
        return $this->total_sales_amount;
    }
    public function getAchievement_status() {
        return $this->achievement_status;
    }
    public function getPercentage() {
        return $this->percentage;
    }

    // Setters
    public function setObjectifId($objectif_id) {
        $this->objectif_id = $objectif_id;
    }

    public function setFrequency($frequency) {
        $this->frequency = $frequency;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setTarget($target) {
        $this->target = $target;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function setExpirationDate($expiration_date) {
        $this->expiration_date = $expiration_date;
    }

    public function setManagerId($manager_id) {
        $this->manager_id = $manager_id;
    }
    public function setTotal_quantity_sold($total_quantity_sold) {
        $this->total_quantity_sold = $total_quantity_sold;
    }
    public function setTotal_sales_amount($total_sales_amount) {
        $this->total_sales_amount = $total_sales_amount;
    }
    public function setAchievement_status($achievement_status) {
        $this->achievement_status = $achievement_status;
    }
    public function setPercentage($percentage) {
        $this->percentage = $percentage;
    }
}

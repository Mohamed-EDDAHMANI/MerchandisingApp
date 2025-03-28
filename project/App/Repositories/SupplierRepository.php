<?php

namespace App\Repositories;

use PDO;
use Config\Database;
use App\Core\Repository;
use App\Models\User;
use App\Models\Manager;
use App\Models\Employee;
use App\Utils\Mappers\dataMapper;
use Exception;


class SupplierRepository extends Repository {

    public function createSupplier($data){
        try {
            $sql = 'INSERT INTO suppliers (supplier_name, contact_phone, city, postal_code, country, phone, email, status, category_id)
                        VALUES (:supplier_name, :contact_phone, :city, :postal_code, :country, :phone, :email, :status, :category_id)';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('supplier_name', $data['supplier_name']);
            $stmt->bindParam('contact_phone', $data['contact_phone']);
            $stmt->bindParam('city', $data['city']);
            $stmt->bindParam('postal_code', $data['postal_code']);
            $stmt->bindParam('country', $data['country']);
            $stmt->bindParam('phone', $data['phone']);
            $stmt->bindParam('email', $data['email']);
            $stmt->bindParam('status', $data['status']);
            $stmt->bindParam('category_id', $data['category_id']);
            return $stmt->execute();
        } catch (Exception $e) {
            return ["error" => "Error creating supplier: " . $e->getMessage()];
        }
    }

}
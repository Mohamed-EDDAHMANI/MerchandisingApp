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


class SupplierRepository extends Repository
{

    public function createSupplier($data)
    {
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
    public function getSupplierById($id)
    {
        try {
            $sql = 'SELECT s.supplier_id, s.supplier_name, s.contact_phone, s.city, s.postal_code, 
                           s.country, s.phone, s.email, s.status, c.category_name , s.category_id
                    FROM suppliers s
                    JOIN categories c ON s.category_id = c.category_id
                    WHERE s.supplier_id = :id';

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('id', $id);
            $stmt->execute();
            $supplier = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $supplier;
        } catch (Exception $e) {
            return ["error" => "Error fetching suppliers: " . $e->getMessage()];
        }
    }
    public function updateSupplier($data, $id)
    {
        try {
            $sql = 'UPDATE suppliers 
                    SET supplier_name = :supplier_name, 
                        contact_phone = :contact_phone, 
                        city = :city, 
                        postal_code = :postal_code, 
                        country = :country, 
                        phone = :phone, 
                        email = :email, 
                        status = :status, 
                        category_id = :category_id
                    WHERE supplier_id = :id';

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':supplier_name', $data['supplier_name']);
            $stmt->bindParam(':contact_phone', $data['contact_phone']);
            $stmt->bindParam(':city', $data['city']);
            $stmt->bindParam(':postal_code', $data['postal_code']);
            $stmt->bindParam(':country', $data['country']);
            $stmt->bindParam(':phone', $data['contact_phone']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':status', $data['status']);
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return ["error" => "Error updating supplier: " . $e->getMessage()];
        }
    }




}
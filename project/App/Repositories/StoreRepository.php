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
use PDOException;


class StoreRepository extends Repository
{
    public function createPointDeVente($data)
    {
        try {
            $query = "INSERT INTO stores (name, address, city, status, parking_space, created_at, updated_at) 
                  VALUES (:name, :address, :city, :status, :parking_space, NOW(), NOW())";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':address', $data['address'], PDO::PARAM_STR);
            $stmt->bindParam(':city', $data['city'], PDO::PARAM_STR);
            $stmt->bindParam(':status', $data['status'], PDO::PARAM_STR);
            $stmt->bindParam(':parking_space', $data['parking_space'], PDO::PARAM_BOOL);
            return $stmt->execute();

        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

    public function getPointsDeVente()
    {
        try {
            $stores = $this->getAll('stores');
            $storsInstences = DataMapper::StoreMapper($stores);
            return $storsInstences;
        } catch (PDOException $e) {
            return "Error :" . $e->getMessage();
        }
    }

    public function getPointsDeVenteById($id)
    {
        try {
            $store = $this->getById('stores', $id);
            return $store;
        } catch (PDOException $e) {
            return "Error :" . $e->getMessage();
        }
    }

    public function create($data)
    {
        // Query to create a new point de vente
    }

    public function updatePointDeVente($id, $data)
    {
        try {
            $sql = "UPDATE users 
        SET first_name = :first_name, 
            last_name = :last_name, 
            email = :email,
            role_id = :role_id 
        WHERE id = :id";

        }

    }

    public function delete($id)
    {
        // Query to delete a point de vente
    }
}
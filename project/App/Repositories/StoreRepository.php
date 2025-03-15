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

    public function deletePointDeVente($id)
    {
        try {
            $store = $this->deleteById('stores', $id);
            return $store;
        } catch (PDOException $e) {
            return "Error :" . $e->getMessage();
        }
    }

    public function create($data)
    {
        // Query to create a new point de vente
    }

    public function updatePointDeVente($data, $id)
    {
        
        try {
            $parkingSpace = ($data['parkingSpace'] ?? 'on' == 'on') ? 1 : 0;
            $sql = "UPDATE stores 
                    SET name = :name, 
                        address = :address, 
                        city = :city,
                        status = :status ,
                        parking_space = :parking_space 
                    WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':address', $data['address'], PDO::PARAM_STR);
            $stmt->bindParam(':city', $data['city'], PDO::PARAM_STR);
            $stmt->bindParam(':status', $data['status'], PDO::PARAM_STR);
            $stmt->bindParam(':parking_space', $parkingSpace, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
            return $stmt->execute();
        }catch (PDOException $e) {
            return "Error :". $e->getMessage();
        }
    }

    public function delete($id)
    {
        // Query to delete a point de vente
    }
}
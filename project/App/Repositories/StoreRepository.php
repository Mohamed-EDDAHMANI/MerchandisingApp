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
            $parkingSpace = ($data['parkingSpace'] ?? 'on' == 'on') ? 1 : 0;
            $query = "INSERT INTO stores (store_name, address, city, status, parking_space, created_at, updated_at) 
                  VALUES (:store_name, :address, :city, :status, :parking_space, NOW(), NOW())";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':store_name', $data['store_name'], PDO::PARAM_STR);
            $stmt->bindParam(':address', $data['address'], PDO::PARAM_STR);
            $stmt->bindParam(':city', $data['city'], PDO::PARAM_STR);
            $stmt->bindParam(':status', $data['status'], PDO::PARAM_STR);
            $stmt->bindParam(':parking_space', $parkingSpace, PDO::PARAM_BOOL);
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

    public function getPointsDeVentePanding()
    {
        try {
            $stores = $this->getAll('stores', '*', 'status = ?', ['pending']);
            $storsInstences = DataMapper::StoreMapper($stores);
            return $storsInstences;
        } catch (PDOException $e) {
            return "Error :" . $e->getMessage();
        }
    }

    public function getPointsDeVenteById($id)
    {
        try {
            $store = $this->getAll('stores', '*', 'store_id = ?', [$id]);
            return $store;
        } catch (PDOException $e) {
            return "Error :" . $e->getMessage();
        }
    }

    public function deletePointDeVente($id)
    {
        try {
            $sql = "DELETE FROM stores WHERE store_id = :store_id LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':store_id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error :" . $e->getMessage();
        }
    }

    public function updatePointDeVente($data, $id)
    {

        try {
            $parkingSpace = isset($data['parkingSpace']) && $data['parkingSpace'] == 'on' ? 1 : 0;
            $sql = "UPDATE stores 
                    SET store_name = :store_name, 
                        address = :address, 
                        city = :city,
                        status = :status,
                        parking_space = :parking_space 
                    WHERE store_id = :store_id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':store_name', $data['store_name'], PDO::PARAM_STR);
            $stmt->bindParam(':address', $data['address'], PDO::PARAM_STR);
            $stmt->bindParam(':city', $data['city'], PDO::PARAM_STR);
            $stmt->bindParam(':status', $data['status'], PDO::PARAM_STR);
            $stmt->bindParam(':parking_space', $parkingSpace, PDO::PARAM_INT);
            $stmt->bindParam(':store_id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error :" . $e->getMessage();
        }
    }

    public function getStoreCountsByStatus()
    {
        try {
            $sql = "SELECT 
                        status, 
                        COUNT(*) AS count
                    FROM stores
                    WHERE status IN ('active', 'pending', 'inactive')
                    GROUP BY status";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $storeCounts = [
                'active' => 0,
                'total' => 0,
                'inactive' => 0,
            ];
            foreach ($result as $row) {
                $storeCounts[$row['status']] = $row['count'];
            }

            $storeCounts['total'] = array_sum($storeCounts);

            return $storeCounts;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function recherchPointsDeVente($key)
    {
        try {
            $sql = "SELECT * FROM stores WHERE store_name LIKE :key OR city LIKE :key";

            $stmt = $this->db->prepare($sql);

            $key = "%" . $key . "%";
            $stmt->bindParam(':key', $key, PDO::PARAM_STR);

            $stmt->execute();
            $stores = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $storsInstences = DataMapper::StoreMapper($stores);

            return $storsInstences;
        } catch (PDOException $e) {
            return "Error : " . $e->getMessage();
        }
    }

    public function toggleStatus($id, $status)
    {
        try {
            $query = "UPDATE stores SET status = :status WHERE store_id = :store_id";
            
            $stmt = $this->db->prepare($query);
    
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':store_id', $id, PDO::PARAM_INT);
    
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    


}
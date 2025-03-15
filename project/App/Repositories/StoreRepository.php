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
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

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

    public function getPointsDeVente() {
        try {
            $query = "SELECT * FROM stores";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $stors = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $storsInstences = DataMapper::StoreMapper($stors);
            return $storsInstences;
        } catch (PDOException $e) {
            return "Error :". $e->getMessage();
        }
    }

    public function findById($id) {
        // Query to find a point de vente by ID
    }

    public function create($data) {
        // Query to create a new point de vente
    }

    public function update($id, $data) {
        // Query to update a point de vente
    }

    public function delete($id) {
        // Query to delete a point de vente
    }
}
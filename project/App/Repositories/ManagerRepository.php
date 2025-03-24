<?php

namespace App\Repositories;

use PDO;
use App\Core\Repository;
use App\Utils\Mappers\dataMapper;
use Exception;

class ManagerRepository extends Repository
{

    public function createCategory($data)
    {
        try {

            if ($this->categoryExists($data['category_name'])) {
                return false;
            }
            $sql = "INSERT INTO categories (category_name, description) VALUES (:category_name, :description)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':category_name', $data['category_name']);
            $stmt->bindParam(':description', $data['description']);
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la création de l'utilisateur : " . $e->getMessage());
        }
    }

    public function categoryExists($categoryName)
    {
        try {
            $query = "SELECT COUNT(*) FROM categories WHERE category_name = :category_name";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':category_name', $categoryName, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetchColumn() > 0;
        }catch (Exception $e) {
            throw new Exception('Error :'. $e->getMessage());
        }
    }

}
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

    public function getAllCategories()
    {
        try {
            $query = "SELECT categories.category_id, categories.category_name, categories.description, 
            COUNT(products.product_id) AS product_count
            FROM categories
            LEFT JOIN products ON products.category_id = categories.category_id
            GROUP BY categories.category_id;";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $categoriesInstences = DataMapper::categoriesMapper($categories);
            return $categoriesInstences;

        }catch (Exception $e) {
            throw new Exception('Error :'. $e->getMessage());
        }
    }
    public function getCategoryById($id)
    {
        try {
            $query = "SELECT * FROM categories
            WHERE category_id = :category_id;";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam("category_id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $category = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // $categoryInstences = DataMapper::DataMapper($category, 'Category');
            return $category;

        }catch (Exception $e) {
            throw new Exception('Error :'. $e->getMessage());
        }
    }
    public function udpateCategory($data, $id)
    {
        try {
            $query = "UPDATE categories SET category_name = :category_name, description = :description
            WHERE category_id = :category_id;";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam("category_name", $data['category_name'], PDO::PARAM_STR);
            $stmt->bindParam("description", $data['description'], PDO::PARAM_STR);
            $stmt->bindParam("category_id", $id, PDO::PARAM_INT);
            return $stmt->execute();

        }catch (Exception $e) {
            throw new Exception('Error :'. $e->getMessage());
        }
    }

}
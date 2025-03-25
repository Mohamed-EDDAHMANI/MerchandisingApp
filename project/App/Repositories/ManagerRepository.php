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

            if ($this->itemExists($data['category_name'], 'categories', 'category_name')) {
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
    public function deleteCategory($id)
    {
        try {
            $query = "DELETE FROM categories 
            WHERE category_id = :category_id  LIMIT 1;";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam("category_id", $id, PDO::PARAM_INT);
            return $stmt->execute();
            
        }catch (Exception $e) {
            throw new Exception('Error :'. $e->getMessage());
        }
    }
    public function createProduct($data, $storeID)
    {
        try {

            if ($this->itemExists($data['product_name'],'products', 'product_name')) {
                return false;
            }
            $sql = "INSERT INTO products (product_name, trade_price, sale_price, profit, category_id ) VALUES (:product_name, :trade_price, :sale_price, :profit, :category_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':product_name', $data['product_name']);
            $stmt->bindParam(':trade_price', $data['trade_price']);
            $stmt->bindParam(':sale_price', $data['sale_price']);
            $stmt->bindParam(':profit', $data['profit']);
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->execute();
            $productId = $this->db->lastInsertId();
            return $this->storeStock($data['quantity'], $productId, $storeID);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la création de Produit : " . $e->getMessage());
        }
    }
    public function storeStock($quantity, $productId, $storeID){
        try {
            $sql = "INSERT INTO stocks (store_id, product_id, quentity) VALUES (:store_id, :product_id, :quentity)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':store_id', $storeID);
            $stmt->bindParam(':product_id', $productId);
            $stmt->bindParam(':quentity', $quantity);
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors la création du Stock  : " . $e->getMessage());
        }
    }

}
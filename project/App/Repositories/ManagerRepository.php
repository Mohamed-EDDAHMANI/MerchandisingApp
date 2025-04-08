<?php

namespace App\Repositories;

use LDAP\Result;
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

        } catch (Exception $e) {
            throw new Exception('Error :' . $e->getMessage());
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

        } catch (Exception $e) {
            throw new Exception('Error :' . $e->getMessage());
        }
    }
    public function getProductById($id)
    {
        try {
            $query = "SELECT * FROM products
            INNER JOIN stocks on stocks.product_id = products.product_id
            WHERE products.product_id = :product_id;";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam("product_id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // $categoryInstences = DataMapper::DataMapper($category, 'Category');
            return $product;

        } catch (Exception $e) {
            throw new Exception('Error :' . $e->getMessage());
        }
    }
    public function updateCategory($data, $id)
    {
        try {
            $query = "UPDATE categories SET category_name = :category_name, description = :description
            WHERE category_id = :category_id;";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam("category_name", $data['category_name'], PDO::PARAM_STR);
            $stmt->bindParam("description", $data['description'], PDO::PARAM_STR);
            $stmt->bindParam("category_id", $id, PDO::PARAM_INT);
            return $stmt->execute();

        } catch (Exception $e) {
            throw new Exception('Error :' . $e->getMessage());
        }
    }
    public function updateProduct($data, $id)
    {
        try {
            $query = "UPDATE products
                    SET 
                        product_name = :product_name,  
                        trade_price = :trade_price,    
                        sale_price = :sale_price,      
                        profit = :profit,              
                        category_id = :category_id   
                    WHERE product_id = :product_id;";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":product_name", $data['product_name'], PDO::PARAM_STR);
            $stmt->bindParam(":trade_price", $data['trade_price'], PDO::PARAM_STR);
            $stmt->bindParam(":sale_price", $data['sale_price'], PDO::PARAM_STR);
            $stmt->bindParam(":profit", $data['profit'], PDO::PARAM_STR);
            $stmt->bindParam(":category_id", $data['category_id'], PDO::PARAM_INT);
            $stmt->bindParam(":product_id", $id, PDO::PARAM_INT);
            return $stmt->execute();

        } catch (Exception $e) {
            throw new Exception('Error :' . $e->getMessage());
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

        } catch (Exception $e) {
            throw new Exception('Error :' . $e->getMessage());
        }
    }
    public function deleteProduct($id)
    {
        try {
            $this->db->beginTransaction();
            $query = "DELETE FROM stocks 
            WHERE product_id = :product_id  LIMIT 1;";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam("product_id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $query = "DELETE FROM products 
            WHERE product_id = :product_id  LIMIT 1;";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam("product_id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            throw new Exception('Error :' . $e->getMessage());
        }
    }
    public function createProduct($data, $storeID)
    {
        try {

            if ($this->itemExists($data['product_name'], 'products', 'product_name')) {
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
    public function storeStock($quantity, $productId, $storeID)
    {
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

    public function getAllProducts($storeID)
    {
        try {
            $query = "SELECT 
                    products.product_id, 
                    products.product_name, 
                    products.trade_price, 
                    products.sale_price, 
                    products.profit, 
                    stocks.quentity AS product_count,
                    categories.category_id,
                    categories.category_name
                FROM 
                     products
                JOIN 
                    stocks ON products.product_id = stocks.product_id
                JOIN 
                    categories ON categories.category_id = products.category_id
                WHERE 
                    stocks.store_id = :store_id;";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam("store_id", $storeID);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $productsInstences = DataMapper::productsMapper($products);
            return $productsInstences;

        } catch (Exception $e) {
            throw new Exception('Error :' . $e->getMessage());
        }
    }

    public function sortProduct($storeID ,$category_id = null, $stock = null)
    {
        $params = [];
        $sql = 'SELECT products.product_id, 
                    products.product_name, 
                    products.trade_price, 
                    products.sale_price, 
                    products.profit, 
                    stocks.quentity AS product_count,
                    categories.category_id,
                    categories.category_name
                FROM products
                INNER JOIN stocks ON products.product_id = stocks.product_id
                INNER JOIN categories ON categories.category_id = products.category_id 
                WHERE stocks.store_id = :store_id';

        if (!is_null($category_id)) {
            $sql .= ' AND categories.category_id = :category_id';
            $params[':category_id'] = $category_id;
        }

        if (!is_null($stock) && in_array(strtoupper($stock), ['ASC', 'DESC'])) {
            $sql .= ' ORDER BY product_count ' . $stock;
        }
        $params[':store_id'] = $storeID;
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (Exception $e) {
            return ["error" => "Error fetching product: " . $e->getMessage()];
        }
    }


    public function getAllSuppliersWithCategories() {
        try {
            $sql = 'SELECT s.supplier_id, s.supplier_name, s.contact_phone, s.city, s.postal_code, 
                           s.country, s.phone, s.email, s.status, c.category_name 
                    FROM suppliers s
                    JOIN categories c ON s.category_id = c.category_id';
    
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $supplier =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            $supplierInstences = DataMapper::supplierMapper($supplier);
            return $supplierInstences;
        } catch (Exception $e) {
            return ["error" => "Error fetching suppliers: " . $e->getMessage()];
        }
    }
    public function getAllOrdersWithSupplierAndProduct() {
        try {
            $sql = 'SELECT o.*, p.product_name , s.supplier_name
                    FROM orders o
                    JOIN suppliers s ON s.supplier_id = o.supplier_id
                    JOIN products p ON p.product_id = o.product_id';
    
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $orders =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            $ordersInstentes = DataMapper::orderMapper($orders);
            return $ordersInstentes;
        } catch (Exception $e) {
            return ["error" => "Error fetching orders: " . $e->getMessage()];
        }
    }
    public function getEmployees($id) {
        try {
            $result = $this->getStoreId($id);
            if ($result) {
                $storeId = $result['store_id'];
            } else {
                return false;
            }
            $sql = 'SELECT u.* , e.* , s.* , se.*
                    FROM users u
                    JOIN employees e ON e.user_id = u.id
                    JOIN stores s ON u.store_id = s.store_id
                    LEFT JOIN sales se ON e.employee_id = se.employee_id
                    WHERE s.store_id = :store_id ';
    
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':store_id', $storeId, PDO::PARAM_INT);
            $stmt->execute();
            $users =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            $usersInstentes = DataMapper::UserMapper($users);
            return $usersInstentes;
        } catch (Exception $e) {
            return ["error" => "Error fetching orders: " . $e->getMessage()];
        }
    }

    public function getStoreId($id) {
        try {
            $sql = 'SELECT store_id FROM users WHERE id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return ["error" => "Error fetching store ID: " . $e->getMessage()];
        }
    }

}
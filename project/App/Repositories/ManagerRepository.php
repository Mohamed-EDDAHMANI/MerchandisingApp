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
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la création de Produit : " . $e->getMessage());
        }
    }

    public function getAllProducts($storeID)
    {
        try {
            $query = "SELECT 
    p.product_id, 
    p.product_name, 
    p.trade_price, 
    p.sale_price, 
    p.profit, 
    c.category_id,
    c.category_name,
    COALESCE(s.quentity, 0) AS product_count,
    COALESCE(SUM(sa.quantity), 0) AS total_sales_quantity
FROM 
    products p
JOIN 
    categories c ON p.category_id = c.category_id
LEFT JOIN 
    stocks s ON p.product_id = s.product_id AND s.store_id = :store_id
LEFT JOIN 
    sales sa ON p.product_id = sa.product_id AND sa.store_id = :store_id
GROUP BY 
    p.product_id, p.product_name, p.trade_price, p.sale_price, p.profit,
    c.category_id, c.category_name, s.quentity;
";



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

    public function sortProduct($storeID, $category_id = null, $stock = null)
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

    public function getAllSuppliersWithCategories()
    {
        try {
            $sql = 'SELECT s.supplier_id, s.supplier_name, s.contact_phone, s.city, s.postal_code, 
                           s.country, s.phone, s.email, s.status, c.category_name 
                    FROM suppliers s
                    JOIN categories c ON s.category_id = c.category_id';

            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $supplier = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $supplierInstences = DataMapper::supplierMapper($supplier);
            return $supplierInstences;
        } catch (Exception $e) {
            return ["error" => "Error fetching suppliers: " . $e->getMessage()];
        }
    }
    public function getAllOrdersWithSupplierAndProduct()
    {
        try {
            $sql = 'SELECT o.*, p.product_name , s.supplier_name
                    FROM orders o
                    JOIN suppliers s ON s.supplier_id = o.supplier_id
                    JOIN products p ON p.product_id = o.product_id';

            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $ordersInstentes = DataMapper::orderMapper($orders);
            return $ordersInstentes;
        } catch (Exception $e) {
            return ["error" => "Error fetching orders: " . $e->getMessage()];
        }
    }
    public function getEmployees($id){
        try {
            $result = $this->getStoreId($id);
            if ($result) {
                $storeId = $result['store_id'];
            } else {
                return false;
            }
            $sql = 'SELECT 
    employees.employee_id,
    employees.is_valid,
    employees.salary as employee_salary,
    employees.performance,
    users.id,
    users.password,
    users.email,
    users.first_name,
    users.last_name,
    users.store_id,
    users.role_id,
    users.created_at,
    users.updated_at,
    stores.store_name,
    SUM(sales.total) AS montant_total,
    SUM(sales.quantity) AS quantity_total
FROM employees
JOIN users ON employees.user_id = users.id
JOIN stores ON users.store_id = stores.store_id
LEFT JOIN sales ON employees.employee_id = sales.employee_id
WHERE users.store_id = :store_id 
GROUP BY 
    employees.employee_id,
    employees.is_valid,
    employees.salary,
    employees.performance,
    users.id,
    users.password,
    users.email,
    users.first_name,
    users.last_name,
    users.store_id,
    users.role_id,
    users.created_at,
    users.updated_at;';

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':store_id', $storeId, PDO::PARAM_INT);
            $stmt->execute();

            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $usersInstentes = DataMapper::UserMapper($users);

            return $usersInstentes;
        } catch (Exception $e) {
            return ["error" => "Error fetching orders: " . $e->getMessage()];
        }
    }

    public function getStoreId($id)
    {
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

    public function getObjectifs()
    {
        try {
            $sql = 'SELECT * FROM objectifs';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $objectifs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $objectifsInstences = DataMapper::DataMapper($objectifs, 'Objectif');
            return $objectifsInstences;
        } catch (Exception $e) {
            return ["error" => "Error fetching objectifs: " . $e->getMessage()];
        }
    }
    public function getTotalProductSales($storeId)
    {
        try {
            $sql = 'SELECT SUM(quantity)  as total_product_sales,
                            SUM(total) as total_montant_sales
                    FROM sales WHERE store_id = :store_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':store_id', $storeId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            return ["error" => "Error fetching objectifs: " . $e->getMessage()];
        }
    }
    public function getPandingOrders($user)
    {
        $managerId = $this->getManagerId($user->getId());
        try {
            $sql = 'SELECT COUNT(order_id)  as total_order_panding
                    FROM orders WHERE is_done = 0 
                    AND manager_id = :manager_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':manager_id', $managerId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC)['total_order_panding'];
            return $result;
        } catch (Exception $e) {
            return ["error" => "Error fetching objectifs: " . $e->getMessage()];
        }
    }
    public function getLowProductInStock($storeId)
    {
        try {
            $sql = 'SELECT COUNT(*)  as total_product_low
                    FROM stocks 
                    WHERE quentity < 500
                    AND stocks.store_id = :store_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':store_id', $storeId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC)['total_product_low'];
            return $result;
        } catch (Exception $e) {
            return ["error" => "Error fetching objectifs: " . $e->getMessage()];
        }
    }

    public function getManagerId($userID)
    {
        try {
            $sql = "SELECT manager_id FROM managers  where user_id = :user_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['manager_id'];
        } catch (Exception $e) {
            return false;
        }
    }
    public function getSalesChart($storeId)
    {
        try {
            $sql = "WITH week_days AS (
                    SELECT 
                        CURDATE() - INTERVAL (DAYOFWEEK(CURDATE())-1) DAY + INTERVAL n DAY AS date
                    FROM (
                        SELECT 0 AS n UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 
                        UNION SELECT 4 UNION SELECT 5 UNION SELECT 6
                    ) AS numbers
                )
                SELECT 
                    DAYNAME(w.date) AS day_name,
                    DATE(w.date) AS sale_date,
                    IFNULL(sales_data.total_sales, 0) AS total_sales
                FROM 
                    week_days w
                LEFT JOIN (
                    SELECT 
                        DATE(date) AS sale_date,
                        COUNT(*) AS total_sales
                    FROM 
                        sales
                    WHERE 
                        YEARWEEK(date, 1) = YEARWEEK(CURDATE(), 1)
                        AND store_id = :store_id
                    GROUP BY 
                        DATE(date)
                ) sales_data ON DATE(w.date) = sales_data.sale_date
                ORDER BY 
                    w.date;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':store_id', $storeId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }
    public function getCategoriesData($storeId)
    {
        try {
            $sql = "SELECT 
    c.category_id,
    c.category_name,
    c.description,
    COALESCE(SUM(s.total), 0) AS total_sales_amount
FROM 
    categories c
LEFT JOIN 
    products p ON c.category_id = p.category_id
LEFT JOIN 
    sales s ON p.product_id = s.product_id
    AND s.store_id = :store_id
GROUP BY 
    c.category_id, c.category_name, c.description
ORDER BY 
    total_sales_amount DESC;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':store_id', $storeId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }
    public function getEmployeesSales($storeId)
    {
        try {
            $sql = "SELECT 
    e.employee_id,
    u.first_name,
    u.last_name,
    COALESCE(SUM(s.quantity), 0) AS total_sales_quantity,
    COUNT(s.sale_id) AS number_of_transactions
FROM 
    employees e
JOIN 
    users u ON e.user_id = u.id
LEFT JOIN 
    sales s ON e.employee_id = s.employee_id AND s.store_id = :store_id
WHERE 
    u.store_id = :store_id
GROUP BY 
    e.employee_id, 
    u.first_name, 
    u.last_name;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':store_id', $storeId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

}
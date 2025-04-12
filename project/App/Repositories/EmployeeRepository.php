<?php

namespace App\Repositories;

use PDO;
use Config\Database;
use App\Core\Repository;
use App\Models\User;
use App\Models\Manager;
use App\Models\Employee;
use App\Utils\Mappers\dataMapper;


class EmployeeRepository extends Repository
{
    public function getProductList()
    {
        $sql = "SELECT * FROM products";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return DataMapper::productsMapper($products);
    }

    public function getProductsSorted($keyword)
    {

        $sql = "SELECT * FROM products WHERE product_name LIKE :keyword";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createSales($salesData, $userId, $employeeId): bool
    {
        $storeId = $this->getStoreId($userId);
        // echo '<pre>';
        // var_dump($salesData);
        // echo '</pre>';
        $sql = "INSERT INTO sales (product_id, quantity, total, employee_id, store_id) VALUES (:product_id, :quantity, :total, :employee_id, :store_id)";
        $stmt = $this->db->prepare($sql);

        $this->db->beginTransaction();
        foreach ($salesData as $sale) {
            // var_dump($sale['productId']);
            // exit;
            $stmt->bindValue(':product_id', $sale['productId'], PDO::PARAM_INT);
            $stmt->bindValue(':quantity', $sale['quantity'], PDO::PARAM_INT);
            $stmt->bindValue(':total', $sale['total'], PDO::PARAM_INT);
            $stmt->bindValue(':employee_id', $employeeId, PDO::PARAM_INT);
            $stmt->bindValue(':store_id', $storeId, PDO::PARAM_INT);

            if (!$stmt->execute()) {
                return false;
            }
            $this->updateProductQuantity($sale['productId'], $sale['quantity'], $storeId);
        }
        $this->db->commit();

        return true;
    }

    public function updateProductQuantity($productId, $quantity, $storeId): void
    {
        $sql = "UPDATE stocks SET quentity = quentity - :quentity WHERE store_id = :store_id AND product_id = :product_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':quentity', $quantity, PDO::PARAM_INT);
        $stmt->bindValue(':store_id', $storeId, PDO::PARAM_INT);
        $stmt->bindValue(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function updatePerformance($achievedCount, $notAchievedCount, $employeeId)
    {
        $newPorsentage = $achievedCount / ($achievedCount + $notAchievedCount) * 100;
        
        $sql = "UPDATE employees SET performance = :performance WHERE employee_id = :employee_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':performance', $newPorsentage, PDO::PARAM_INT);
        $stmt->bindValue(':employee_id', $employeeId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getStoreId($userId): int
    {
        $sql = "SELECT store_id FROM users WHERE id = :userId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function getObjectifsList($employeeId)
    {
        $managerId = $this->getManagerId($employeeId);
        $sql = "SELECT 
    o.*,
    e.employee_id,
    SUM(s.quantity) AS total_quantity_sold,
    SUM(s.total) AS total_sales_amount,
    CASE 
        WHEN o.type = 'quantity_product' AND SUM(s.quantity) >= o.target THEN 'Achieved'
        WHEN o.type = 'montant_total' AND SUM(s.total) >= o.target THEN 'Achieved'
        ELSE 'Not Achieved'
    END AS achievement_status,
    CASE 
    WHEN o.target = 0 THEN 0 
    WHEN o.type = 'quantity_product' THEN 
        LEAST(ROUND((COALESCE(SUM(s.quantity), 0) / o.target) * 100, 0), 100)
    WHEN o.type = 'montant_total' THEN 
        LEAST(ROUND((COALESCE(SUM(s.total), 0) / o.target) * 100, 0), 100)
END AS percentage
FROM 
    objectifs o
JOIN 
    employees e ON o.manager_id = (
        SELECT m.manager_id 
        FROM managers m 
        JOIN users u ON m.user_id = u.id 
        WHERE m.manager_id = :manager_id
    )
JOIN 
    users u ON e.user_id = u.id
LEFT JOIN 
    sales s ON e.employee_id = s.employee_id
    AND s.date BETWEEN o.created_at AND o.expiration_date
WHERE 
    o.manager_id = :manager_id
    AND e.employee_id = :employee_id
    AND o.expiration_date > NOW()
GROUP BY 
    o.objectif_id, e.employee_id
ORDER BY 
    o.objectif_id;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':manager_id', $managerId, PDO::PARAM_INT);
        $stmt->bindValue(':employee_id', $employeeId, PDO::PARAM_INT);
        $stmt->execute();
        $objectifs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objectifsInstents = DataMapper::objectifMapper($objectifs);
        return $objectifsInstents;
    }

    public function getManagerId($userId): int
    {
        $sql = "SELECT m.manager_id
                FROM managers m
                JOIN users u ON m.user_id = u.id
                WHERE u.store_id = (
                    SELECT store_id
                    FROM users
                    INNER JOIN employees ON employees.user_id = users.id
                    WHERE employees.employee_id = :employee_id
               );";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':employee_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}

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
        $sql = "INSERT INTO sales (product_id, quantity, total, employee_id, store_id) VALUES (:product_id, :quantity, :total, :employee_id, :store_id)";
        $stmt = $this->db->prepare($sql);

        $this->db->beginTransaction();
        foreach ($salesData as $sale) {
            $stmt->bindValue(':product_id', $sale['productId'], PDO::PARAM_INT);
            $stmt->bindValue(':quantity', $sale['quantity'], PDO::PARAM_INT);
            $stmt->bindValue(':total', $sale['total'], PDO::PARAM_INT);
            $stmt->bindValue(':employee_id', $employeeId, PDO::PARAM_INT);
            $stmt->bindValue(':store_id', $storeId, PDO::PARAM_INT);

            if (!$stmt->execute()) {
                return false;
            }
        }
        $this->db->commit();

        return true;
    }

    public function getStoreId($userId): int
    {
        $sql = "SELECT store_id FROM users WHERE id = :userId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function getObjectifsList($userId)
    {
        $managerId = $this->getManagerId($userId);
        $sql = "SELECT * FROM objectifs WHERE manager_id = :manager_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':manager_id', $managerId, PDO::PARAM_INT);
        $stmt->execute();
        $objectifs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objectifsInstents = DataMapper::DataMapper($objectifs, 'objectif');
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

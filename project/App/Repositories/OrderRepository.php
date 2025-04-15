<?php

namespace App\Repositories;

use App\Models\Order;
use App\Core\Repository;
use PDOException;
use PDO;

class OrderRepository extends Repository
{
    public function createOrder($data, $manager_id)
    {
        try {
            $sql = 'INSERT INTO orders (supplier_id, manager_id, product_id, quantity) VALUES (:supplier_id, :manager_id, :product_id, :quantity)';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('supplier_id', $data['orderSupplier']);
            $stmt->bindParam('manager_id', $manager_id);
            $stmt->bindParam('product_id', $data['product_id']);
            $stmt->bindParam('quantity', $data['orderQuantity']);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error : " . $e->getMessage();
        }
    }

    public function confirmOrder($id, $userId)
    {
        try {
            $this->db->beginTransaction();
            $true = 1;
            $sql = 'UPDATE orders SET is_done = :is_done, date_of_affect = NOW() WHERE order_id = :order_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('is_done', $true);
            $stmt->bindParam('order_id', $id);
            $result = $stmt->execute();
            
            if ($result) {
                $sql = 'SELECT product_id, quantity FROM orders WHERE order_id = :order_id';
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam('order_id', $id);
                $stmt->execute();
                $result = new Order($stmt->fetch(PDO::FETCH_ASSOC));
                
                if ($result instanceof Order) {
                    $res = $this->AddQuantity($result->getQuantity(), $result->getProductId(), $userId);
                    if ($res) {
                        $this->db->commit();
                        return true;
                    }
                }
            }
            
            $this->db->rollBack();
            return false;
        } catch (PDOException $e) {
            return "Error : " . $e->getMessage();
        }
    }

    public function AddQuantity($quentity, $product_id, $userId)
    {
        $checkSql = "SELECT COUNT(*) FROM stocks WHERE product_id = :product_id";
        $checkStmt = $this->db->prepare($checkSql);
        $checkStmt->bindParam(':product_id', $product_id);
        $checkStmt->execute();
        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
            $sql = 'UPDATE stocks SET quentity = quentity + :quentity WHERE product_id = :product_id';
        } else {
            $storeId = $this->getStoreIdFromUser($userId);
            $sql = 'INSERT INTO stocks (quentity, product_id, store_id) VALUES (:quentity, :product_id, :store_id)';
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('quentity', $quentity);
        $stmt->bindParam('product_id', $product_id);
        
        if (isset($storeId)) {
            $stmt->bindParam('store_id', $storeId);
        }

        if ($stmt->execute()) {
            return $this->updateStorePerformance($product_id, $quentity);
        }
        return false;
    }

    public function updateStorePerformance($product_id, $quentity)
    {
        try {
            $storeId = $this->getStoreId($product_id);
            $expenses = $this->getProductTotal($product_id, $quentity);
            $this->updateStorePerformanceAfterBuy($expenses, $storeId);
            return true;
        } catch (PDOException $e) {
            return "Error : " . $e->getMessage();
        }
    }

    public function getStoreId($product_id)
    {
        $sql = 'SELECT store_id FROM stocks WHERE product_id = :product_id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('product_id', $product_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['store_id'];
    }

    public function getStoreIdFromUser($userId)
    {
        $sql = 'SELECT store_id FROM users WHERE id = :user_id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('user_id', $userId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['store_id'];
    }

    public function getProductTotal($product_id, $quentity)
    {
        $sql = 'SELECT trade_price FROM products WHERE product_id = :product_id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('product_id', $product_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['trade_price'] * $quentity;
    }

    public function getOrderByid($id)
    {
        try {
            $sql = 'SELECT * FROM orders
                    INNER JOIN suppliers ON orders.supplier_id = suppliers.supplier_id
                    INNER JOIN products ON orders.product_id = products.product_id
                    WHERE order_id = :order_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('order_id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : false;
        } catch (PDOException $e) {
            return "Error : " . $e->getMessage();
        }
    }
}
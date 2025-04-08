<?php


namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;
use PDO;
use App\Core\Repository;
use App\Utils\Mappers\dataMapper;
use PDOException;

class OrderRepository extends Repository
{

    public function createOrder($data, $manager_id)
    {
        try {
            $sql = 'INSERT INTO orders (supplier_id, manager_id, product_id, quantity) VALUES (:supplier_id, :manager_id, :product_id, :quantity);';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('supplier_id', $data['orderSupplier'], PDO::PARAM_INT);
            $stmt->bindParam('manager_id', $manager_id, PDO::PARAM_INT);
            $stmt->bindParam('product_id', $data['product_id'], PDO::PARAM_INT);
            $stmt->bindParam('quantity', $data['orderQuantity'], PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error : " . $e->getMessage();
        }
    }
    public function confirmOrder($id)
    {
        try {
            $true = 1;
            $sql = 'UPDATE orders SET is_done = :is_done , date_of_affect = NOW()
            WHERE order_id = :order_id;';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('is_done', $true, PDO::PARAM_INT);
            $stmt->bindParam('order_id', $id, PDO::PARAM_INT);
            $result = $stmt->execute();
            if ($result) {
                $sql = 'SELECT product_id, quantity FROM orders WHERE order_id = :order_id;';
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam('order_id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $result = new Order($stmt->fetch(PDO::FETCH_ASSOC));
                if ($result instanceof Order) {
                    return $result;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        } catch (PDOException $e) {
            return "Error : " . $e->getMessage();
        }
    }
    public function AddQuantity($quentity, $product_id)
    {
        try {
            $sql = 'SELECT quentity FROM stocks
            WHERE product_id = :product_id;';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $quentity += $result['quentity'];
            } else {
                return false;
            }
            $sql = 'UPDATE stocks SET quentity = :quentity
            WHERE product_id = :product_id;';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('quentity', $quentity, PDO::PARAM_INT);
            $stmt->bindParam('product_id', $product_id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error : " . $e->getMessage();
        }
    }
    public function getOrderByid($id)
    {
        try {
            $sql = 'SELECT * FROM orders
            INNER JOIN suppliers ON orders.supplier_id = suppliers.supplier_id
            INNER JOIN products ON orders.product_id = products.product_id
            WHERE order_id = :order_id;';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('order_id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return "Error : " . $e->getMessage();
        }
    }
}
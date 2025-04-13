<?php

namespace App\Core;

use Config\Database;
use PDO;
use Exception;

class Repository
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    protected function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }


    protected function getAll($table, $columns = '*', $where = '', $params = [])
    {
        $sql = "SELECT $columns FROM `$table`";
        if (!empty($where)) {
            $sql .= " WHERE $where";
        }
        // var_dump($sql);
        // var_dump($params);
        // exit;
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function itemExists($value, $table, $column)
    {
        try {
            $query = "SELECT COUNT(*) FROM `$table` WHERE `$column` = :value";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':value', $value);
            $stmt->execute();

            return $stmt->fetchColumn() > 0;
        } catch (Exception $e) {
            throw new Exception('Error :' . $e->getMessage());
        }
    }

    protected function getById($table, $id)
    {
        $sql = "SELECT * FROM `$table`
        WHERE id = :id  LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function deleteById($table, $id_name, $id_value)
    {
        try {
            $sql = "DELETE FROM `$table` WHERE `$id_name` = :id LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id_value);
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception('Error :' . $e->getMessage());
        }
    }

    protected function updateStorePerformanceAfterSale($total, $storeId)
    {
        try {
            $checkSql = "SELECT COUNT(*) FROM store_performance WHERE store_id = :store_id";
            $checkStmt = $this->db->prepare($checkSql);
            $checkStmt->bindParam(':store_id', $storeId);
            $checkStmt->execute();
            $count = $checkStmt->fetchColumn();
    
            if ($count > 0) {
                $updateSql = "UPDATE store_performance 
                              SET chiffre_daffaire = chiffre_daffaire + :new_chiffre_daffaire
                              WHERE store_id = :store_id";
                $stmt = $this->db->prepare($updateSql);
                $stmt->bindParam(':new_chiffre_daffaire', $total);
                $stmt->bindParam(':store_id', $storeId);
            } else {
                $expenses = 0;
                $insertSql = "INSERT INTO store_performance (store_id, chiffre_daffaire, expenses) 
                              VALUES (:store_id, :new_chiffre_daffaire, :expenses)";
                $stmt = $this->db->prepare($insertSql);
                $stmt->bindParam(':store_id', $storeId);
                $stmt->bindParam(':new_chiffre_daffaire', $total);
                $stmt->bindParam(':expenses', $expenses);
            }
    
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception('Error: ' . $e->getMessage());
        }
    }
    protected function updateStorePerformanceAfterBuy($expenses, $storeId)
    {
        try {
            $checkSql = "SELECT COUNT(*) FROM store_performance WHERE store_id = :store_id";
            $checkStmt = $this->db->prepare($checkSql);
            $checkStmt->bindParam(':store_id', $storeId);
            $checkStmt->execute();
            $count = $checkStmt->fetchColumn();
    
            if ($count > 0) {
                $updateSql = "UPDATE store_performance 
                              SET expenses = expenses + :expenses
                              WHERE store_id = :store_id";
                $stmt = $this->db->prepare($updateSql);
                $stmt->bindParam(':expenses', $expenses);
                $stmt->bindParam(':store_id', $storeId);
            } else {
                $chiffre_daffaire = 0;
                $insertSql = "INSERT INTO store_performance (store_id, chiffre_daffaire, expenses) 
                              VALUES (:store_id, :new_chiffre_daffaire, :expenses)";
                $stmt = $this->db->prepare($insertSql);
                $stmt->bindParam(':store_id', $storeId);
                $stmt->bindParam(':new_chiffre_daffaire', $chiffre_daffaire);
                $stmt->bindParam(':expenses', $expenses);
            }
    
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception('Error: ' . $e->getMessage());
        }
    }
    


}
?>
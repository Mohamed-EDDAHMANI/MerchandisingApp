<?php

namespace App\Core;

use Config\Database;
use PDO;
use Exception;

class Repository {
    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    protected function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }


    protected function getAll($table, $columns = '*', $where = '', $params = []) {
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

    public function itemExists($value , $table , $column)
    {
        try {
            $query = "SELECT COUNT(*) FROM `$table` WHERE `$column` = :value";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':value', $value);
            $stmt->execute();

            return $stmt->fetchColumn() > 0;
        }catch (Exception $e) {
            throw new Exception('Error :'. $e->getMessage());
        }
    }

    protected function getById($table, $id ) {
        $sql = "SELECT * FROM `$table`
        WHERE id = :id  LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function deleteById($table, $id ) {
        $sql = "DELETE FROM `$table` WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
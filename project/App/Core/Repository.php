<?php

namespace App\Core;

use Config\Database;
use PDO;

class Repository {
    protected $db;

    public function __construct() {
        // $db = new Database();
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
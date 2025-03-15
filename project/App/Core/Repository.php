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

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
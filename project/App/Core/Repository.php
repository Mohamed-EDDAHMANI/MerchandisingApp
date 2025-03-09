<?php

namespace App\Core;

use Config\Database;

class Repository {
    protected $conn;

    public function __construct() {
        // $db = new Database();
        $this->conn = Database::getConnection();
    }

    protected function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
?>
<?php

namespace App\Repositories;

use PDO;
use Config\Database;
use App\Core\Repository;
use App\Models\User;
use App\Models\Manager;
use App\Models\Employee;
use Exception;


class adminRepository extends Repository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function createUser($date)
    {
        // var_dump($date);
        // die();
        try {
            if ($this->emailExists($date['email'])) {
                return false;
            }
            $passwordHashed = password_hash($date['password'], PASSWORD_BCRYPT);
            $roleId = $this->getRoleId($date['role']);
            $sql = "INSERT INTO users (first_name, last_name, email, password, role_id) VALUES (:first_name, :last_name, :email, :password, :role_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':first_name', $date['firstName']);
            $stmt->bindParam(':last_name', $date['lastName']);
            $stmt->bindParam(':email', $date['email']);
            $stmt->bindParam(':password', $passwordHashed);
            $stmt->bindParam(':role_id', $roleId['id']);
            if ($stmt->execute()) {
                $userId = $this->db->lastInsertId();
                $result = $this->insertUserTable($date, $userId);
                if ($result) {
                    return $result;
                }
            }
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la création de l'utilisateur : " . $e->getMessage());
        }
    }

    public function getRoleId($role)
    {
        $sql = "SELECT id FROM roles WHERE role = :role";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['role' => $role]);
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        return $role;
    }

    public function emailExists($email)
    {
        $query = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    public function insertUserTable($date, $userId)
    {
        $table = $date['role'] . 's';
        $is_valid = isset($date['is_valid']) ? '1' : '0';

        $sql = "INSERT INTO $table (is_valid, salary, user_id) VALUES (:is_valid, :salary, :user_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':is_valid', $is_valid);
        $stmt->bindParam(':salary', $date['salary']);
        $stmt->bindParam(':user_id', $userId);
        if ($stmt->execute()) {
            return true;
        }
    }

    public function getAllUsers()
    {
        $sql = 'SELECT
        users.id AS user_id,
        users.email,
        users.first_name,
        users.last_name,
        roles.role AS role_name,
        stores.name AS store_name,
        managers.is_valid AS manager_valid,
        managers.salary AS manager_salary,
        employees.id AS employee_id,
        employees.is_valid AS employee_valid,
        employees.salary AS employee_salary,
        employees.performance AS employee_performance
        FROM users
        LEFT JOIN roles ON users.role_id = roles.id
        LEFT JOIN stores ON users.store_id = stores.id
        LEFT JOIN managers ON users.id = managers.user_id
        LEFT JOIN employees ON users.id = employees.user_id
        WHERE roles.role != "admin";';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllStores()
    {
        $sql = 'SELECT * FROM stores;';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sortUsers($role = null, $store = null, $is_valid = null)
{
    // Base SQL query
    $sql = "
        SELECT 
            users.id AS user_id,
            users.email,
            users.first_name,
            users.last_name,
            roles.role AS role_name,
            stores.name AS store_name,
            managers.is_valid AS manager_valid,
            managers.salary AS manager_salary,
            employees.id AS employee_id,
            employees.is_valid AS employee_valid,
            employees.salary AS employee_salary,
            employees.performance AS employee_performance
        FROM users
        LEFT JOIN roles ON users.role_id = roles.id
        LEFT JOIN stores ON users.store_id = stores.id
        LEFT JOIN managers ON users.id = managers.user_id
        LEFT JOIN employees ON users.id = employees.user_id
        WHERE roles.role != 'admin'
    ";

    // Conditions array to store WHERE clauses
    $conditions = [];
    $params = [];

    // Add role filter if it exists
    if ($role) {
        $conditions[] = "roles.role = :role";
        $params[':role'] = $role;
    }

    // Add store filter if it exists
    if ($store) {
        $conditions[] = "stores.name = :store";
        $params[':store'] = $store;
    }

    // Add is_valid filter if it exists (for both managers and employees)
    if ($is_valid !== null) {
        $conditions[] = "(managers.is_valid = :is_valid OR employees.is_valid = :is_valid)";
        $params[':is_valid'] = $is_valid;
    }

    // If there are any conditions, append them to the query
    if (count($conditions) > 0) {
        $sql .= " AND " . implode(" AND ", $conditions);
    }

    // Prepare and execute the query
    try {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        // Fetch the results
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the users as an array
        return $users;
    } catch (PDOException $e) {
        // Handle any errors
        return ["error" => "Error fetching users: " . $e->getMessage()];
    }
}

}



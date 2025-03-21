<?php

namespace App\Repositories;

use PDO;
use Config\Database;
use App\Core\Repository;
use App\Models\User;
use App\Models\Manager;
use App\Models\Employee;
use App\Utils\Mappers\dataMapper;
use Exception;
use PDOException;


class AdminRepository extends Repository
{
    public function createUser($data)
    {
        try {
            if ($this->emailExists($data['email'])) {
                return false;
            }
            $passwordHashed = password_hash($data['password'], PASSWORD_BCRYPT);
            $roleId = $this->getRoleId($data['role']);
            $sql = "INSERT INTO users (first_name, last_name, email, password, role_id) VALUES (:first_name, :last_name, :email, :password, :role_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':first_name', $data['firstName']);
            $stmt->bindParam(':last_name', $data['lastName']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':password', $passwordHashed);
            $stmt->bindParam(':role_id', $roleId['role_id']);
            if ($stmt->execute()) {
                $userId = $this->db->lastInsertId();
                $result = $this->insertUserTable($data, $userId);
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
        $sql = "SELECT role_id FROM roles WHERE role_name = :role_name";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['role_name' => $role]);
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
        users.id,
        users.email,
        users.first_name,
        users.last_name,
        users.role_id,
        roles.role_name,
        stores.name AS store_name,
        managers.is_valid AS manager_valid,
        managers.salary AS manager_salary,
        managers.manager_id,
        employees.employee_id,
        employees.is_valid AS employee_valid,
        employees.salary AS employee_salary,
        employees.performance AS employee_performance
        FROM users
        LEFT JOIN roles ON users.role_id = roles.role_id
        LEFT JOIN stores ON users.store_id = stores.store_id
        LEFT JOIN managers ON users.id = managers.user_id
        LEFT JOIN employees ON users.id = employees.user_id
        WHERE roles.role_name != "admin";';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $usersInstences = DataMapper::UserMapper($users);
        return $usersInstences;

    }
    public function getAllStores()
    {
        try {
            $stores = $this->getAll('stores');
            $storsInstences = DataMapper::StoreMapper($stores);
            return $storsInstences;
        } catch (PDOException $e) {
            return "Error :" . $e->getMessage();
        }
    }

    public function sortUsers($role = null, $store = null, $is_valid = null)
    {
        // Base SQL query
        $sql = "SELECT 
            users.id,
            users.email,
            users.first_name,
            users.last_name,
            roles.role_name,
            stores.name AS store_name,
            managers.is_valid AS manager_valid,
            managers.salary AS manager_salary,
            managers.manager_id,
            employees.employee_id,
            employees.is_valid AS employee_valid,
            employees.salary AS employee_salary,
            employees.performance AS employee_performance
        FROM users
        LEFT JOIN roles ON users.role_id = roles.role_id
        LEFT JOIN stores ON users.store_id = stores.store_id
        LEFT JOIN managers ON users.id = managers.user_id
        LEFT JOIN employees ON users.id = employees.user_id
        WHERE roles.role_name != 'admin'
    ";

        if ($is_valid == 'true') {
            $if_exist = true;
            $is_valid = 1;
        } elseif ($is_valid == 'false' && $is_valid !== null) {
            $if_exist = true;
            $is_valid = 0;
        } else {
            $if_exist = false;
        }

        $conditions = [];
        $params = [];

        if ($role) {
            $conditions[] = "roles.role_name = :role";
            $params[':role'] = $role;
        }

        if ($store) {
            $conditions[] = "stores.store_name = :store";
            $params[':store'] = $store;
        }

        if ($if_exist) {
            $conditions[] = "(managers.is_valid = :is_valid OR employees.is_valid = :is_valid)";
            $params[':is_valid'] = $is_valid;
        }

        if (count($conditions) > 0) {
            $sql .= " AND " . implode(" AND ", $conditions);
        }

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            // Fetch the results
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } catch (PDOException $e) {
            // Handle any errors
            return ["error" => "Error fetching users: " . $e->getMessage()];
        }
    }

    public function getUserById($id)
    {
        $sql = 'SELECT
        users.id AS user_id,
        users.email,
        users.password,
        users.first_name,
        users.last_name,
        roles.role_name,
        stores.name AS store_name,
        managers.is_valid AS manager_valid,
        managers.salary AS manager_salary,
        employees.employee_id,
        employees.is_valid AS employee_valid,
        employees.salary AS employee_salary,
        employees.performance AS employee_performance
    FROM users
    LEFT JOIN roles ON users.role_id = roles.role_id
    LEFT JOIN stores ON users.store_id = stores.store_id
    LEFT JOIN managers ON users.id = managers.user_id
    LEFT JOIN employees ON users.id = employees.user_id
    WHERE users.id = :id
    LIMIT 1;';

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        $userData = [
            'id' => $user['user_id'],
            'email' => $user['email'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'role_name' => $user['role_name'],
            'store_name' => $user['store_name'] ?? 'Not assigned',
            'salary' => ($user['role_name'] === 'manager') ? $user['manager_salary'] : $user['employee_salary'],
            'is_valid' => ($user['role_name'] === 'manager') ? $user['manager_valid'] : $user['employee_valid']
        ];

        return $userData;
    }

    public function updateUser($data, $id)
    {
        try {
            $this->db->beginTransaction();

            $roleId = $this->getRoleId($data['role']);
            if (!$roleId) {
                throw new Exception("Invalid role provided.");
            }


            $sql = "UPDATE users 
                SET first_name = :first_name, 
                    last_name = :last_name, 
                    email = :email,
                    store_id = :store_id
                WHERE id = :id";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':first_name', $data['firstName']);
            $stmt->bindParam(':last_name', $data['lastName']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':store_id', $data['store_id']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if (!empty($data['password'])) {
                $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
                $sql = "UPDATE users SET password = :password WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
            }

            $role = $data['role'];
            $table = $role . 's';

            $sql = "UPDATE $table SET is_valid = :is_valid,salary = :salary 
                    WHERE user_id = :id";

            $stmt = $this->db->prepare($sql);
            $is_valid = isset($data['is_valid']) ? 1 : 0;
            $stmt->bindParam(':is_valid', $is_valid, PDO::PARAM_INT);
            $stmt->bindParam(':salary', $data['salary']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Error :" . $e->getMessage();
        }

    }
    public function toggleUserStatus($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM managers WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $manager = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($manager) {
                $newStatus = $manager['is_valid'] == 1 ? 0 : 1;
                $updateStmt = $this->db->prepare("UPDATE managers SET is_valid = :is_valid WHERE user_id = :user_id");
                $updateStmt->bindParam(':is_valid', $newStatus, PDO::PARAM_INT);
                $updateStmt->bindParam(':user_id', $id, PDO::PARAM_INT);
                $updateStmt->execute();
            } else {
                $stmt = $this->db->prepare("SELECT * FROM employees WHERE user_id = :user_id");
                $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $employee = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($employee) {
                    $newStatus = $employee['is_valid'] == 1 ? 0 : 1;
                    $updateStmt = $this->db->prepare("UPDATE employees SET is_valid = :is_valid WHERE user_id = :user_id");
                    $updateStmt->bindParam(':is_valid', $newStatus, PDO::PARAM_INT);
                    $updateStmt->bindParam(':user_id', $id, PDO::PARAM_INT);
                    $updateStmt->execute();
                } else {
                    throw new Exception("User not found.");
                }
            }
        } catch (Exception $e) {
            echo "Error :" . $e->getMessage();
        }
    }

}



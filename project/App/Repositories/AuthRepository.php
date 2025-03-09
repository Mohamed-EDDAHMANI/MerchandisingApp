<?php

namespace App\Repositories;

use PDO;
use Config\Database;
use App\Core\Repository;
use App\Models\User;
use App\Models\Manager;
use App\Models\Employee;


class AuthRepository extends Repository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            $user = new User($user);
            if (password_verify($password, $user->getPassword())) {
                $table = $this->getUserRole($user->getRoleId());
                if ($table == 'admin') {
                    return $user;
                }
                $data = $this->getUserData($table, $user->getId());
                return [$user, $data, $table];
            } else {
                return "Invalid password";
            }
        } else {
            return "User not found";
        }
    }

    public function getUserRole($id)
    {
        $sql = "SELECT role FROM roles WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        return $role;
    }

    public function getUserData($table, $id)
    {
        $class = ucfirst($table);
        $sql = "SELECT * FROM $table.s WHERE user_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $data = new $class($data);
        return $data;
    }

    public function logout()
    {
        session_destroy();
    }

    public function signup($data)
    {
        $sql = "INSERT INTO users (name, email, password, role_id) VALUES (:name, :email, :password, :role_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
    }
}




// class Session {
//     public function __construct() {
//         if (session_status() == PHP_SESSION_NONE) {
//             session_start();
//         }
//     }

//     public function set($key, $value) {
//         $_SESSION[$key] = $value;
//     }

//     public function get($key) {
//         return $_SESSION[$key] ?? null;
//     }

//     public function destroy() {
//         session_destroy();
//     }

//     public function has($key) {
//         return isset($_SESSION[$key]);
//     }
// }
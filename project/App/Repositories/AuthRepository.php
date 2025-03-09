<?php

namespace App\Repositories;

use PDO;
use Config\Database;
use App\Core\Repository;


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
        $stmt->execute(['email' => $email, 'password' => $password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_instance = new User($user['id'], $user['name'], $user['email'], $user['role_id']);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $table = $this->getUserRole($user['role_id']);
                $data = $this->getUserData($table, $user['id']);
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
        $sql = "SELECT * FROM $table.s WHERE user_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
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
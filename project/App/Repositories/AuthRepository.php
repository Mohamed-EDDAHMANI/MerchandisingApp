<?php

namespace App\Repositories;

use PDO;
use Config\Database;
use App\Core\Repository;
use App\Models\User;
use App\Models\Manager;
use App\Models\Employee;
use App\Utils\Mappers\dataMapper;


class AuthRepository extends Repository
{

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            if (password_verify($password, $user['password'])) {
                $usersInstences = DataMapper::adminMapper($user);
                $table = $this->getUserRole($usersInstences->getRoleId());
                if ($table->getRole() == 'admin') {
                    return $usersInstences;
                }
                $dataInstencs = $this->getUserData($table->getRole(), $usersInstences->getId());
                return [$usersInstences, $dataInstencs, $table->getRole()];
            } else {
                return "Invalid password";
            }
        } else {
            return "User not found";
        }
    }

    public function getUserRole($id)
    {
        $sql = "SELECT * FROM roles WHERE role_id = :role_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['role_id' => $id]);
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        $roleInstences = DataMapper::roleMapper($role);
        return $roleInstences;
    }

    public function getStoreName($user){
        $id = $user->getId();
        $sql = "SELECT stores.store_name FROM stores
        INNER JOIN users ON users.store_id = stores.store_id
        WHERE users.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchColumn();
    }

    public function getUserData($table, $id)
    {
        $class = ucfirst($table);
        $table = $table . 's';
        $sql = "SELECT * FROM $table WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $class = "App\\Models\\" . $class;
        $data = new $class($data);
        return $data;
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



// <?php

// namespace Core\Validation;


// class Validator
// {

//   private $data;
//   private $errors = [];


//   public function __construct($data)
//   {
//     $this->data = $data;
//     $this->validate();
//   }


//   public function validate()
//   {
//     foreach (Rules::$rules as $field  => $rules) {
//       // dump($field);

//       $rules = explode('|', $rules);


//       foreach ($rules as $rule) {
//         $this->applyRules($rule, $field);
//       }
//     }
//   }



//   public function applyRules($rule, $field)
//   {
//     $value = trim($this->data[$field] ?? '');


//     if ($rule == 'required' && empty($value)) {

//       $this->addError($field, $rule);
//     }


//     if (explode(':', $rule)[0] == 'min') {

//       $min = explode(':', $rule)[1];


//       if (strlen($value) < $min) {
//         $this->addError($field, explode(':', $rule)[0], $value);
//       }
//     }


//     if (explode(':', $rule)[0] == 'max') {

//       $max = explode(':', $rule)[1];

//       if (strlen($value) > $max) {

//         $this->addError($field, explode(':', $rule)[0], $value);
//       }
//     }

//     if ($rule === 'email' && !empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
//       $this->addError($field, $rule);
//     }


//   }
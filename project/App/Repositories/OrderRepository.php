<?php 


namespace App\Repositories;

use PDO;
use App\Core\Repository;
use App\Utils\Mappers\dataMapper;
use PDOException;

class OrderRepository extends Repository{

    public function createOrder($data, $manager_id){
        try {
            $sql = 'INSERT INTO orders (supplier_id, manager_id, product_id, quantity) VALUES (:supplier_id, :manager_id, :product_id, :quantity);';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('supplier_id', $data['orderSupplier'], PDO::PARAM_INT);
            $stmt->bindParam('manager_id', $manager_id, PDO::PARAM_INT);
            $stmt->bindParam('product_id', $data['product_id'], PDO::PARAM_INT);
            $stmt->bindParam('quantity', $data['orderQuantity'], PDO::PARAM_INT);
            // echo '<pre>';
            // var_dump('supplier_id',$data['orderSupplier']);
            // var_dump('product_id',$data['product_id']);
            // var_dump('quantity',$data['orderQuantity']);
            // var_dump('manager_id',$manager_id);
            // echo '</pre>';
            // var_dump($stmt->execute());
            // exit;
            return $stmt->execute();

        } catch (PDOException $e) {
            return "Error : " . $e->getMessage();
        }
    }
}
<?php

namespace App\Repositories;

use PDO;
use Config\Database;
use App\Core\Repository;
use App\Models\User;
use App\Models\Manager;
use App\Models\Employee;
use App\Utils\Mappers\dataMapper;
use PDOException;


class RepportRepository extends Repository
{
    public function getMerchangisingRapports($id = null)
    {

        $sql = "SELECT * FROM merchandising_data
        INNER JOIN stores ON stores.store_id = merchandising_data.store_id";
        if ($id != null) {
            $sql .= " WHERE id = :id";
        }

        $stmt = $this->db->prepare($sql);
        if ($id != null) {
            $stmt->execute(["id" => $id]);
        } else {
            $stmt->execute();
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return DataMapper::MerchandisingDataMapper($data);
    }

    public function getEmployeeRapports()
    {
        $sql = "SELECT * FROM reports
        INNER JOIN users ON users.id = reports.user_id";
         $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return DataMapper::RepportMapper($data);
    }
    public function deleteRepport($id)
    {
        return $this->deleteById('merchandising_data', $id);
    }
    public function deleteUserRepport($id)
    {
        $sql = "DELETE FROM reports WHERE report_id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getRepportsById($id)
    {
        $sql = "SELECT * FROM reports
        INNER JOIN users ON users.id = reports.user_id
        WHERE reports.report_id = :id
        LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id"=> $id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
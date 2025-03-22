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
    public function getMerchangisingRapports(){

        $sql = "SELECT * FROM merchandising_data
        INNER JOIN stores ON stores.store_id = merchandising_data.store_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return DataMapper::MerchandisingDataMapper($data);
    }

    public function getEmployeeRapports(){
        $data = $this->getAll('reports');
        return DataMapper::DataMapper($data, "Report");
    }
}
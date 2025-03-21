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
        return $this->getAll('merchandising_data');
    }

    public function getEmployeeRapports(){
        return $this->getAll('reports');
    }
}
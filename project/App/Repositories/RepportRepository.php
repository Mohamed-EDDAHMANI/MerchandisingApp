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
        $data = $this->getAll('merchandising_data');
        $usersInstences = DataMapper::UserMapper($users);
    }

    public function getEmployeeRapports(){
        $data = $this->getAll('reports');
        $usersInstences = DataMapper::UserMapper($users);
    }
}
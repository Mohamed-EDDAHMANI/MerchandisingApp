<?php

namespace App\Repositories;

use LDAP\Result;
use PDO;
use App\Core\Repository;
use App\Utils\Mappers\dataMapper;
use Exception;

class ObjectifRepository extends Repository
{
    public function createObjectif($data,$managerId, $dateExperation): bool
    {
        $sql = "INSERT INTO objectifs (manager_id, target, frequency, type, expiration_date) VALUES (:manager_id, :target, :frequency, :type, :expiration_date)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':manager_id', $managerId, PDO::PARAM_INT);
        $stmt->bindValue(':target', $data['target'], PDO::PARAM_INT);
        $stmt->bindValue(':frequency', $data['frequency'], PDO::PARAM_STR);
        $stmt->bindValue(':type', $data['type'], PDO::PARAM_STR);
        $stmt->bindValue(':expiration_date', $dateExperation, PDO::PARAM_STR);
        return $stmt->execute();
    }
    public function deleteObjectifs($id): bool
    {
        $sql = "DELETE FROM objectifs WHERE objectif_id = :objectif_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':objectif_id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
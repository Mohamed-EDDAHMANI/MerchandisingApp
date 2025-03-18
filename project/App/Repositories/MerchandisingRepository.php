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


class MerchandisingRepository extends Repository
{

    public function analysePotentiel($data)
    {
        try {
            $query = "INSERT INTO merchandising_data ( store_id, zone_population, avg_household_size, nombre_menages, avg_annual_spending, regional_wealth_index, invasion, evasion, CA_potentiel_zone, competitor_revenue, CA_potentiel_store, result_frot, analysis_date)
             VALUES 
             ( :store_id, :zone_population, :avg_household_size, :nombre_menages, :avg_annual_spending, :regional_wealth_index, :invasion, :evasion, :CA_potentiel_zone, :competitor_revenue, :CA_potentiel_store, :result_frot, CURRENT_DATE)";
            
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':store_id', $data['store_id'], PDO::PARAM_INT);
            $stmt->bindParam(':zone_population', $data['zone_population'], PDO::PARAM_INT);
            $stmt->bindParam(':avg_household_size', $data['avg_household_size'], PDO::PARAM_STR);
            $stmt->bindParam(':nombre_menages', $data['nombre_menages'], PDO::PARAM_STR);
            $stmt->bindParam(':avg_annual_spending', $data['avg_annual_spending'], PDO::PARAM_STR);
            $stmt->bindParam(':regional_wealth_index', $data['regional_wealth_index'], PDO::PARAM_STR);
            $stmt->bindParam(':invasion', $data['invasion'], PDO::PARAM_STR);
            $stmt->bindParam(':evasion', $data['evasion'], PDO::PARAM_STR);
            $stmt->bindParam(':CA_potentiel_zone', $data['CA_potentiel_zone'], PDO::PARAM_STR);
            $stmt->bindParam(':competitor_revenue', $data['competitor_revenue'], PDO::PARAM_STR);
            $stmt->bindParam(':CA_potentiel_store', $data['CA_potentiel_store'], PDO::PARAM_STR);
            $stmt->bindParam(':result_frot', $data['result_frot'], PDO::PARAM_STR);
    
            $stmt->execute();
            return $this->updateStoreStatus($data['store_id'],$data['result_frot']);
        } catch (PDOException  $e) {
            echo json_encode(["error" => "Database error: " . $e->getMessage()]);
        }
    }

    public function updateStoreStatus($storeId, $result){
        try {
            $status = $result < 30 ? 'inactive' : 'active';
            $sql = 'UPDATE stores SET status = :status
                    WHERE store_id = :store_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam('status', $status, PDO::PARAM_STR);
            $stmt->bindParam('store_id', $storeId, PDO::PARAM_INT);
            $stmt->execute();
            return $status;
        } catch (PDOException $e) {
            echo json_encode(['error'=> $e->getMessage()]);
        }
    }
}
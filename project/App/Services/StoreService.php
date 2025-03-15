<?php

namespace App\Services;

use App\Repositories\storeRepository;
use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;

class StoreService
{

    private $storeRepository;
    private $session;

    public function __construct()
    {
        $this->storeRepository = new StoreRepository();
        $this->session = new Session();
    }

    public function createPointDeVente($data)
    {
        $result = $this->storeRepository->createPointDeVente($data);

        if ($result) {
            $this->session->setError('success', 'Store created successfully');
        } else {
            $this->session->setError('error', 'Error creating store');
        }
        Redirect::to('/admin/points-de-vente'); 
    }

    public function getPointsDeVente()
    {
        $stores = $this->storeRepository->getPointsDeVente();
        return  ['stores' => $stores];
        // return ['users' => $users, 'stores' => $stors];
        // $stors = $this->adminRepository->getAllStores();
    }

    public function getPointsDeVenteById($id)
    {
        $store = $this->storeRepository->getPointsDeVenteById($id); 
        echo json_encode($store);
        exit;
    }

    public function updatePointDeVente($data, $id)
    {
        $result = $this->storeRepository->updatePointDeVente($data, $id); 
        if ($result) {
            $this->session->setError('success', 'Store Updated successfully');
        } else {
            $this->session->setError('error', 'Error Updating store');
        }
        Redirect::to('/admin/points-de-vente'); 
    }

    public function deletePointDeVente($id)
    {
        $result = $this->storeRepository->deletePointDeVente($id); 
        if ($result) {
            $this->session->setError('success', 'Store Deleted successfully');
        } else {
            $this->session->setError('error', 'Error Deleting store');
        }
        Redirect::to('/admin/points-de-vente'); 
    }

}


?>
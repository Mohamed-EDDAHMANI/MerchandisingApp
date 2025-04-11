<?php 

namespace App\Services;

use App\Repositories\ObjectifRepository;
use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;

class ObjectifService{

    private $objectifRepository;
    private $session;

    public function __construct(){
        $this->objectifRepository = new ObjectifRepository();
        $this->session = new Session();
    }

    public function createObjectif($data){
        $managerId = $this->session->get('data')->getId();
        if($data['frequency'] === 'daily'){
            $dateExperation = date('Y-m-d H:i:s', strtotime('+1 day'));
        }else {
            $dateExperation = date('Y-m-d H:i:s', strtotime('+1 week'));
        }
        return $this->objectifRepository->createObjectif($data , $managerId, $dateExperation);
    }
    public function deleteObjectifs($id){
        return $this->objectifRepository->deleteObjectifs($id);
    }
}
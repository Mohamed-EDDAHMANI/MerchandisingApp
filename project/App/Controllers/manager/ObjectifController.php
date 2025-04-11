<?php 

namespace App\Controllers\manager;

use App\Services\ObjectifService;
use App\Controllers\BaseController;
use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;

class ObjectifController extends BaseController {

    private $objectifService ;
    private $session ;
    public function __construct(){
        $this->objectifService = new ObjectifService();
        $this->session = new Session();
    }

    public function store(){
        $res = $this->objectifService->createObjectif($_POST);
        if($res === true){
            $this->session->setError('success', 'Objectif Created successfully');
        }else {
            $this->session->setError('error', 'Error Creating Objectif !!');
        }
        Redirect::to('/manager/dashboard#objectives');
    }
    public function deleteObjectifs($id){
        $res = $this->objectifService->deleteObjectifs($id);
        if($res === true){
            $this->session->setError('success', 'Objectif Deleted successfully');
        }else {
            $this->session->setError('error', 'Error Deleting Objectif !!');
        }
        Redirect::to('/manager/dashboard#objectives');
    }
}
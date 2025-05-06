<?php 

namespace App\Controllers\Admin;

use App\Services\RepportService;
use App\Controllers\BaseController;
use App\Utils\Sessions\Session;


class RepportController extends BaseController{
    private $repportService;
    private $session;

    public function __construct() {
        $this->repportService = new RepportService;
        $this->session = new Session();
    }

    public function getRepports() {
        $data = $this->repportService->getRepports();
        $user = $this->session->get('user');
        $data['user'] = $user;
        $this->view('admin/repport',   $data);
    }

    public function getRepportsById($id) {
        $data = $this->repportService->getRepportsById($id);
        echo json_encode($data);
    }
    public function exportPDF($id) {
        $this->repportService->exportPDF($id);
    }
    public function deleteRepport($id) {
        $this->repportService->deleteRepport($id);
    }
    public function deleteUserRepport($id) {
        $this->repportService->deleteUserRepport($id);
    }

}

?>
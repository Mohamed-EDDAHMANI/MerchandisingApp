<?php 

namespace App\Controllers;

use App\Services\RepportService;


class RepportController extends BaseController{
    private $repportService;

    public function __construct() {
        $this->repportService = new RepportService;
    }

    public function getRepports() {
        $data = $this->repportService->getRepports();
        $this->view('admin/repport', $data);
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
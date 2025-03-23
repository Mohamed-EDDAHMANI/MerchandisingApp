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
    public function exportPDF($id) {
        $this->repportService->exportPDF($id);
    }
    public function deleteRepport($id) {
        $this->repportService->deleteRepport($id);
    }

}

?>
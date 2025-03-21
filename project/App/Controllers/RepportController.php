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

}

?>
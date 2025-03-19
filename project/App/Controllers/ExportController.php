<?php

namespace App\Controllers;

class ExportController extends BaseController {
    private $exportService;

    public function __construct() {
        // $this->exportService = new ExportService();
    }

    public function getRapports() {
        $this->view('admin/repport');
    }

    public function exportPDF() {
        // $data = $this->reportRepository->getReportData();
        // Logic to generate PDF
        require 'views/exports/pdf.php';
    }

    public function exportExcel() {
        // $data = $this->reportRepository->getReportData();
        // Logic to generate Excel
        require 'views/exports/excel.php';
    }
}

?>
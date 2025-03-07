<?php

class ExportController {
    private $reportRepository;

    public function __construct(ReportRepository $reportRepository) {
        $this->reportRepository = $reportRepository;
    }

    public function exportPDF() {
        $data = $this->reportRepository->getReportData();
        // Logic to generate PDF
        require 'views/exports/pdf.php';
    }

    public function exportExcel() {
        $data = $this->reportRepository->getReportData();
        // Logic to generate Excel
        require 'views/exports/excel.php';
    }
}

?>
<?php 


class DashboardController {
    private $dashboardService;

    public function __construct(DashboardService $dashboardService) {
        $this->dashboardService = $dashboardService;
    }

    public function index() {
        $data = $this->dashboardService->getDashboardData();
        require 'views/dashboard/index.php';
    }

    public function getRapports() {
        $rapports = $this->dashboardService->generateRapports();
        require 'views/dashboard/rapports.php';
    }

    public function comparaisonVilles() {
        $comparisonData = $this->dashboardService->compareCities();
        require 'views/dashboard/comparaison.php';
    }
}

?>
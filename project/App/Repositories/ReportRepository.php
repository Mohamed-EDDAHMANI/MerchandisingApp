<?php
class ReportRepository extends Repository {
    public function getReportData() {
        $stmt = $this->db->query("SELECT * FROM rapports");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function exportPDF() {
        $data = $this->getReportData();
        // Logique pour générer un PDF
    }

    public function exportExcel() {
        $data = $this->getReportData();
        // Logique pour générer un fichier Excel
    }
}
?>
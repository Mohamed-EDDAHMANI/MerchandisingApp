<?php

namespace App\Services;
require_once __DIR__ . '/../../vendor/autoload.php'; // Fixed path concatenation

use Dompdf\Dompdf;
use Dompdf\Options;

use App\Utils\Sessions\Session;
use App\Utils\Redirects\Redirect;
use App\Repositories\RepportRepository;

class RepportService
{

    private $repportRepository;
    private $session;

    public function __construct()
    {
        $this->repportRepository = new RepportRepository();
        $this->session = new Session();
    }

    public function getRepports()
    {
        $merchangisingRapports = $this->repportRepository->getMerchangisingRapports();
        $employeeRapports = $this->repportRepository->getEmployeeRapports();
        // var_dump($employeeRapports[0]->getReportType());
        // exit;
        return ['merchandising' => $merchangisingRapports, 'employee' => $employeeRapports];
    }

    public function exportPDF($id)
    {
        $merchangisingRapports = $this->repportRepository->getMerchangisingRapports($id);
        $this->generateMerchandisingPDF($merchangisingRapports[0]);
    }
    public function deleteRepport($id)
    {
        $result = $this->repportRepository->deleteRepport($id);
        if ($result) {
            $this->session->setError('success', 'Report deleted successfully');
        } else {
            $this->session->setError('error', 'Error Deleting');
        }
        Redirect::to('/admine/rapports');//i want redirect to this rout 
    }

    public function generateMerchandisingPDF($merchangisingRapports)
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->setPaper('A4', 'portrait');

        $html = $this->createHtmlContent($merchangisingRapports);

        $dompdf->loadHtml($html);

        $dompdf->render();

        return $dompdf->stream("rapport_merchandising_magasin_" . $merchangisingRapports->getId() . ".pdf", array("Attachment" => false));
    }

    private function createHtmlContent($merchangisingRapports)
    {
        $potentialCapturePercentage = 0;
        if ($merchangisingRapports->getCaPotentielZone() > 0) {
            $potentialCapturePercentage = ($merchangisingRapports->getCaPotentielStore() / $merchangisingRapports->getCaPotentielZone()) * 100;
        }

        $reportDate = date('d/m/Y', strtotime($merchangisingRapports->getAnalysisDate()));

        $html = '
        <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport de données merchandising - ' . htmlspecialchars($merchangisingRapports->getStoreName()) . '</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f8fbff; /* Fond légèrement bleuté */
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #2c5282; /* Bleu foncé remplaçant le vert */
            padding-bottom: 10px;
            background: linear-gradient(to right, #eef5ff, #d6e4ff); /* Dégradé bleu clair */
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }
        .report-title {
            font-size: 24px;
            color: #2c5282; /* Bleu foncé remplaçant le vert */
            margin-bottom: 5px;
        }
        .store-name {
            font-size: 20px;
            font-weight: bold;
            color: #1a365d; /* Bleu très foncé */
        }
        .date {
            font-size: 14px;
            color: #4a5568; /* Gris bleuté */
        }
        .section {
            margin-bottom: 25px;
            border: 1px solid #cbd5e0; /* Bordure gris-bleu clair */
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(44, 82, 130, 0.1); /* Ombre bleue légère */
        }
        .section-title {
            background-color: #3182ce; /* Bleu moyen */
            color: white;
            padding: 10px 15px;
            font-weight: bold;
            font-size: 16px;
        }
        .data-grid {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }
        .data-grid th {
            background-color: #ebf4ff; /* Fond bleu très clair */
            text-align: left;
            padding: 10px;
            font-weight: bold;
            border: 1px solid #bee3f8; /* Bordure bleu clair */
            color: #2b6cb0; /* Texte bleu moyen */
        }
        .data-grid td {
            padding: 10px;
            border: 1px solid #bee3f8; /* Bordure bleu clair */
        }
        .highlight {
            background-color: #e6f0ff; /* Fond bleu clair pour les lignes importantes */
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #4a5568; /* Gris bleuté */
            border-top: 1px solid #bee3f8; /* Bordure bleu clair */
            padding-top: 15px;
        }
        .chart-placeholder {
            width: 100%;
            height: 200px;
            background-color: #ebf8ff; /* Fond bleu très clair */
            border: 1px solid #90cdf4; /* Bordure bleu clair */
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 15px 0;
            color: #2b6cb0; /* Texte bleu */
        }
        .blue-banner {
            height: 8px;
            background: linear-gradient(to right, #2c5282, #3182ce, #63b3ed);
            margin-bottom: 20px;
            border-radius: 4px;
        }
        /* Couleur pour les valeurs numériques importantes */
        .key-value {
            color: #2b6cb0;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="blue-banner"></div>
    
    <div class="header">
        <div class="report-title">Rapport de Données Merchandising</div>
        <div class="store-name">' . htmlspecialchars($merchangisingRapports->getStoreName()) . '</div>
        <div class="date">Date d\'analyse: ' . $reportDate . '</div>
    </div>
    
    <div class="section">
        <div class="section-title">Informations de Zone</div>
        <table class="data-grid">
            <tr>
                <th>Population de la zone</th>
                <td class="key-value">' . number_format($merchangisingRapports->getZonePopulation(), 0, ',', ' ') . '</td>
                <th>Taille moyenne des ménages</th>
                <td class="key-value">' . number_format($merchangisingRapports->getAvgHouseholdSize(), 1, ',', ' ') . '</td>
            </tr>
            <tr>
                <th>Nombre de ménages</th>
                <td class="key-value">' . number_format($merchangisingRapports->getNombreMenages(), 0, ',', ' ') . '</td>
                <th>Indice de richesse régional</th>
                <td class="key-value">' . number_format($merchangisingRapports->getRegionalWealthIndex(), 2, ',', ' ') . '</td>
            </tr>
            <tr>
                <th>Dépense annuelle moyenne par ménage</th>
                <td class="key-value" colspan="3">' . $merchangisingRapports->getAvgAnnualSpending() . '</td>
            </tr>
        </table>
    </div>
    
    <div class="section">
        <div class="section-title">Analyse du Chiffre d\'Affaires et de la Concurrence</div>
        <table class="data-grid">
            <tr>
                <th>CA potentiel de la zone</th>
                <td class="key-value">' . $merchangisingRapports->getCaPotentielZone() . '</td>
            </tr>
            <tr>
                <th>Invasion (dépenses des non-résidents dans la zone)</th>
                <td class="key-value">' . $merchangisingRapports->getInvasion() . ' %</td>
            </tr>
            <tr>
                <th>Évasion (dépenses des résidents hors de la zone)</th>
                <td class="key-value">' . $merchangisingRapports->getEvasion() . ' %</td>
            </tr>
            <tr>
                <th>Chiffre d\'affaires des concurrents</th>
                <td class="key-value">' . $merchangisingRapports->getCompetitorRevenue() . '</td>
            </tr>
            <tr class="highlight">
                <th>CA potentiel du magasin</th>
                <td class="key-value">' . $merchangisingRapports->getCaPotentielStore() . '</td>
            </tr>
            <tr>
                <th>Pourcentage de captation potentielle du marché total</th>
                <td class="key-value">' . number_format($potentialCapturePercentage, 2, ',', ' ') . '%</td>
            </tr>
            <tr>
                <th>Indicateur de résultat (FROT)</th>
                <td class="key-value">' . number_format($merchangisingRapports->getResultFrot(), 2, ',', ' ') . '</td>
            </tr>
        </table>
    </div>
    
    <div class="footer">
        Ce rapport a été généré le ' . date('d/m/Y') . ' - Toutes les informations sont confidentielles et réservées à la direction
    </div>
</body>
</html>';

        return $html;
    }
}
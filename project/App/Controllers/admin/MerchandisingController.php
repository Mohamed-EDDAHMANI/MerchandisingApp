<?php

namespace App\Controllers\Admin;

use App\Services\MerchandisingService;
use App\Utils\Redirects\Redirect;
use App\Controllers\BaseController;

class MerchandisingController
{
    private $merchandisingService;

    public function __construct() {
        $this->merchandisingService = new MerchandisingService();
    }

    public function analysePotentiel()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->merchandisingService->analysePotentiel($data);
    }

    public function analyseConcurrence()
    {
        $result = $this->merchandisingService->analyseConcurrence();
        require 'views/merchandising/analyse-concurrence.php';
    }

    public function calculRentabilite()
    {
        $result = $this->merchandisingService->calculRentabilite();
        require 'views/merchandising/calcul-rentabilite.php';
    }

    public function estimationMarge()
    {
        $result = $this->merchandisingService->estimationMarge();
        require 'views/merchandising/estimation-marge.php';
    }
}

?>
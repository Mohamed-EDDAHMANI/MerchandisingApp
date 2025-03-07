<?php

class MerchandisingController
{
    private $merchandisingService;

    public function __construct(MerchandisingService $merchandisingService)
    {
        $this->merchandisingService = $merchandisingService;
    }

    public function analyseDemographique()
    {
        $result = $this->merchandisingService->analyseDemographique();
        require 'views/merchandising/analyse-demographique.php';
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
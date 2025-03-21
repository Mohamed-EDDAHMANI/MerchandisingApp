<?php

class MerchandisingData {
    private $id;
    private $store_id;
    private $zone_population;
    private $avg_household_size;
    private $nombre_menages;
    private $avg_annual_spending;
    private $regional_wealth_index;
    private $invasion;
    private $evasion;
    private $CA_potentiel_zone;
    private $competitor_revenue;
    private $CA_potentiel_store;
    private $result_frot;
    private $analysis_date;
    private $createdAt;
    private $updatedAt;

    // Constructeur
    public function __construct($data) {
        $this->id = $data['id'] ?? null;
        $this->store_id = $data['store_id'] ?? null;
        $this->zone_population = $data['zone_population'] ?? null;
        $this->avg_household_size = $data['avg_household_size'] ?? null;
        $this->nombre_menages = $data['nombre_menages'] ?? null;
        $this->avg_annual_spending = $data['avg_annual_spending'] ?? null;
        $this->regional_wealth_index = $data['regional_wealth_index'] ?? null;
        $this->invasion = $data['invasion'] ?? null;
        $this->evasion = $data['evasion'] ?? null;
        $this->CA_potentiel_zone = $data['CA_potentiel_zone'] ?? null;
        $this->competitor_revenue = $data['competitor_revenue'] ?? null;
        $this->CA_potentiel_store = $data['CA_potentiel_store'] ?? null;
        $this->result_frot = $data['result_frot'] ?? 0;
        $this->analysis_date = $data['analysis_date'] ?? date('Y-m-d');
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    // Getters et Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getStoreId() {
        return $this->store_id;
    }

    public function setStoreId($store_id) {
        $this->store_id = $store_id;
    }

    public function getZonePopulation() {
        return $this->zone_population;
    }

    public function setZonePopulation($zone_population) {
        $this->zone_population = $zone_population;
    }

    public function getAvgHouseholdSize() {
        return $this->avg_household_size;
    }

    public function setAvgHouseholdSize($avg_household_size) {
        $this->avg_household_size = $avg_household_size;
    }

    public function getNombreMenages() {
        return $this->nombre_menages;
    }

    public function setNombreMenages($nombre_menages) {
        $this->nombre_menages = $nombre_menages;
    }

    public function getAvgAnnualSpending() {
        return $this->avg_annual_spending;
    }

    public function setAvgAnnualSpending($avg_annual_spending) {
        $this->avg_annual_spending = $avg_annual_spending;
    }

    public function getRegionalWealthIndex() {
        return $this->regional_wealth_index;
    }

    public function setRegionalWealthIndex($regional_wealth_index) {
        $this->regional_wealth_index = $regional_wealth_index;
    }

    public function getInvasion() {
        return $this->invasion;
    }

    public function setInvasion($invasion) {
        $this->invasion = $invasion;
    }

    public function getEvasion() {
        return $this->evasion;
    }

    public function setEvasion($evasion) {
        $this->evasion = $evasion;
    }

    public function getCaPotentielZone() {
        return $this->CA_potentiel_zone;
    }

    public function setCaPotentielZone($CA_potentiel_zone) {
        $this->CA_potentiel_zone = $CA_potentiel_zone;
    }

    public function getCompetitorRevenue() {
        return $this->competitor_revenue;
    }

    public function setCompetitorRevenue($competitor_revenue) {
        $this->competitor_revenue = $competitor_revenue;
    }

    public function getCaPotentielStore() {
        return $this->CA_potentiel_store;
    }

    public function setCaPotentielStore($CA_potentiel_store) {
        $this->CA_potentiel_store = $CA_potentiel_store;
    }

    public function getResultFrot() {
        return $this->result_frot;
    }

    public function setResultFrot($result_frot) {
        $this->result_frot = $result_frot;
    }

    public function getAnalysisDate() {
        return $this->analysis_date;
    }

    public function setAnalysisDate($analysis_date) {
        $this->analysis_date = $analysis_date;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }
}

<?php

namespace App\Middleware\Auth;


class Permissions
{

  public static $permissions = [
    'admin' => 'getPointsDeVente|getPointsDeVenteById|sortPointsDeVente|createPointDeVente|updatePointDeVente|deletePointDeVente|dashboard|getUsers|getUserById|sortUsers|updateUser|createUser|toggleUserStatus|deleteUser|getMerchandising|analysePotentiel|exportPDF|exportExcel',
    
    'manager' => 'getPointsDeVente|getPointsDeVenteById|sortPointsDeVente|createPointDeVente|updatePointDeVente|deletePointDeVente|dashboard|comparaisonVilles|analyseDemographique|analyseConcurrence|calculRentabilite|estimationMarge',
    
    'employee' => 'getPointsDeVente|getPointsDeVenteById|sortPointsDeVente|dashboard|comparaisonVilles|analyseDemographique|analyseConcurrence|calculRentabilite|estimationMarge',
    
    'public' => 'getLoginPage|login|getSignupPage|signup|logout|index'
];



}
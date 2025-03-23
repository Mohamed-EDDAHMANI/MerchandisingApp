<?php

namespace App\Middleware\Auth;


class Permissions
{

  public static $permissions = [
    'admin' => 'getPointsDeVente|getPointsDeVenteById|sortPointsDeVente|createPointDeVente|updatePointDeVente|deletePointDeVente|dashboard|getUsers|getUserById|sortUsers|updateUser|createUser|toggleUserStatus|deleteUser|getRapports|getMerchandising|analysePotentiel|deleteRepport|getRepports|logout|exportPDF|exportExcel|deleteUserRepport|getRepportsById',
    
    'manager' => 'getPointsDeVente|getPointsDeVenteById|sortPointsDeVente|createPointDeVente|updatePointDeVente|deletePointDeVente|index|comparaisonVilles|analyseDemographique|analyseConcurrence|calculRentabilite|logout|estimationMarge',
    
    'employee' => 'getPointsDeVente|getPointsDeVenteById|sortPointsDeVente|dashboard|comparaisonVilles|analyseDemographique|analyseConcurrence|calculRentabilite|estimationMarge',
    
    'public' => 'getLoginPage|login|getSignupPage|signup|logout|index'
];



}
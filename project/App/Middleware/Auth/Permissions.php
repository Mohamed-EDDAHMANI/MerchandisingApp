<?php

namespace App\Middleware\Auth;


class Permissions
{

  public static $permissions = [
    'admin' => 'getPointsDeVente|getPointsDeVenteById|sortPointsDeVente|createPointDeVente|updatePointDeVente|deletePointDeVente|dashboard|getUsers|getUserById|sortUsers|updateUser|createUser|toggleUserStatus|deleteUser|getRapports|getMerchandising|analysePotentiel|deleteRepport|getRepports|logout|exportPDF|exportExcel|deleteUserRepport|getRepportsById',
    
    'manager' => 'createCategory|getCategoryById|udpateCategory|getCategoryById|udpateCategory|deleteCategory|getProductList|index|createCategory|updateCategory|deleteCategory|logout',
    
    'employee' => 'getPointsDeVente|getPointsDeVenteById|sortPointsDeVente|dashboard|comparaisonVilles|analyseDemographique|analyseConcurrence|calculRentabilite|estimationMarge',
    
    'public' => 'getLoginPage|login|getSignupPage|signup|logout|index'
];



}
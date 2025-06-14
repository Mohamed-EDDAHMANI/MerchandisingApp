<?php

namespace App\Middleware\Auth;


class Permissions
{

  public static $permissions = [
    'admin' => 'getPointsDeVente|getPointsDeVenteById|sortPointsDeVente|createPointDeVente|updatePointDeVente|deletePointDeVente|dashboard|getUsers|getUserById|sortUsers|updateUser|createUser|toggleUserStatus|deleteUser|getRapports|getMerchandising|analysePotentiel|deleteRepport|getRepports|logout|exportPDF|exportExcel|deleteUserRepport|getRepportsById|getStorePerformance|getStoreRentabilite',
    
    'manager' => 'createCategory|getCategoryById|getProductList|createProduct|index|updateCategory|getProductById|deleteCategory|logout|updateProduct|deleteProduct|sortProduct|createSupplier|getSupplierById|updateSupplier|deleteSupplier|createOrder|confirmOrder|getOrder|store|deleteObjectifs|getSalesChart|getCategoriesData|getEmployeesSales',
    
    'employee' => 'index|getProducts|createSales|createReport|getSales|logout',
    
    'public' => 'getLoginPage|notAutorise|login|getSignupPage|signup|logout|index'
];



}
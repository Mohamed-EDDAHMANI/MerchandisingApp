<?php

// Routes principales de l'application Merchandising
// Page d'accueil
$router->get('/', 'HomeController@index');

// Authentification
$router->get('/login', 'AuthController@getLoginPage'); // Afficher la page de connexion
$router->post('/login', 'AuthController@login'); // Traiter la connexion
$router->get('/signup', 'AuthController@getSignupPage'); // Afficher la page d'inscription
$router->post('/signup', 'AuthController@signup'); // Traiter l'inscription
$router->get('/logout', 'AuthController@logout'); // Déconnexion
$router->get('/notAutorise', 'AuthController@notAutorise'); // Déconnexion

// Tableau de bord de l'administrateur
$router->get('/admin/dashboard', 'AdminController@dashboard'); // Vue principale du tableau de bord

// front test
$router->get('/test', 'AdminController@test'); // front test

// Gestion des points de vente
$router->get('/admin/points-de-vente', 'StoreController@getPointsDeVente'); // Lister les points de vente
$router->get('/admin/points-de-vente/{id}', 'StoreController@getPointsDeVenteById'); // get by id
$router->post('/admin/points-de-vente', 'StoreController@sortPointsDeVente'); // trie les points de vente
$router->get('/admin/merchandising', 'StoreController@getMerchandising'); // get by id
$router->post('/admin/points-de-vente/create', 'StoreController@createPointDeVente'); // Ajouter un point de vente
$router->post('/admin/points-de-vente/update/{id}', 'StoreController@updatePointDeVente'); // Modifier un point de vente
$router->post('/admin/points-de-vente/delete/{id}', 'StoreController@deletePointDeVente'); // Supprimer un point de vente
$router->post('/admin/analyse', 'MerchandisingController@analysePotentiel');

// Tableau de bord et rapports
$router->get('/admin/rapports', 'RepportController@getRepports'); // Générer des rapports
$router->get('/admin/rapport/{id}', 'RepportController@getRepportsById'); // Générer des rapports
$router->get('/admin/rapports/pdf/{id}', 'RepportController@exportPDF'); // Exporter les données au format PDF
$router->get('/admin/rapports/delete/{id}', 'RepportController@deleteRepport'); // Comparer les performances des points de vente
$router->get('/admin/rapports/user/delete/{id}', 'RepportController@deleteUserRepport'); // Comparer les performances des points de vente

// Sécurité et gestion des utilisateurs
$router->get('/admin/utilisateurs', 'AdminController@getUsers'); // Lister les utilisateurs
$router->get('/admin/utilisateur/{id}', 'AdminController@getUserById'); // get user by id
$router->post('/admin/utilisateurs', 'AdminController@sortUsers'); // Lister les utilisateurs sort
$router->post('/admin/utilisateurs/update/{id}', 'AdminController@updateUser'); // Lister les utilisateurs sort
$router->post('/admin/utilisateurs/create', 'AdminController@createUser'); // Create user
$router->post('/admin/utilisateurs/toggle/{id}', 'AdminController@toggleUserStatus'); // Activer/Désactiver un utilisateur
$router->get('/admin/utilisateurs/delete/{id}', 'AdminController@deleteUser'); // Supprimer un utilisateur définitivement

$router->get('/admin/stores/performance',  'AdminController@getStorePerformance'); // 
$router->get('/admin/stores/rentabilite',  'AdminController@getStoreRentabilite'); // 

// Manager Route
$router->get('/manager/dashboard', 'ManagerController@index'); // Exporter les données au format Excel
$router->post('/manager/category/create', 'ManagerController@createCategory'); // Exporter les données au format Excel
$router->get('/manager/category/getCategory/{id}', 'ManagerController@getCategoryById'); //get Category By Id
$router->post('/manager/category/update/{id}', 'ManagerController@updateCategory'); //get Category By Id
$router->get('/manager/category/delete/{id}', 'ManagerController@deleteCategory'); //get Category By Id

$router->get('/manager/products', 'ManagerController@getProductList'); //get Category By Id
$router->post('/manager/product/create', 'ManagerController@createProduct'); //get Category By Id
$router->get('/manager/product/getProduct/{id}', 'ManagerController@getProductById'); //get Category By Id
$router->post('/manager/product/update/{id}', 'ManagerController@updateProduct'); //get Category By Id
$router->get('/manager/product/delete/{id}', 'ManagerController@deleteProduct'); //get Category By Id
$router->post('/manager/product/sort', 'ManagerController@sortProduct'); // 

$router->post('/manager/supplier/create', 'SupplierController@createSupplier'); // 
$router->get('/manager/supplier/{id}', 'SupplierController@getSupplierById'); // 
$router->post('/manager/supplier/update/{id}', 'SupplierController@updateSupplier'); // 
$router->get('/manager/supplier/delete/{id}', 'SupplierController@deleteSupplier'); // 

$router->post('/manager/order/create', 'OrderController@createOrder'); // 
$router->get('/manager/order/{id}', 'OrderController@getOrder'); // 
$router->get('/manager/order/confirm/{id}', 'OrderController@confirmOrder'); // 
$router->post('/manager/objective/create', 'ObjectifController@store'); // 
$router->get('/manager/objective/delete/{id}',  'ObjectifController@deleteObjectifs'); // 

$router->get('/manager/sales',  'ManagerController@getSalesChart'); // 
$router->get('/manager/categories',  'ManagerController@getCategoriesData'); // 
$router->get('/manager/employees/sales',  'ManagerController@getEmployeesSales'); //

$router->get('/employee/home', 'EmployeeController@index'); // 
$router->post('/employee/products', 'EmployeeController@getProducts'); // 
$router->post('/employee/sale/create', 'EmployeeController@createSales'); // 
$router->post('/employee/report/create', 'EmployeeController@createReport'); // 
$router->post('/employee/sales', 'EmployeeController@getSales'); // 




?>
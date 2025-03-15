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

// Tableau de bord de l'administrateur
$router->get('/admin/dashboard', 'AdminController@dashboard'); // Vue principale du tableau de bord

// front test
$router->get('/test', 'AdminController@test'); // front test

// Gestion des points de vente
$router->get('/admin/points-de-vente', 'StoreController@getPointsDeVente'); // Lister les points de vente
$router->get('/admin/points-de-vente/{id}', 'StoreController@getPointsDeVenteById'); // get by id
$router->post('/admin/points-de-vente/create', 'StoreController@createPointDeVente'); // Ajouter un point de vente
$router->post('/admin/points-de-vente/update/{id}', 'StoreController@updatePointDeVente'); // Modifier un point de vente
$router->post('/admin/points-de-vente/delete/{id}', 'StoreController@deletePointDeVente'); // Supprimer un point de vente

// Calculs Merchandising
$router->get('/merchandising/analyse-demographique', 'MerchandisingController@analyseDemographique'); // Analyser le potentiel d'un point de vente
$router->get('/merchandising/analyse-concurrence', 'MerchandisingController@analyseConcurrence'); // Étudier la concurrence
$router->get('/merchandising/calcul-rentabilite', 'MerchandisingController@calculRentabilite'); // Calculer la rentabilité
$router->get('/merchandising/estimation-marge', 'MerchandisingController@estimationMarge'); // Estimer les marges bénéficiaires

// Tableau de bord et rapports
$router->get('/dashboard', 'DashboardController@index'); // Tableau de bord principal
$router->get('/dashboard/rapports', 'DashboardController@getRapports'); // Générer des rapports
$router->get('/dashboard/comparaison', 'DashboardController@comparaisonVilles'); // Comparer les performances des points de vente

// Sécurité et gestion des utilisateurs
$router->get('/admin/utilisateurs', 'AdminController@getUsers'); // Lister les utilisateurs
$router->get('/admin/utilisateur/{id}', 'AdminController@getUserById'); // get user by id
$router->post('/admin/utilisateurs', 'AdminController@sortUsers'); // Lister les utilisateurs sort
$router->post('/admin/utilisateurs/update/{id}', 'AdminController@updateUser'); // Lister les utilisateurs sort
$router->post('/admin/utilisateurs/create', 'AdminController@createUser'); // Create user
$router->post('/admin/utilisateurs/toggle/{id}', 'AdminController@toggleUserStatus'); // Activer/Désactiver un utilisateur
$router->post('/admin/utilisateurs/delete/{id}', 'AdminController@deleteUser'); // Supprimer un utilisateur définitivement

// API pour l'export des rapports
$router->get('/api/export/pdf', 'ExportController@exportPDF'); // Exporter les données au format PDF
$router->get('/api/export/excel', 'ExportController@exportExcel'); // Exporter les données au format Excel

?>
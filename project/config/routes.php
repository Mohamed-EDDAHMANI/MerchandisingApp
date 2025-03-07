<?php

// Routes principales de l'application Merchandising
$router->post('/admin/points-de-vente/update/{id}', 'AdminController@updatePointDeVente'); // Modifier un point de vente

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
$router->get('/admin/points-de-vente', 'AdminController@getPointsDeVente'); // Lister les points de vente
$router->post('/admin/points-de-vente/create', 'AdminController@createPointDeVente'); // Ajouter un point de vente
$router->post('/admin/points-de-vente/update/{id}', 'AdminController@updatePointDeVente'); // Modifier un point de vente
$router->post('/admin/points-de-vente/delete/{id}', 'AdminController@deletePointDeVente'); // Supprimer un point de vente

// Gestion des responsables de points de vente
$router->get('/admin/responsables', 'AdminController@getResponsables'); // Lister les responsables
$router->post('/admin/responsables/assigner', 'AdminController@assignerResponsable'); // Assigner un responsable à un point de vente
$router->post('/admin/responsables/revoquer/{id}', 'AdminController@revoquerResponsable'); // Révoquer un responsable

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
$router->get('/admin/utilisateurs', 'AdminController@getUtilisateurs'); // Lister les utilisateurs
$router->post('/admin/utilisateurs/toggle/{id}', 'AdminController@toggleUserStatus'); // Activer/Désactiver un utilisateur
$router->post('/admin/utilisateurs/delete/{id}', 'AdminController@deleteUser'); // Supprimer un utilisateur définitivement

// API pour l'export des rapports
$router->get('/api/export/pdf', 'ExportController@exportPDF'); // Exporter les données au format PDF
$router->get('/api/export/excel', 'ExportController@exportExcel'); // Exporter les données au format Excel

?>
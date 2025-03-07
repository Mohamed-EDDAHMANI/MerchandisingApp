<?php

return [
    // Admin Dashboard and related routes with required roles
    '/admin/dashboard' => ['admin'],
    '/admin/points-de-vente' => ['admin', 'manager'],
    '/admin/points-de-vente/create' => ['admin'],
    '/admin/points-de-vente/update/{id}' => ['admin', 'manager'],
    '/admin/points-de-vente/delete/{id}' => ['admin'],
    
    // Admin Responsible Routes
    '/admin/responsables' => ['admin'],
    '/admin/responsables/assigner' => ['admin'],
    '/admin/responsables/revoquer/{id}' => ['admin'],
    
    // Merchandising Calculations Routes
    '/merchandising/analyse-demographique' => ['admin', 'manager'],
    '/merchandising/analyse-concurrence' => ['admin', 'manager'],
    '/merchandising/calcul-rentabilite' => ['admin', 'manager'],
    '/merchandising/estimation-marge' => ['admin', 'manager'],
    
    // Dashboard and Report Routes
    '/dashboard' => ['admin', 'manager'],
    '/dashboard/rapports' => ['admin'],
    '/dashboard/comparaison' => ['admin'],
    
    // User Management Routes
    '/admin/utilisateurs' => ['admin'],
    '/admin/utilisateurs/toggle/{id}' => ['admin'],
    '/admin/utilisateurs/delete/{id}' => ['admin'],
    
    // Export API Routes
    '/api/export/pdf' => ['admin'],
    '/api/export/excel' => ['admin'],
];

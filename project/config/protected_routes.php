<?php

return [
    // Admin Dashboard and related routes
    '/admin/dashboard',
    '/admin/points-de-vente',
    '/admin/points-de-vente/create',
    '/admin/points-de-vente/update/{id}',
    '/admin/points-de-vente/delete/{id}',

    // Admin Responsible Routes
    '/admin/responsables',
    '/admin/responsables/assigner',
    '/admin/responsables/revoquer/{id}',

    // Merchandising Calculations Routes
    '/merchandising/analyse-demographique',
    '/merchandising/analyse-concurrence',
    '/merchandising/calcul-rentabilite',
    '/merchandising/estimation-marge',

    // Dashboard and Report Routes
    '/dashboard',
    '/dashboard/rapports',
    '/dashboard/comparaison',

    // User Management Routes
    '/admin/utilisateurs',
    '/admin/utilisateur/{id}',
    '/admin/utilisateurs/update/{id}',
    '/admin/utilisateurs/create',
    '/admin/utilisateurs/toggle/{id}',
    '/admin/utilisateurs/delete/{id}',

    // Manager Routes
    '/manager/dashboard',
    '/manager/category/create',
    '/manager/category/getCategory/{id}',
    '/manager/category/update/{id}',
    '/manager/category/delete/{id}',

    '/manager/products',
    '/manager/product/create',
    '/manager/product/update/{id}',
    '/manager/product/delete/{id}',
];

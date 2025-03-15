<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandising Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>

<body class="bg-gray-100 flex h-screen">
    <!-- Sidebar -->
    <aside class="hidden md:flex md:flex-col w-64 bg-blue-700 text-white">
        <div class="p-4 border-b border-blue-600">
            <h2 class="text-2xl font-bold">Merchandising</h2>
        </div>
        <nav class="flex-1 overflow-y-auto py-4">
            <ul>
                <li class="px-4 py-2 hover:bg-blue-800">
                    <a href="/admin/dashboard" class="flex items-center">
                        <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-blue-800 bg-blue-800">
                    <a href="" class="flex items-center">
                        <i class="fas fa-store w-5 h-5 mr-3"></i>
                        <span>Points de vente</span>
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-blue-800">
                    <a href="#" class="flex items-center">
                        <i class="fas fa-calculator w-5 h-5 mr-3"></i>
                        <span>Calculs Merchandising</span>
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-blue-800 ">
                    <a href="/admin/utilisateurs" class="flex items-center">
                        <i class="fas fa-users w-5 h-5 mr-3"></i>
                        <span>Utilisateurs</span>
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-blue-800">
                    <a href="#" class="flex items-center">
                        <i class="fas fa-file-alt w-5 h-5 mr-3"></i>
                        <span>Rapports</span>
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-blue-800">
                    <a href="#" class="flex items-center">
                        <i class="fas fa-cog w-5 h-5 mr-3"></i>
                        <span>Paramètres</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="p-4 border-t border-blue-600">
            <a href="#" class="flex items-center text-white hover:text-gray-200">
                <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                <span>Déconnexion</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Navbar -->
        <header class="bg-white shadow-sm z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
                <div class="flex items-center md:hidden">
                    <button type="button"
                        class="text-gray-800 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-blue-700">Points de vente</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative hidden md:block">
                        <input type="text" placeholder="Recherche rapide..."
                            class="w-64 pl-10 pr-4 py-2 border-0 rounded-full bg-gray-100 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all duration-300">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                    <button
                        class="p-2 rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-bell text-lg"></i>
                    </button>
                    <div class="relative">
                        <button type="button"
                            class="flex items-center text-gray-800 hover:text-gray-600 focus:outline-none">
                            <div class="h-9 w-9 rounded-full bg-blue-600 text-white flex items-center justify-center">
                                <span class="font-medium">AU</span>
                            </div>
                            <span class="hidden md:block ml-2 font-medium">Admin User</span>
                            <i class="fas fa-chevron-down ml-2 text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
            <div class="max-w-7xl mx-auto space-y-6">
                <!-- Page Header with Action Button and New Store Form -->
                <div class="bg-white rounded-xl shadow-sm">
                    <div
                        class="flex flex-col md:flex-row md:items-center md:justify-between p-6 border-b border-gray-100">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Gestion des Points de Vente</h2>
                            <p class="mt-1 text-sm text-gray-500">Gérez votre réseau de magasins et suivez leurs
                                performances</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <button id="toggle-form"
                                class="flex items-center px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <i class="fas fa-plus mr-2"></i>Nouveau Point de Vente
                            </button>
                        </div>
                    </div>

                    <!-- Create New Store Form - Now inside the same card as the header -->
                    <div id="store-form" class="hidden p-6 bg-gray-50 border-b border-gray-100">
                        <form action="/admin/points-de-vente/create" method="POST">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="store-name" class="block text-sm font-medium text-gray-700 mb-2">Nom du
                                        Point de Vente</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-store text-gray-400"></i>
                                        </div>
                                        <input type="text" id="store-name" name="name"
                                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Nom du magasin">
                                    </div>
                                </div>
                                <div>
                                    <label for="store-address"
                                        class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                                        </div>
                                        <input type="text" id="store-address" name="address"
                                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="123 Rue Exemple">
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="store-city"
                                        class="block text-sm font-medium text-gray-700 mb-2">Ville</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-city text-gray-400"></i>
                                        </div>
                                        <input type="text" id="store-city" name="city"
                                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Paris">
                                    </div>
                                </div>
                                <div>
                                    <label for="store-status"
                                        class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-toggle-on text-gray-400"></i>
                                        </div>
                                        <select id="store-status" name="status"
                                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                                            <option value="active">Actif</option>
                                            <option value="inactive">Inactif</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <i class="fas fa-chevron-down text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- New parking_space input -->
                            <div class="mb-6">
                                <div class="flex items-center">
                                    <div class="relative flex items-center">
                                        <div class="mr-3 flex items-center">
                                            <input type="checkbox" id="store-parking" name="parking_space" value="true"
                                                class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        </div>
                                        <label for="store-parking" class="text-sm font-medium text-gray-700">
                                            <div class="flex items-center">
                                                <i class="fas fa-parking text-gray-400 mr-2"></i>
                                                Parking disponible
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end space-x-3">
                                <button type="button" id="cancel-form"
                                    class="px-4 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors flex items-center">
                                    <i class="fas fa-times mr-2"></i>Annuler
                                </button>
                                <button type="submit" id="save-store"
                                    class="px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm hover:shadow flex items-center">
                                    <i class="fas fa-save mr-2"></i>Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Stats Overview Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div
                        class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total des Points de Vente</p>
                                <p class="mt-1 text-3xl font-bold text-gray-800" id="total-stores">24</p>
                                <p class="mt-1 text-xs text-gray-500">
                                    <span class="text-green-500"><i class="fas fa-arrow-up mr-1"></i>8%</span> depuis le
                                    mois dernier
                                </p>
                            </div>
                            <div class="p-3 rounded-full bg-blue-50 text-blue-500">
                                <i class="fas fa-store text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Points de Vente Actifs</p>
                                <p class="mt-1 text-3xl font-bold text-gray-800">20</p>
                                <p class="mt-1 text-xs text-gray-500">
                                    <span class="text-green-500"><i class="fas fa-arrow-up mr-1"></i>5%</span> depuis le
                                    mois dernier
                                </p>
                            </div>
                            <div class="p-3 rounded-full bg-green-50 text-green-500">
                                <i class="fas fa-check-circle text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-red-500 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Points de Vente Inactifs</p>
                                <p class="mt-1 text-3xl font-bold text-gray-800">4</p>
                                <p class="mt-1 text-xs text-gray-500">
                                    <span class="text-red-500"><i class="fas fa-arrow-up mr-1"></i>2%</span> depuis le
                                    mois dernier
                                </p>
                            </div>
                            <div class="p-3 rounded-full bg-red-50 text-red-500">
                                <i class="fas fa-exclamation-circle text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Stores List -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div
                        class="flex flex-col md:flex-row md:items-center md:justify-between p-6 border-b border-gray-100">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Liste des Points de Vente</h2>
                            <p class="mt-1 text-sm text-gray-500">Vue d'ensemble de tous vos points de vente</p>
                        </div>
                        <div class="mt-4 md:mt-0 relative">
                            <input type="text" placeholder="Rechercher..."
                                class="w-full md:w-64 pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nom</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Adresse</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ville</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Statut</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="stores-table-body">
                                <!-- Store 1 -->
                                <?php if (isset($data['stores'])): ?>
                                    <?php foreach ($data['stores'] as $value): ?>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="h-8 w-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-3">
                                                        <i class="fas fa-store"></i>
                                                    </div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <?php echo $value->getName() ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500"><?php echo $value->getAddress() ?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="h-6 w-6 rounded-full bg-gray-200 flex items-center justify-center mr-2 text-xs font-medium text-gray-700">
                                                        <?php echo strtoupper(substr($value->getCity(), 0, 2)); ?>
                                                    </div>
                                                    <div class="text-sm text-gray-500"><?php echo $value->getCity() ?></div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php if ($value->getStatus() == 'active'): ?>
                                                    <span
                                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        <i class="fas fa-circle text-green-500 mr-1 text-xs"></i> Actif
                                                    </span>
                                                <?php elseif ($value->getStatus() == 'inactive'): ?>
                                                    <span
                                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                        <i class="fas fa-circle text-gray-500 mr-1 text-xs"></i> Inactif
                                                    </span>
                                                <?php else: ?>
                                                    <span
                                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        <i class="fas fa-circle text-yellow-500 mr-1 text-xs"></i> En attente
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="p-1.5 rounded-lg text-blue-600 hover:bg-blue-50 mr-2 edit-store"
                                                    onclick="updateModel(<?php echo $value->getId() ?>)" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="p-1.5 rounded-lg text-red-600 hover:bg-red-50 delete-store"
                                                    onclick="deleteModel(<?php echo $value->getId() ?>)" title="Supprimer">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>

                    <div
                        class="flex flex-col md:flex-row md:items-center md:justify-between p-6 border-t border-gray-100">
                        <div class="text-sm text-gray-600">
                            Affichage de <span class="font-medium">1</span> à <span class="font-medium">4</span> sur
                            <span class="font-medium">24</span> résultats
                        </div>
                        <div class="mt-4 md:mt-0">
                            <nav class="flex space-x-1">
                                <button
                                    class="px-3 py-2 rounded-md text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                                    disabled>
                                    <i class="fas fa-chevron-left text-xs"></i>
                                </button>
                                <button
                                    class="px-3 py-2 rounded-md text-sm font-medium text-white bg-blue-600 border border-blue-600 hover:bg-blue-700">1</button>
                                <button
                                    class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">2</button>
                                <button
                                    class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">3</button>
                                <button
                                    class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">4</button>
                                <button
                                    class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">5</button>
                                <button
                                    class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden" id="delete-modal">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 transform transition-all">
            <div class="text-center mb-6">
                <div
                    class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 text-red-600 mb-4">
                    <i class="fas fa-exclamation-triangle text-lg"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Confirmer la suppression</h3>
                <p class="text-sm text-gray-500 mt-2">Êtes-vous sûr de vouloir supprimer ce point de vente ? Cette
                    action est irréversible.</p>
            </div>
            <div class="flex justify-center space-x-3">
                <button type="button" id="cancel-delete"
                    class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors font-medium">
                    Annuler
                </button>
                <form action="" method="POST" id="confirm-delete-form">
                    <button type="submit" id="confirm-delete"
                        class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Store Modal -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden" id="update-modal">
        <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full p-6 transform transition-all">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Modifier le Point de Vente</h3>
                <button id="close-update" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="update-store-form" action="" method="POST">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="update-store-name" class="block text-sm font-medium text-gray-700 mb-2">Nom du Point
                            de Vente</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-store text-gray-400"></i>
                            </div>
                            <input type="text" id="update-store-name" name="name"
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div>
                        <label for="update-store-address"
                            class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                            <input type="text" id="update-store-address" name="address"
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div>
                        <label for="update-store-city"
                            class="block text-sm font-medium text-gray-700 mb-2">Ville</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-city text-gray-400"></i>
                            </div>
                            <input type="text" id="update-store-city" name="city"
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div>
                        <label for="update-store-status"
                            class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-toggle-on text-gray-400"></i>
                            </div>
                            <select id="update-store-status" name="status"
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                                <option value="active">Actif</option>
                                <option value="pending">Pending</option>
                                <option value="inactive">Inactif</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Parking</label>
                        <div class="flex items-center">
                            <div class="relative flex items-center">
                                <div class="mr-3 flex items-center">
                                    <input type="checkbox" id="update-store-parking" name="parkingSpace"
                                        class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                </div>
                                <label for="update-store-parking" class="text-sm font-medium text-gray-700">
                                    <div class="flex items-center">
                                        <i class="fas fa-parking text-gray-400 mr-2"></i>
                                        Parking disponible
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" id="cancel-update"
                            class="px-4 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors flex items-center">
                            <i class="fas fa-times mr-2"></i>Annuler
                        </button>
                        <button type="submit"
                            class="px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm hover:shadow flex items-center">
                            <i class="fas fa-save mr-2"></i>Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- error modal -->
    <?php if (isset($_SESSION['error'])): ?>
        <?php
        $isSuccess = $_SESSION['error']['type'] === 'success';
        $bgColor = $isSuccess ? 'bg-emerald-50' : 'bg-rose-50';
        $textColor = $isSuccess ? 'text-emerald-800' : 'text-rose-800';
        $borderColor = $isSuccess ? 'border-emerald-200' : 'border-rose-200';
        $iconBgColor = $isSuccess ? 'bg-emerald-100' : 'bg-rose-100';
        ?>
        <div id="alert-message" class="message fixed top-4 left-1/2 transform -translate-x-1/2 z-50 animate-fadeIn
                flex items-center gap-3 w-auto max-w-md
                <?php echo "$bgColor $textColor $borderColor"; ?> 
                px-4 py-3 rounded-lg shadow-lg border">

            <!-- Icon container with circular background -->
            <div class="<?php echo $iconBgColor; ?> p-2 rounded-full flex-shrink-0">
                <?php if ($isSuccess): ?>
                    <!-- Success icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                <?php else: ?>
                    <!-- Error icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                <?php endif; ?>
            </div>

            <!-- Message content -->
            <div class="flex-1">
                <p class="font-medium"><?php echo htmlspecialchars($_SESSION['error']['message']); ?></p>
            </div>

            <!-- Close button -->
            <button onclick="this.parentElement.remove()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <script src="../../public/assets/js/store.js"></script>
</body>

</html>
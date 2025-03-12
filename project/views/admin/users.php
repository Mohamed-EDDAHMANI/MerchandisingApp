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
                    <a href="#" class="flex items-center">
                        <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-blue-800">
                    <a href="#" class="flex items-center">
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
                <li class="px-4 py-2 hover:bg-blue-800 bg-blue-800">
                    <a href="#" class="flex items-center">
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
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Gestion des Utilisateurs</h1>
                <button id="openFormBtn"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                    <i class="fas fa-plus mr-2"></i> Ajouter un utilisateur
                </button>
            </div>
        </header>

        <!-- User List -->
        <main class="flex-1 overflow-y-auto bg-gray-100 p-4">
            <div class="max-w-7xl mx-auto">
                <!-- Search and Filter Bar -->
                <div class="bg-white p-4 rounded-lg shadow-sm mb-4 flex flex-wrap items-center justify-between">
                    <div class="flex items-center w-full md:w-auto mb-2 md:mb-0">
                        <div class="relative w-full md:w-64">
                            <input type="text" id="searchInput"
                                class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Rechercher...">
                            <div class="absolute left-3 top-2.5 text-gray-400">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center space-x-2">
                        <select id="roleFilter"
                            class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Tous les rôles</option>
                            <option value="Manager">Manager</option>
                            <option value="Employee">Employé</option>
                        </select>
                        <select id="storeFilter"
                            class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Tous les magasins</option>
                            <option value="Store A">Magasin A</option>
                            <option value="Store B">Magasin B</option>
                            <option value="Store C">Magasin C</option>
                        </select>
                        <select id="statusFilter"
                            class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Tous les statuts</option>
                            <option value="true">Actif</option>
                            <option value="false">Inactif</option>
                        </select>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rôle</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Magasin</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Salaire</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="usersTableBody">
                            <?php if (isset($data)): ?>
                                <?php foreach ($data as $value): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-1">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <?php echo htmlspecialchars($value['first_name'] . ' ' . $value['last_name']) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"><?php echo htmlspecialchars($value['email']) ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($value['role_name'] == 'manager'): ?>
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"><?php echo htmlspecialchars($value['role_name']) ?></span>
                                            <?php else: ?>
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"><?php echo htmlspecialchars($value['role_name']) ?></span>
                                            <?php endif ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?= htmlspecialchars($value['store_name'] ? $value['store_name'] : 'Not assigned') ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?= htmlspecialchars($value['role_name'] == 'manager' ? $value['manager_salary'] : $value['employee_salary']) ?>
                                            DH
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($value['role_name'] == 'manager'): ?>
                                                <?php if ($value['manager_valid']): ?>
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Actif</span>
                                                <?php else: ?>
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactif</span>
                                                <?php endif ?>
                                            <?php else: ?>
                                                <?php if ($value['employee_valid']): ?>
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Actif</span>
                                                <?php else: ?>
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactif</span>
                                                <?php endif ?>
                                            <?php endif ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-indigo-600 hover:text-indigo-900 mr-3 viewBtn" data-id="1"><i
                                                    class="fas fa-eye"></i></button>
                                            <button class="text-yellow-600 hover:text-yellow-900 mr-3 editBtn" data-id="1"><i
                                                    class="fas fa-edit"></i></button>
                                            <button class="text-red-600 hover:text-red-900 toggleStatusBtn" data-id="1"
                                                data-status="true"><i class="fas fa-user-times"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <!-- <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Marie Lefebvre</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">marie.lefebvre@example.com</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Employé</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Magasin B</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">38,000 €</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Actif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-indigo-600 hover:text-indigo-900 mr-3 viewBtn" data-id="2"><i
                                            class="fas fa-eye"></i></button>
                                    <button class="text-yellow-600 hover:text-yellow-900 mr-3 editBtn" data-id="2"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="text-red-600 hover:text-red-900 toggleStatusBtn" data-id="2"
                                        data-status="true"><i class="fas fa-user-times"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Pierre Martin</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">pierre.martin@example.com</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Employé</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Magasin A</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">36,500 €</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-indigo-600 hover:text-indigo-900 mr-3 viewBtn" data-id="3"><i
                                            class="fas fa-eye"></i></button>
                                    <button class="text-yellow-600 hover:text-yellow-900 mr-3 editBtn" data-id="3"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="text-green-600 hover:text-green-900 toggleStatusBtn" data-id="3"
                                        data-status="false"><i class="fas fa-user-check"></i></button>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div
                    class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-4 rounded-lg">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="#"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Précédent
                        </a>
                        <a href="#"
                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Suivant
                        </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Affichage des éléments <span class="font-medium">1</span> à <span
                                    class="font-medium">3</span> sur <span class="font-medium">3</span> résultats
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                aria-label="Pagination">
                                <a href="#"
                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Précédent</span>
                                    <i class="fas fa-chevron-left h-5 w-5"></i>
                                </a>
                                <a href="#" aria-current="page"
                                    class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    1
                                </a>
                                <a href="#"
                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Suivant</span>
                                    <i class="fas fa-chevron-right h-5 w-5"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- User Form Modal -->
    <div id="userFormModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg w-full max-w-2xl mx-4 overflow-hidden">
            <div class="px-6 py-4 bg-blue-700 text-white flex justify-between items-center">
                <h3 class="text-xl font-bold" id="modalTitle">Ajouter un utilisateur</h3>
                <button id="closeFormBtn" class="text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6">
                <form id="userForm" action="/admin/utilisateurs/create" method="POST">
                    <input type="hidden" id="userId" value="">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                            <input type="text" id="firstName" name="firstName"
                                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                            <input type="text" id="lastName" name="lastName"
                                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                        <input type="password" id="password" name="password"
                            class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="store" class="block text-sm font-medium text-gray-700 mb-1">Magasin</label>
                            <select id="store" name="store_id"
                                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionner un magasin</option>
                                <option value="1">Magasin A</option>
                                <option value="2">Magasin B</option>
                                <option value="3">Magasin C</option>
                            </select>
                        </div>
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Rôle</label>
                            <select id="role" name="role"
                                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionner un rôle</option>
                                <option value="manager">Manager</option>
                                <option value="employee">Employé</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="salary" class="block text-sm font-medium text-gray-700 mb-1">Salaire (€)</label>
                            <input type="number" id="salary" name="salary"
                                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="flex items-center">
                            <label class="flex items-center mt-5">
                                <input type="checkbox" id="isValid" name="is_valid"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                    onchange="this.value = this.checked ? 'true' : 'false'">
                                <span class="ml-2 text-gray-700">Compte actif</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="button" id="cancelBtn"
                            class="mr-2 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">Annuler</button>
                        <button type="submit" id="saveBtn"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- User Details Modal -->
    <div id="userDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg w-full max-w-2xl mx-4 overflow-hidden">
            <div class="px-6 py-4 bg-blue-700 text-white flex justify-between items-center">
                <h3 class="text-xl font-bold">Détails de l'utilisateur</h3>
                <button id="closeDetailsBtn" class="text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nom complet</p>
                            <p class="text-lg font-semibold" id="detailName">Jean Dupont</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="text-lg" id="detailEmail">jean.dupont@example.com</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Rôle</p>
                            <p class="text-lg" id="detailRole">Manager</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Magasin</p>
                            <p class="text-lg" id="detailStore">Magasin A</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Salaire</p>
                            <p class="text-lg" id="detailSalary">42,000 €</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Statut</p>
                            <p class="text-lg" id="detailStatus">Actif</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="button" id="closeDetailsBtnBottom"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Fermer</button>
                </div>
            </div>
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

    <script>
        // Hide the message after 5 seconds
        setTimeout(() => {
            const alertMessage = document.getElementById('alert-message');
            if (alertMessage) {
                alertMessage.classList.add('opacity-0');
                setTimeout(() => alertMessage.remove(), 300);
            }
        }, 5000);

        // DOM Elements
        const userFormModal = document.getElementById('userFormModal');
        const userDetailsModal = document.getElementById('userDetailsModal');
        const openFormBtn = document.getElementById('openFormBtn');
        const closeFormBtn = document.getElementById('closeFormBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const closeDetailsBtn = document.getElementById('closeDetailsBtn');
        const closeDetailsBtnBottom = document.getElementById('closeDetailsBtnBottom');
        const userForm = document.getElementById('userForm');
        const modalTitle = document.getElementById('modalTitle');
        const viewBtns = document.querySelectorAll('.viewBtn');
        const editBtns = document.querySelectorAll('.editBtn');
        const toggleStatusBtns = document.querySelectorAll('.toggleStatusBtn');

        // Sample user data
        const users = [
            { id: 1, firstName: 'Jean', lastName: 'Dupont', email: 'jean.dupont@example.com', password: 'password', store: 'Magasin A', role: 'Manager', isValid: true, salary: 42000 },
            { id: 2, firstName: 'Marie', lastName: 'Lefebvre', email: 'marie.lefebvre@example.com', password: 'password', store: 'Magasin B', role: 'Employé', isValid: true, salary: 38000 },
            { id: 3, firstName: 'Pierre', lastName: 'Martin', email: 'pierre.martin@example.com', password: 'password', store: 'Magasin A', role: 'Employé', isValid: false, salary: 36500 }
        ];

        // Open form modal for new user
        openFormBtn.addEventListener('click', () => {
            modalTitle.textContent = 'Ajouter un utilisateur';
            document.getElementById('userId').value = '';
            userForm.reset();
            document.getElementById('isValid').checked = true;
            userFormModal.classList.remove('hidden');
        });

        // Close form modal
        closeFormBtn.addEventListener('click', () => {
            userFormModal.classList.add('hidden');
        });

        cancelBtn.addEventListener('click', () => {
            userFormModal.classList.add('hidden');
        });

        // Close details modal
        closeDetailsBtn.addEventListener('click', () => {
            userDetailsModal.classList.add('hidden');
        });

        closeDetailsBtnBottom.addEventListener('click', () => {
            userDetailsModal.classList.add('hidden');
        });

        // View user details
        viewBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const userId = parseInt(btn.getAttribute('data-id'));
                const user = users.find(u => u.id === userId);

                if (user) {
                    document.getElementById('detailName').textContent = `${user.firstName} ${user.lastName}`;
                    document.getElementById('detailEmail').textContent = user.email;
                    document.getElementById('detailRole').textContent = user.role;
                    document.getElementById('detailStore').textContent = user.store;
                    document.getElementById('detailSalary').textContent = `${user.salary.toLocaleString()} €`;
                    document.getElementById('detailStatus').textContent = user.isValid ? 'Actif' : 'Inactif';

                    userDetailsModal.classList.remove('hidden');
                }
            });
        });

        // Edit user
        editBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const userId = parseInt(btn.getAttribute('data-id'));
                const user = users.find(u => u.id === userId);

                if (user) {
                    modalTitle.textContent = 'Modifier un utilisateur';
                    document.getElementById('userId').value = user.id;
                    document.getElementById('firstName').value = user.firstName;
                    document.getElementById('lastName').value = user.lastName;
                    document.getElementById('email').value = user.email;
                    document.getElementById('password').value = user.password;
                    document.getElementById('store').value = user.store;
                    document.getElementById('role').value = user.role;
                    document.getElementById('salary').value = user.salary;
                    document.getElementById('isValid').checked = user.isValid;

                    userFormModal.classList.remove('hidden');
                }
            });
        });

        // Toggle user status
        toggleStatusBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const userId = parseInt(btn.getAttribute('data-id'));
                const currentStatus = btn.getAttribute('data-status') === 'true';
                const user = users.find(u => u.id === userId);

                if (user) {
                    user.isValid = !currentStatus;

                    // Update button and UI
                    btn.setAttribute('data-status', (!currentStatus).toString());

                    if (!currentStatus) {
                        btn.innerHTML = '<i class="fas fa-user-times"></i>';
                        btn.classList.remove('text-green-600', 'hover:text-green-900');
                        btn.classList.add('text-red-600', 'hover:text-red-900');
                    } else {
                        btn.innerHTML = '<i class="fas fa-user-check"></i>';
                        btn.classList.remove('text-red-600', 'hover:text-red-900');
                        btn.classList.add('text-green-600', 'hover:text-green-900');
                    }

                    // Update status in the table
                    const row = btn.closest('tr');
                    const statusCell = row.querySelector('td:nth-child(6)');
                    if (statusCell) {
                        statusCell.innerHTML = `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${user.isValid ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">${user.isValid ? 'Actif' : 'Inactif'}</span>`;
                    }
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const roleFilter = document.getElementById("roleFilter");
            const storeFilter = document.getElementById("storeFilter");
            const statusFilter = document.getElementById("statusFilter");

            // Function to fetch users based on filters
            async function fetchUsers() {
                const filters = {};

                if (roleFilter.value) filters.role = roleFilter.value;
                if (storeFilter.value) filters.store = storeFilter.value;
                if (statusFilter.value) filters.is_valid = statusFilter.value;

                try {
                    const response = await fetch("/admin/utilisateurs", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(filters)
                    });
                    if (!response.ok) throw new Error("Failed to fetch users");

                    const users = await response.json();
                    console.log(users);
                } catch (error) {
                    console.error("Error fetching users:", error);
                }
            }

            // Listen for changes in filters
            [roleFilter, storeFilter, statusFilter].forEach((input) => {
                input.addEventListener("change", fetchUsers);
            });

        });


    </script>
</body>

</html>
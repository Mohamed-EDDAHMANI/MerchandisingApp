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

<body class="bg-gray-50 flex h-screen font-sans">
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
                <li class="px-4 py-2 hover:bg-blue-800">
                    <a href="/admin/points-de-vente" class="flex items-center">
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
        <header class="bg-white shadow-md z-10 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
                <div class="flex items-center md:hidden">
                    <button type="button"
                        class="text-gray-800 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-blue-700">Gestion des Utilisateurs</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button id="openFormBtn"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-colors duration-200 flex items-center">
                        <i class="fas fa-plus mr-2"></i> Ajouter un utilisateur
                    </button>
                    <button
                        class="p-2 rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 relative">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                    </button>
                    <div class="relative">
                        <button type="button"
                            class="flex items-center text-gray-800 hover:text-gray-600 focus:outline-none">
                            <div class="h-9 w-9 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-sm">
                                <span class="font-medium">AU</span>
                            </div>
                            <span class="hidden md:block ml-2 font-medium">Admin User</span>
                            <i class="fas fa-chevron-down ml-2 text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- User List -->
        <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
            <div class="max-w-7xl mx-auto">
                <!-- Search and Filter Bar -->
                <div class="bg-white p-5 rounded-xl shadow-sm mb-6 flex flex-wrap items-center justify-between">
                    <div class="flex items-center w-full md:w-auto mb-3 md:mb-0">
                        <div class="relative w-full md:w-64">
                            <input type="text" id="searchInput"
                                class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Rechercher...">
                            <div class="absolute left-3 top-2.5 text-gray-400">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center space-x-3">
                        <select id="roleFilter" name="role"
                            class="border border-gray-200 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700">
                            <option value="">Tous les rôles</option>
                            <option value="manager">Manager</option>
                            <option value="employee">Employé</option>
                        </select>
                        <select id="storeFilter" name="store"
                            class="border border-gray-200 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700">
                            <option value="">Tous les magasins</option>
                            <?php if (isset($data['stores'])): ?>
                                <?php foreach ($data['stores'] as $value): ?>
                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <select id="statusFilter" name="is_valid"
                            class="border border-gray-200 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700">
                            <option value="">Tous les statuts</option>
                            <option value="true">Actif</option>
                            <option value="false">Inactif</option>
                        </select>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Nom</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Rôle</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Magasin</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Salaire</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Statut</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="usersTableBody">
                            <?php if (isset($data['users'])): ?>
                                <?php foreach ($data['users'] as $value): ?>
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
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
                                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"><?php echo htmlspecialchars($value['role_name']) ?></span>
                                            <?php else: ?>
                                                <span
                                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"><?php echo htmlspecialchars($value['role_name']) ?></span>
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
                                            <?php
                                            // Determine status based on role
                                            $isActive = ($value['role_name'] == 'manager') ? $value['manager_valid'] : $value['employee_valid'];
                                            $statusText = $isActive ? 'Actif' : 'Inactif';
                                            $statusClass = $isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                                            ?>
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                                <?= $statusText ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-3">
                                                <button class="text-indigo-600 hover:text-indigo-900 viewBtn bg-indigo-50 p-1.5 rounded-full hover:bg-indigo-100 transition-colors"
                                                    data-id="<?php echo $value['user_id'] ?>"
                                                    onclick="showDetailsModal(<?php echo $value['user_id'] ?>)">
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                                <button class="text-yellow-600 hover:text-yellow-900 editBtn bg-yellow-50 p-1.5 rounded-full hover:bg-yellow-100 transition-colors"
                                                    onclick="showModifyModal(<?php echo $value['user_id'] ?>)">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <form action="/admin/utilisateurs/toggle/<?php echo $value['user_id'] ?>"
                                                    method="POST">
                                                    <button type="submit"
                                                    class="text-red-600 hover:text-red-900 toggleStatusBtn bg-red-50 p-1.5 rounded-full hover:bg-red-100 transition-colors"
                                                        data-id="<?php echo $value['user_id'] ?>" data-status="true">
                                                        <?php if ($value['role_name'] == 'manager'): ?>
                                                            <i
                                                                class="fas <?php echo $value['manager_valid'] ? 'fa-user-check text-green-500' : 'fa-user-times'; ?>"></i>
                                                        <?php elseif ($value['role_name'] != 'manager'): ?>
                                                            <i
                                                                class="fas <?php echo $value['employee_valid'] ? 'fa-user-check text-green-500' : 'fa-user-times'; ?>"></i>
                                                        <?php endif ?>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div
                    class="bg-white px-6 py-4 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-6 rounded-xl shadow-sm">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="#"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 shadow-sm">
                            Précédent
                        </a>
                        <a href="#"
                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 shadow-sm">
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
    <div id="userFormModal"
        class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl w-full max-w-2xl mx-4 overflow-hidden shadow-xl">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-800 text-white flex justify-between items-center">
                <h3 class="text-xl font-bold" id="modalTitle">Ajouter un utilisateur</h3>
                <button id="closeFormBtn" class="text-white hover:text-gray-200 p-1 rounded-full hover:bg-blue-700/50 transition-colors">
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
                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                            <input type="text" id="lastName" name="lastName"
                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Assigner un nouveau
                            mot de passe !</label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <button type="button" id="togglePassword"
                                class="absolute right-3 top-2.5 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="store" class="block text-sm font-medium text-gray-700 mb-1">Magasin</label>
                            <select id="store" name="store_id"
                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Sélectionner un magasin</option>
                                <option value="1">Magasin A</option>
                                <option value="2">Magasin B</option>
                                <option value="3">Magasin C</option>
                            </select>
                        </div>
                        <div id="roleContainer">
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Rôle</label>
                            <select id="role" name="role"
                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
                            class="mr-2 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors shadow-sm">Annuler</button>
                        <button type="submit" id="saveBtn"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- User Details Modal -->
    <div id="userDetailsModal"
        class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl w-full max-w-2xl mx-4 overflow-hidden shadow-xl">
            <!-- Header -->
            <div
                class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-800 text-white flex justify-between items-center">
                <h3 class="text-xl font-bold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                    Détails de l'utilisateur
                </h3>
                <button id="closeDetailsBtn"
                    class="text-white hover:text-gray-200 hover:bg-blue-700/50 p-1 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</body>
</html>



           
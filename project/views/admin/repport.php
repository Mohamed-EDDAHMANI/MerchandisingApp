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
                <li class="px-4 py-2 hover:bg-blue-800">
                    <a href="#" class="flex items-center">
                        <i class="fas fa-users w-5 h-5 mr-3"></i>
                        <span>Utilisateurs</span>
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-blue-800 bg-blue-800">
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
                    <h1 class="text-2xl font-bold text-blue-700">Rapports</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Rechercher..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <button
                        class="p-2 rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 relative">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                    </button>
                    <div class="relative">
                        <button type="button"
                            class="flex items-center text-gray-800 hover:text-gray-600 focus:outline-none">
                            <div
                                class="h-9 w-9 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-sm">
                                <span class="font-medium">AU</span>
                            </div>
                            <span class="hidden md:block ml-2 font-medium">Admin User</span>
                            <i class="fas fa-chevron-down ml-2 text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
            <div class="max-w-7xl mx-auto">

                <!-- Tabs -->
                <div class="mb-6 border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                        <li class="mr-2">
                            <a href="#"
                                class="inline-block p-4 rounded-t-lg border-b-2 border-blue-600 text-blue-600 active"
                                id="merchandising-tab" onclick="showTab('merchandising')">
                                Rapports Merchandising
                            </a>
                        </li>
                        <li class="mr-2">
                            <a href="#"
                                class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300"
                                id="user-tab" onclick="showTab('user')">
                                Rapports Utilisateurs
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Merchandising Reports Tab Content -->
                <div id="merchandising-content" class="tab-content">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">Données de Merchandising</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Magasin
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Population
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            CA Potentiel Zone
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            CA Potentiel Magasin
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Revenu Concurrents
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Résultat FROT
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Sample data rows -->
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-medium text-gray-900">Magasin Paris Centre</div>
                                            <div class="text-xs text-gray-500">ID: 1001</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            42,500
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            <span class="font-medium">€8,750,000.00</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            <span class="font-medium">€2,450,000.00</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            <span class="font-medium">€3,250,000.00</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="mr-2 text-green-600 font-semibold">75.4%</span>
                                                <div class="w-16 h-2 bg-gray-200 rounded-full">
                                                    <div class="h-2 bg-green-500 rounded-full" style="width: 75%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-3">
                                                <button
                                                    class="text-blue-600 hover:text-blue-900 transition-colors duration-150">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                                <button
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-150">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-medium text-gray-900">Magasin Lyon</div>
                                            <div class="text-xs text-gray-500">ID: 1002</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            35,750
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            <span class="font-medium">€6,250,000.00</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            <span class="font-medium">€1,820,000.00</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            <span class="font-medium">€2,150,000.00</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="mr-2 text-green-600 font-semibold">68.2%</span>
                                                <div class="w-16 h-2 bg-gray-200 rounded-full">
                                                    <div class="h-2 bg-green-500 rounded-full" style="width: 68%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-3">
                                                <button
                                                    class="text-blue-600 hover:text-blue-900 transition-colors duration-150">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                                <button
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-150">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-medium text-gray-900">Magasin Marseille</div>
                                            <div class="text-xs text-gray-500">ID: 1003</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            39,200
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            <span class="font-medium">€7,120,000.00</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            <span class="font-medium">€1,950,000.00</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            <span class="font-medium">€2,750,000.00</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="mr-2 text-amber-600 font-semibold">54.8%</span>
                                                <div class="w-16 h-2 bg-gray-200 rounded-full">
                                                    <div class="h-2 bg-amber-500 rounded-full" style="width: 55%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-3">
                                                <button
                                                    class="text-blue-600 hover:text-blue-900 transition-colors duration-150">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                                <button
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-150">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-medium text-gray-900">Magasin Bordeaux</div>
                                            <div class="text-xs text-gray-500">ID: 1004</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            28,750
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            <span class="font-medium">€5,840,000.00</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            <span class="font-medium">€1,350,000.00</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            <span class="font-medium">€1,980,000.00</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="mr-2 text-red-600 font-semibold">42.3%</span>
                                                <div class="w-16 h-2 bg-gray-200 rounded-full">
                                                    <div class="h-2 bg-red-500 rounded-full" style="width: 42%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-3">
                                                <button
                                                    class="text-blue-600 hover:text-blue-900 transition-colors duration-150">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                                <button
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-150">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- User Reports Tab Content -->
                <div id="user-content" class="tab-content hidden">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">Rapports des Utilisateurs</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Utilisateur
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Type de rapport
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Sujet
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Message
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Sample data rows -->
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-sm">
                                                    <span class="font-medium">JP</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Jean Pierre</div>
                                                    <div class="text-xs text-gray-500">jean.pierre@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Profitabilité
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Analyse Q1 2025</div>
                                            <div class="text-xs text-gray-500">Créé le 15 Mar 2025</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700 max-w-xs">
                                            <div class="line-clamp-2">
                                                Analyse de la profitabilité du premier trimestre 2025 pour les magasins
                                                de la région parisienne. Recommandations pour optimiser les
                                                performances.
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-3">
                                                <button
                                                    class="text-blue-600 hover:text-blue-900 transition-colors duration-150">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-150">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-purple-600 text-white flex items-center justify-center shadow-sm">
                                                    <span class="font-medium">SL</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Sophie Laurent</div>
                                                    <div class="text-xs text-gray-500">sophie.laurent@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Analyse concurrentielle
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Nouveaux concurrents - Lyon
                                            </div>
                                            <div class="text-xs text-gray-500">Créé le 12 Mar 2025</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700 max-w-xs">
                                            <div class="line-clamp-2">
                                                Analyse détaillée des nouveaux concurrents dans la région lyonnaise et
                                                leur impact sur nos magasins. Stratégies de différenciation proposées.
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-3">
                                                <button
                                                    class="text-blue-600 hover:text-blue-900 transition-colors duration-150">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-150">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-amber-600 text-white flex items-center justify-center shadow-sm">
                                                    <span class="font-medium">MB</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Marc Bonnet</div>
                                                    <div class="text-xs text-gray-500">marc.bonnet@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Performance des ventes
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Bilan 2024 - Sud-Ouest</div>
                                            <div class="text-xs text-gray-500">Créé le 08 Mar 2025</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700 max-w-xs">
                                            <div class="line-clamp-2">
                                                Bilan des performances de vente pour les magasins du Sud-Ouest pour
                                                l'année 2024. Analyse des tendances et opportunités de croissance.
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-3">
                                                <button
                                                    class="text-blue-600 hover:text-blue-900 transition-colors duration-150">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-150">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-green-600 text-white flex items-center justify-center shadow-sm">
                                                    <span class="font-medium">CL</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Claire Lefèvre</div>
                                                    <div class="text-xs text-gray-500">claire.lefevre@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Profitabilité
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Projections 2025</div>
                                            <div class="text-xs text-gray-500">Créé le 05 Mar 2025</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700 max-w-xs">
                                            <div class="line-clamp-2">
                                                Projections financières pour l'année 2025 basées sur les tendances
                                                actuelles et les objectifs stratégiques. Recommandations pour maximiser
                                                les résultats.
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-3">
                                                <button
                                                    class="text-blue-600 hover:text-blue-900 transition-colors duration-150">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-150">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>


    <!-- JavaScript for Tab Switching -->
    <script>
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Show the selected tab content
            document.getElementById(tabName + '-content').classList.remove('hidden');

            // Update active tab styling
            document.querySelectorAll('ul li a').forEach(tab => {
                tab.classList.remove('border-blue-600', 'text-blue-600');
                tab.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
            });

            document.getElementById(tabName + '-tab').classList.add('border-blue-600', 'text-blue-600');
            document.getElementById(tabName + '-tab').classList.remove('hover:text-gray-600', 'hover:border-gray-300');
        }
    </script>

</body>

</html>
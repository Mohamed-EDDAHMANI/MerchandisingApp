<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Merchandising</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>

<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="hidden md:flex md:flex-col w-64 bg-blue-700 text-white">
            <div class="p-4 border-b border-blue-600">
                <h2 class="text-2xl font-bold">Merchandising</h2>
            </div>
            <nav class="flex-1 overflow-y-auto py-4">
                <ul>
                    <li class="px-4 py-2 hover:bg-blue-800 bg-blue-800">
                        <a href="#" class="flex items-center">
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
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm z-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
                    <div class="flex items-center md:hidden">
                        <button type="button"
                            class="text-gray-800 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-blue-700">Tableau de bord</h1>
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
                                <div
                                    class="h-9 w-9 rounded-full bg-blue-600 text-white flex items-center justify-center">
                                    <span class="font-medium">AU</span>
                                </div>
                                <span class="hidden md:block ml-2 font-medium">Admin User</span>
                                <i class="fas fa-chevron-down ml-2 text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-y-auto p-4">

                <!-- Quick Stats Summary -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-md text-white p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <p class="text-blue-100 text-sm">CA Mensuel</p>
                            <p class="text-2xl font-bold mt-1">€2.4M</p>
                            <div class="flex items-center mt-1">
                                <span class="text-green-300 text-xs"><i class="fas fa-arrow-up mr-1"></i>12%</span>
                                <span class="text-blue-200 text-xs ml-1">vs mois précédent</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-blue-100 text-sm">Fréquentation</p>
                            <p class="text-2xl font-bold mt-1">45.8K</p>
                            <div class="flex items-center mt-1">
                                <span class="text-green-300 text-xs"><i class="fas fa-arrow-up mr-1"></i>7%</span>
                                <span class="text-blue-200 text-xs ml-1">vs mois précédent</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-blue-100 text-sm">Panier Moyen</p>
                            <p class="text-2xl font-bold mt-1">€68.50</p>
                            <div class="flex items-center mt-1">
                                <span class="text-green-300 text-xs"><i class="fas fa-arrow-up mr-1"></i>3%</span>
                                <span class="text-blue-200 text-xs ml-1">vs mois précédent</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-blue-100 text-sm">Magasin le plus performant</p>
                            <p class="text-xl font-bold mt-1">Paris Centre</p>
                            <div class="flex items-center mt-1">
                                <span class="text-blue-200 text-xs">€498K ce mois-ci</span>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Charts and Reports Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b">
                            <h2 class="text-lg font-semibold text-gray-800">Performance par ville</h2>
                        </div>
                        <div class="p-4">
                            <canvas id="cityChart" height="200"></canvas>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b">
                            <h2 class="text-lg font-semibold text-gray-800">Tendance des marges</h2>
                        </div>
                        <div class="p-4">
                            <canvas id="marginChart" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="p-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Activités récentes</h2>
                    </div>
                    <div class="p-4">
                        <div class="flow-root">
                            <ul class="-my-3 divide-y divide-gray-200">
                                <li class="py-3">
                                    <div class="flex space-x-4">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-plus-circle text-green-500"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900">
                                                Nouveau point de vente ajouté: Casablanca Centre
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                Il y a 2 heures par Admin User
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-3">
                                    <div class="flex space-x-4">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-user-plus text-blue-500"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900">
                                                Nouvel utilisateur créé: Mohamed Hassan (Responsable)
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                Il y a 5 heures par Admin User
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-3">
                                    <div class="flex space-x-4">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-calculator text-purple-500"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900">
                                                Analyse de rentabilité effectuée: Rabat Nord
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                Il y a 1 jour par Jamal Bennani
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Initialize Charts -->
    <script>
        // City Performance Chart
        const cityCtx = document.getElementById('cityChart').getContext('2d');
        const cityChart = new Chart(cityCtx, {
            type: 'bar',
            data: {
                labels: ['Casablanca', 'Rabat', 'Marrakech', 'Tanger', 'Fès', 'Agadir'],
                datasets: [{
                    label: 'Rentabilité (%)',
                    data: [68, 72, 64, 59, 76, 51],
                    backgroundColor: '#1d4ed8',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        // Margin Trend Chart
        const marginCtx = document.getElementById('marginChart').getContext('2d');
        const marginChart = new Chart(marginCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                datasets: [{
                    label: 'Marge moyenne (%)',
                    data: [22, 24, 27, 23, 25, 28],
                    fill: false,
                    borderColor: '#1d4ed8',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true
            }
        });

        // Mobile sidebar toggle
        document.getElementById('sidebar-toggle').addEventListener('click', function () {
            const sidebar = document.querySelector('aside');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('fixed');
            sidebar.classList.toggle('z-50');
            sidebar.classList.toggle('inset-0');
        });
    </script>
</body>

</html>
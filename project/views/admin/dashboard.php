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
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center">
                        <button class="text-gray-600 md:hidden" id="sidebar-toggle">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="ml-4 text-xl font-semibold text-gray-800">Tableau de bord</h1>
                    </div>
                    <div class="flex items-center">
                        <div class="relative">
                            <button class="flex items-center focus:outline-none">
                                <img class="h-8 w-8 rounded-full object-cover" src="/api/placeholder/32/32" alt="Avatar">
                                <span class="ml-2 text-gray-700">Admin User</span>
                                <i class="fas fa-chevron-down ml-2 text-gray-500"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-y-auto p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <!-- Stat Card 1 -->
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-700">
                                <i class="fas fa-store text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Points de vente</p>
                                <p class="text-2xl font-semibold text-gray-800">24</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stat Card 2 -->
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-chart-line text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Points rentables</p>
                                <p class="text-2xl font-semibold text-gray-800">18</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stat Card 3 -->
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <i class="fas fa-exclamation-triangle text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Points non rentables</p>
                                <p class="text-2xl font-semibold text-gray-800">6</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stat Card 4 -->
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Utilisateurs</p>
                                <p class="text-2xl font-semibold text-gray-800">42</p>
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
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.querySelector('aside');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('fixed');
            sidebar.classList.toggle('z-50');
            sidebar.classList.toggle('inset-0');
        });
    </script>
</body>
</html>
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
                <h2 class="text-2xl font-bold text-center">StoreFlow</h2>
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
                        <a href="/admin/merchandising" class="flex items-center">
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
                        <a href="/admin/rapports" class="flex items-center">
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
                <a href="/logout" class="flex items-center text-white hover:text-gray-200">
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
                                    <?php
                                    $fullName = $data['user']->getFullName();
                                    $parts = explode(' ', trim($fullName));
                                    $initials = '';

                                    if (count($parts) > 0) {
                                        $initials .= strtoupper(substr($parts[0], 0, 1)); 
                                        if (count($parts) > 1) {
                                            $initials .= strtoupper(substr(end($parts), 0, 1));
                                        }
                                    }
                                    ?>
                                    <span
                                        class="font-medium"><?= $initials ?></span>
                                </div>
                                <span
                                    class="hidden md:block ml-2 font-medium"><?php echo $data['user']->getFullName() ?></span>
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
                            <p class="text-blue-100 text-sm">CA Actuelle</p>
                            <p class="text-2xl font-bold mt-1"><?php echo $data['statistecs']['total_chiffre_daffaire'] ?> DH</p>
                            <div class="flex items-center mt-1">
                                <span class="text-green-300 text-xs"><i class="fas fa-arrow-up mr-1"></i>12%</span>
                                <span class="text-blue-200 text-xs ml-1">vs mois précédent</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-blue-100 text-sm">Les charge</p>
                            <p class="text-2xl font-bold mt-1"><?php echo $data['statistecs']['total_expenses'] ?> DH</p>
                            <div class="flex items-center mt-1">
                                <span class="text-green-300 text-xs"><i class="fas fa-arrow-up mr-1"></i>7%</span>
                                <span class="text-blue-200 text-xs ml-1">vs mois précédent</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-blue-100 text-sm">La Rentabilite</p>
                            <p class="text-2xl font-bold mt-1"><?php echo $data['statistecs']['total_rentability'] ?> DH</p>
                            <div class="flex items-center mt-1">
                                <span class="text-green-300 text-xs"><i class="fas fa-arrow-up mr-1"></i>3%</span>
                                <span class="text-blue-200 text-xs ml-1">vs mois précédent</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-blue-100 text-sm">Magasin le plus performant</p>
                            <p class="text-xl font-bold mt-1"><?php echo $data['statistecs']['most_rentable_store'] ?></p>
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

            </main>
        </div>
    </div>

    <script src="../../public/assets/js/admin.js"></script>
</body>

</html>
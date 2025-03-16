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
                <li class="px-4 py-2 hover:bg-blue-800 bg-blue-800">
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
                    <h1 class="text-2xl font-bold text-blue-700">Calculs Merchandising</h1>
                </div>
                <div class="flex items-center space-x-4">
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

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-4 bg-gray-50">
            <div class="max-w-6xl mx-auto">
                <!-- Main Calculator Card -->
                <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        <i class="fas fa-store-alt mr-2 text-blue-600"></i>Analyse de rentabilité potential d'un point
                        de vente
                    </h2>
                    <div class="w-full mb-4">
                        <select name="stores" id="" class=" block w-full pl-3 pr-12 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 font-medium">
                            <option value="">Les point de vente En attente</option>
                            <?php if (isset($data)): ?>
                                <?php foreach ($data as $store): ?>
                                    <?php var_dump($store); ?>
                                    <option value="<?php echo $store->getId() ?>"><?php echo $store->getName() ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <p class="text-gray-600 mb-6">
                        Cet outil vous permet d'évaluer la rentabilité potentielle d'un point de vente en fonction des
                        données démographiques et économiques de la zone d'implantation.
                    </p>

                    <!-- Progress Steps -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex-1">
                            <div class="h-2 bg-blue-600 rounded-l-full"></div>
                            <p class="text-sm font-medium text-blue-600 mt-1">Données démographiques</p>
                        </div>
                        <div class="flex-1">
                            <div class="h-2 bg-blue-400 rounded-none"></div>
                            <p class="text-sm font-medium text-gray-400 mt-1">Consommation</p>
                        </div>
                        <div class="flex-1">
                            <div class="h-2 bg-blue-300 rounded-none"></div>
                            <p class="text-sm font-medium text-gray-400 mt-1">CA potentiel zone</p>
                        </div>
                        <div class="flex-1">
                            <div class="h-2 bg-gray-200 rounded-r-full"></div>
                            <p class="text-sm font-medium text-gray-400 mt-1">CA potentiel PDV</p>
                        </div>
                    </div>

                    <!-- Step 1: Données démographiques -->
                    <div id="step1" class="mb-8">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Étape 1: Données démographiques</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Nombre total de personnes dans la zone
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" id="population" name="population"
                                        class="block w-full pl-3 pr-12 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="0">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">pers.</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Nombre moyen de personnes par ménage
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" id="avgPersonsPerHousehold" name="avgPersonsPerHousehold"
                                        class="block w-full pl-3 pr-12 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="0" step="0.1" value="2.2">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">pers./ménage</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-medium text-gray-700">Nombre de ménages calculé:</p>
                                <p id="householdsResult" class="text-lg font-semibold text-blue-700">0</p>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button id="nextToStep2"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm transition-colors duration-200">
                                Continuer <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Consommation moyenne -->
                    <div id="step2" class="hidden mb-8">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Étape 2: Données de consommation</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Consommation annuelle moyenne d'un ménage en France
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">€</span>
                                    </div>
                                    <input type="number" id="avgConsumption" name="avgConsumption"
                                        class="block w-full pl-7 pr-12 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="0" value="34300">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">/an</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Indice de consommation (IDC) de la région
                                    <span class="text-xs text-gray-500 ml-1">(100 = moyenne nationale)</span>
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" id="consumptionIndex" name="consumptionIndex"
                                        class="block w-full pl-3 pr-12 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="100" value="100" step="1">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">IDC</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-medium text-gray-700">Dépense moyenne par foyer:</p>
                                <p id="avgSpendingResult" class="text-lg font-semibold text-blue-700">0 €</p>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <button id="backToStep1"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-md shadow-sm transition-colors duration-200">
                                <i class="fas fa-arrow-left mr-2"></i> Retour
                            </button>
                            <button id="nextToStep3"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm transition-colors duration-200">
                                Continuer <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: CA potentiel de la zone -->
                    <div id="step3" class="hidden mb-8">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Étape 3: Calcul du CA potentiel de la zone
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Taux d'évasion commerciale
                                    <span class="text-xs text-gray-500 ml-1">(clients quittant la zone)</span>
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" id="evasionRate" name="evasionRate"
                                        class="block w-full pl-3 pr-12 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="0" value="10" min="0" max="100" step="1">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">%</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Taux d'invasion commerciale
                                    <span class="text-xs text-gray-500 ml-1">(clients venant d'autres zones)</span>
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" id="invasionRate" name="invasionRate"
                                        class="block w-full pl-3 pr-12 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="0" value="5" min="0" max="100" step="1">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <div class="flex flex-col space-y-2">
                                <div class="flex justify-between items-center">
                                    <p class="text-sm font-medium text-gray-700">Nombre de ménages:</p>
                                    <p id="householdsSummary" class="text-md font-medium text-gray-700">0</p>
                                </div>
                                <div class="flex justify-between items-center">
                                    <p class="text-sm font-medium text-gray-700">Dépense moyenne par foyer:</p>
                                    <p id="avgSpendingSummary" class="text-md font-medium text-gray-700">0 €</p>
                                </div>
                                <div class="flex justify-between items-center">
                                    <p class="text-sm font-medium text-gray-700">CA total théorique (avant
                                        évasion/invasion):</p>
                                    <p id="theoreticalRevenue" class="text-md font-medium text-gray-700">0 €</p>
                                </div>
                                <div class="flex justify-between items-center border-t border-gray-200 pt-2 mt-2">
                                    <p class="text-sm font-bold text-gray-700">CA potentiel de la zone:</p>
                                    <p id="potentialZoneRevenue" class="text-lg font-semibold text-blue-700">0 €</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <button id="backToStep2"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-md shadow-sm transition-colors duration-200">
                                <i class="fas fa-arrow-left mr-2"></i> Retour
                            </button>
                            <button id="nextToStep4"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm transition-colors duration-200">
                                Continuer <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 4: CA potentiel du point de vente -->
                    <div id="step4" class="hidden mb-8">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Étape 4: Calcul du CA potentiel du point de
                            vente</h3>
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Nombre de concurrents dans la zone
                                </label>
                                <input type="number" id="competitors" name="competitors"
                                    class="block w-full pl-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="0" value="2" min="0" step="1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Estimation du CA des concurrents
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">€</span>
                                    </div>
                                    <input type="number" id="competitorsRevenue" name="competitorsRevenue"
                                        class="block w-full pl-7 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="0" value="0">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Part de marché visée
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" id="marketShare" name="marketShare"
                                        class="block w-full pl-3 pr-12 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="0" value="15" min="0" max="100" step="1">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <div class="flex flex-col space-y-2">
                                <div class="flex justify-between items-center">
                                    <p class="text-sm font-medium text-gray-700">CA potentiel de la zone:</p>
                                    <p id="zonePotentialSummary" class="text-md font-medium text-gray-700">0 €</p>
                                </div>
                                <div class="flex justify-between items-center">
                                    <p class="text-sm font-medium text-gray-700">CA estimé des concurrents:</p>
                                    <p id="competitorsRevenueSummary" class="text-md font-medium text-gray-700">0 €</p>
                                </div>
                                <div class="flex justify-between items-center border-t border-gray-200 pt-2 mt-2">
                                    <p class="text-sm font-bold text-gray-700">CA potentiel du point de vente:</p>
                                    <p id="potentialStoreRevenue" class="text-lg font-semibold text-blue-700">0 €</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <div class="bg-white p-4 rounded-lg border mb-4">
                                <h4 class="font-medium text-gray-800 mb-2">Indicateur de rentabilité</h4>
                                <div class="flex items-center space-x-4">
                                    <div class="w-full bg-gray-200 rounded-full h-4">
                                        <div id="profitabilityIndicator" class="h-4 rounded-full bg-green-500"
                                            style="width: 70%"></div>
                                    </div>
                                    <span id="profitabilityPercentage" class="text-lg font-semibold">70%</span>
                                </div>
                                <div class="mt-2">
                                    <p id="profitabilityMessage" class="text-sm font-medium text-gray-700">
                                        <i class="fas fa-check-circle text-green-500 mr-1"></i>
                                        Ce point de vente semble avoir un bon potentiel de rentabilité.
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-between">
                                <button id="backToStep3"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-md shadow-sm transition-colors duration-200">
                                    <i class="fas fa-arrow-left mr-2"></i> Retour
                                </button>
                                <button id="generateReportBtn"
                                    class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md shadow-sm transition-colors duration-200">
                                    <i class="fas fa-file-pdf mr-2"></i> Générer un rapport
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </main>
    </div>

    <script>

        // Navigation between steps
        document.getElementById('nextToStep2').addEventListener('click', function () {
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
            updateProgressBar(2);
            calculateHouseholds();
        });

        document.getElementById('backToStep1').addEventListener('click', function () {
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step1').classList.remove('hidden');
            updateProgressBar(1);
        });

        document.getElementById('nextToStep3').addEventListener('click', function () {
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step3').classList.remove('hidden');
            updateProgressBar(3);
            calculateAverageSpending();
            updateZoneSummary();
        });

        document.getElementById('backToStep2').addEventListener('click', function () {
            document.getElementById('step3').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
            updateProgressBar(2);
        });

        document.getElementById('nextToStep4').addEventListener('click', function () {
            document.getElementById('step3').classList.add('hidden');
            document.getElementById('step4').classList.remove('hidden');
            updateProgressBar(4);
            calculatePotentialRevenue();
            updateStoreSummary();
        });

        document.getElementById('backToStep3').addEventListener('click', function () {
            document.getElementById('step4').classList.add('hidden');
            document.getElementById('step3').classList.remove('hidden');
            updateProgressBar(3);
        });

        // Function to update progress bar
        function updateProgressBar(step) {
            const texts = document.querySelectorAll('.flex-1 .text-sm');

            texts.forEach((text, index) => {
                if (index < step) {
                    text.classList.remove('text-gray-400', 'text-blue-300', 'text-blue-400');
                    text.classList.add('text-blue-600');
                } else if (index === step) {
                    text.classList.remove('text-gray-400', 'text-blue-300', 'text-blue-600');
                    text.classList.add('text-blue-400');
                } else if (index === step + 1) {
                    text.classList.remove('text-gray-400', 'text-blue-400', 'text-blue-600');
                    text.classList.add('text-blue-300');
                } else {
                    text.classList.remove('text-blue-600', 'text-blue-400', 'text-blue-300');
                    text.classList.add('text-gray-400');
                }
            });
        }

        // Calculate number of households
        function calculateHouseholds() {
            const population = document.getElementById('population').value;
            const avgPersonsPerHousehold = document.getElementById('avgPersonsPerHousehold').value;

            const households = Math.round(parseFloat(population) / parseFloat(avgPersonsPerHousehold));

            // Update the result display
            document.getElementById('householdsResult').textContent = households.toLocaleString();

            return households;
        }

        // Calculate average spending per household
        function calculateAverageSpending() {
            const avgConsumption = parseFloat(document.getElementById('avgConsumption').value) || 34300;
            const consumptionIndex = parseFloat(document.getElementById('consumptionIndex').value) || 100;

            // Calculate average spending with regional index adjustment
            const avgSpending = avgConsumption * (consumptionIndex / 100);

            // Update the result display
            document.getElementById('avgSpendingResult').textContent = avgSpending.toLocaleString() + ' €';

            return avgSpending;
        }

        // Update zone summary and calculate potential zone revenue
        function updateZoneSummary() {
            const households = calculateHouseholds();
            const avgSpending = calculateAverageSpending();
            const evasionRate = parseFloat(document.getElementById('evasionRate').value) || 10;
            const invasionRate = parseFloat(document.getElementById('invasionRate').value) || 5;

            // Calculate theoretical revenue (before evasion/invasion)
            const theoreticalRevenue = households * avgSpending;

            // Calculate revenue adjustment due to evasion (loss) and invasion (gain)
            const evasionAdjustment = theoreticalRevenue * (evasionRate / 100);
            const invasionAdjustment = theoreticalRevenue * (invasionRate / 100);

            // Calculate potential zone revenue
            const potentialZoneRevenue = theoreticalRevenue - evasionAdjustment + invasionAdjustment;

            // Update summary displays
            document.getElementById('householdsSummary').textContent = households.toLocaleString();
            document.getElementById('avgSpendingSummary').textContent = avgSpending.toLocaleString() + ' €';
            document.getElementById('theoreticalRevenue').textContent = theoreticalRevenue.toLocaleString() + ' €';
            document.getElementById('potentialZoneRevenue').textContent = potentialZoneRevenue.toLocaleString() + ' €';

            return potentialZoneRevenue;
        }

        // Calculate potential store revenue and update store summary
        function calculatePotentialRevenue() {
            const zoneRevenue = updateZoneSummary();
            const competitors = parseInt(document.getElementById('competitors').value) || 0;
            const competitorsRevenue = parseFloat(document.getElementById('competitorsRevenue').value) || 0;
            const marketShare = parseFloat(document.getElementById('marketShare').value) || 15;

            // Calculate potential store revenue based on market share
            let availableMarket = zoneRevenue - competitorsRevenue;
            if (availableMarket < 0) availableMarket = 0;

            const potentialStoreRevenue = (availableMarket * (marketShare / 100));

            // Update summary displays
            document.getElementById('zonePotentialSummary').textContent = zoneRevenue.toLocaleString() + ' €';
            document.getElementById('competitorsRevenueSummary').textContent = competitorsRevenue.toLocaleString() + ' €';
            document.getElementById('potentialStoreRevenue').textContent = potentialStoreRevenue.toLocaleString() + ' €';

            // Update profitability indicator
            updateProfitabilityIndicator(potentialStoreRevenue, zoneRevenue);

            return potentialStoreRevenue;
        }

        // Update the profitability indicator
        function updateProfitabilityIndicator(storeRevenue, zoneRevenue) {
            // Calculate profitability percentage (simple version)
            // This is just a demo calculation - in real life this would be more complex
            const profitabilityThreshold = 500000; // Example threshold
            let profitability = (storeRevenue / profitabilityThreshold) * 100;

            // Cap at 100%
            if (profitability > 100) profitability = 100;

            // Update the indicator
            const indicator = document.getElementById('profitabilityIndicator');
            const percentage = document.getElementById('profitabilityPercentage');
            const message = document.getElementById('profitabilityMessage');

            indicator.style.width = profitability + '%';
            percentage.textContent = Math.round(profitability) + '%';

            // Set color and message based on profitability level
            if (profitability < 30) {
                indicator.classList.remove('bg-green-500', 'bg-yellow-500');
                indicator.classList.add('bg-red-500');
                message.innerHTML = '<i class="fas fa-exclamation-circle text-red-500 mr-1"></i> Ce point de vente présente un risque élevé de non-rentabilité.';
            } else if (profitability < 60) {
                indicator.classList.remove('bg-green-500', 'bg-red-500');
                indicator.classList.add('bg-yellow-500');
                message.innerHTML = '<i class="fas fa-exclamation-triangle text-yellow-500 mr-1"></i> Ce point de vente présente un potentiel moyen. Une analyse supplémentaire est recommandée.';
            } else {
                indicator.classList.remove('bg-yellow-500', 'bg-red-500');
                indicator.classList.add('bg-green-500');
                message.innerHTML = '<i class="fas fa-check-circle text-green-500 mr-1"></i> Ce point de vente semble avoir un bon potentiel de rentabilité.';
            }
        }

        // Generate PDF report
        document.getElementById('generateReportBtn').addEventListener('click', function () {
            alert('Génération du rapport PDF en cours... Cette fonctionnalité sera disponible prochainement.');
        });

        // Add input event listeners to update calculations in real-time
        document.getElementById('population').addEventListener('input', calculateHouseholds);
        document.getElementById('avgPersonsPerHousehold').addEventListener('input', calculateHouseholds);
        document.getElementById('avgConsumption').addEventListener('input', calculateAverageSpending);
        document.getElementById('consumptionIndex').addEventListener('input', calculateAverageSpending);
        document.getElementById('evasionRate').addEventListener('input', updateZoneSummary);
        document.getElementById('invasionRate').addEventListener('input', updateZoneSummary);
        document.getElementById('competitors').addEventListener('input', calculatePotentialRevenue);
        document.getElementById('competitorsRevenue').addEventListener('input', calculatePotentialRevenue);
        document.getElementById('marketShare').addEventListener('input', calculatePotentialRevenue);
    </script>
</body>

</html>
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
            <a href="/logout" class="flex items-center text-white hover:text-gray-200">
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
                            <a 
                                class="inline-block p-4 rounded-t-lg border-b-2 border-blue-600 text-blue-600 active"
                                id="merchandising-tab" onclick="showTab('merchandising')">
                                Rapports Merchandising
                            </a>
                        </li>
                        <li class="mr-2">
                            <a 
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
                                    <?php if (isset($data['merchandising'])): ?>
                                        <?php foreach ($data['merchandising'] as $merchandising): ?>
                                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="font-medium text-gray-900">
                                                        <?php echo $merchandising->getStoreName(); ?>
                                                    </div>
                                                    <div class="text-xs text-gray-500">ID:
                                                        <?php echo $merchandising->getStoreId(); ?>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                                    <?php echo number_format($merchandising->getZonePopulation()); ?>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                                    <span
                                                        class="font-medium"><?php echo '€' . number_format($merchandising->getAvgAnnualSpending()); ?></span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                                    <span
                                                        class="font-medium"><?php echo '€' . number_format($merchandising->getCompetitorRevenue()); ?></span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                                    <span
                                                        class="font-medium"><?php echo '€' . number_format($merchandising->getCAPotentielStore()); ?></span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <span
                                                            class="mr-2 text-green-600 font-semibold"><?php echo number_format($merchandising->getResultFrot(), 2) . '%' ?></span>
                                                        <div class="w-16 h-2 bg-gray-200 rounded-full">
                                                            <?php
                                                            $bg = (number_format($merchandising->getResultFrot(), 2) < 30)
                                                                ? 'bg-red-500'
                                                                : (number_format($merchandising->getResultFrot(), 2) < 60
                                                                    ? 'bg-orange-500'
                                                                    : 'bg-green-500');
                                                            ?>
                                                            <div class="h-2 <?php echo $bg; ?>  rounded-full"
                                                                style="width: <?php echo number_format($merchandising->getResultFrot(), 2) . '%' ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <div class="flex space-x-3">
                                                        <a href="/admin/rapports/pdf/<?php echo $merchandising->getId(); ?>"
                                                            class="text-blue-600 hover:text-blue-900 transition-colors duration-150">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                        <a href="/admin/rapports/delete/<?php echo $merchandising->getId(); ?>"
                                                            class="text-red-600 hover:text-red-900 transition-colors duration-150">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

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
                                    <?php if (isset($data['employee'])): ?>
                                        <?php foreach ($data['employee'] as $employee): ?>
                                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="h-10 w-10 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-sm">
                                                            <span
                                                                class="font-medium"><?php echo strtoupper(substr($employee->getUserName(), 0, 2)); ?></span>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                <?php echo $employee->getUserName() ?>
                                                            </div>
                                                            <div class="text-xs text-gray-500">
                                                                <?php echo $employee->getUserEmail() ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span
                                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        <?php echo $employee->getReportType() ?>
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <?php echo $employee->getSubject() ?>
                                                    </div>
                                                    <div class="text-xs text-gray-500">Créé le
                                                        <?php echo $employee->getGeneratedAt() ?>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-700 max-w-xs">
                                                    <div class="line-clamp-2">
                                                        <?php echo $employee->getMessage() ?>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <div class="flex space-x-3">
                                                        <button
                                                            class="text-blue-600 hover:text-blue-900 transition-colors duration-150"
                                                            onclick="openReportModal(<?php echo $employee->getReportId() ?>)">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <a href="/admin/rapports/user/delete/<?php echo $employee->getReportId() ?>"
                                                            class="text-red-600 hover:text-red-900 transition-colors duration-150">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>


    <!-- Report View Modal -->
    <div id="reportViewModal"
        class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl w-full max-w-2xl mx-4 overflow-hidden shadow-xl">
            <div class="px-6 py-4 bg-blue-700 text-white flex justify-between items-center">
                <h3 class="text-xl font-bold" id="modalTitle">Détails du rapport</h3>
                <button id="closeViewBtn" class="text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6">
                <div class="mb-6">
                    <h2 id="reportSubject" class="text-xl font-bold text-gray-800 mb-2"></h2>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <span id="reportDate" class="mr-4"><i class="far fa-calendar-alt mr-1"></i> Date: </span>
                        <span id="reportAuthor"><i class="far fa-user mr-1"></i> </span>
                    </div>
                    <div class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium mb-4"
                        id="reportType"></div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Contenu du rapport</h3>
                    <div id="reportContent"
                        class="bg-gray-50 p-4 rounded-lg border border-gray-200 text-gray-700 whitespace-pre-line">
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 mt-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">ID du rapport: <span id="reportId"
                                    class="font-medium text-gray-800"></span></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 text-right">Généré le: <span id="reportGeneratedAt"
                                    class="font-medium text-gray-800"></span></p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="button" id="closeBtn"
                        class="mr-2 px-4 py-2 bg-blue-200 text-gray-800 rounded-lg hover:bg-gray-300">Fermer</button>
                </div>
            </div>
        </div>
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

        function showReportDetails(report) {
            document.getElementById('reportId').textContent = report.report_id;
            document.getElementById('reportSubject').textContent = report.subject;
            document.getElementById('reportContent').textContent = report.message;
            document.getElementById('reportAuthor').textContent = `Auteur: ${report.first_name} ${report.last_name}`;

            let reportTypeText = '';
            switch (report.report_type) {
                case 'profitability':
                    reportTypeText = 'Analyse de rentabilité';
                    break;
                case 'competitor_analysis':
                    reportTypeText = 'Analyse des concurrents';
                    break;
                case 'sales_performance':
                    reportTypeText = 'Performance des ventes';
                    break;
            }
            document.getElementById('reportType').textContent = reportTypeText;

            const date = new Date(report.generated_at);
            const formattedDate = date.toLocaleDateString('fr-FR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });

            document.getElementById('reportDate').innerHTML = '<i class="far fa-calendar-alt mr-1"></i> Date: ' + formattedDate;
            document.getElementById('reportGeneratedAt').textContent = formattedDate;

            document.getElementById('reportViewModal').classList.remove('hidden');
        }

        document.getElementById('closeViewBtn').addEventListener('click', function () {
            document.getElementById('reportViewModal').classList.add('hidden');
        });

        document.getElementById('closeBtn').addEventListener('click', function () {
            document.getElementById('reportViewModal').classList.add('hidden');
        });

        async function openReportModal(reportId) {
            try {
                const response = await fetch(`/admin/rapport/${reportId}`, {
                    method: 'GET',
                });

                if (!response.ok) {
                    throw new Error('Failed to fetch report data');
                }
                const report = await response.json();
                console.log(report)
                showReportDetails(report[0])
                return report[0];
            } catch (error) {
                console.error('Error fetching report data:', error);
            }
        }
    </script>

</body>

</html>
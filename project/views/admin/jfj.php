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










        <!-- La page "Calcul Merchandising" de votre tableau de bord sera conçue pour permettre aux utilisateurs d’évaluer la rentabilité potentielle d’un point de vente en fonction de données démographiques et économiques. Elle comportera une interface claire et intuitive, divisée en plusieurs sections interactives. Tout d'abord, l'utilisateur saisira les données de base telles que le nombre total de personnes dans la zone étudiée et le nombre moyen de personnes par ménage. Une fois ces informations fournies, le système calculera automatiquement le nombre de ménages. Ensuite, l'utilisateur entrera la consommation annuelle moyenne d'un ménage en France et l’indice de consommation (IDC) spécifique à la région, permettant ainsi de déterminer la dépense moyenne par foyer. Une troisième section effectuera le calcul du Chiffre d'Affaires (CA) potentiel de la zone, en prenant en compte les ménages, leur dépense moyenne, ainsi que les flux d’invasion (clients venant d’autres zones) et d’évasion (clients quittant la zone pour acheter ailleurs). Enfin, la dernière étape consistera à estimer le CA potentiel du point de vente, en soustrayant le chiffre d'affaires estimé des concurrents présents dans la zone. Un indicateur de rentabilité visuel (graphique ou code couleur) affichera si l’ouverture du magasin est viable ou risquée, accompagnée d’une suggestion stratégique basée sur les résultats. Cette page sera donc un outil puissant pour la prise de décision des gestionnaires de points de vente. -->









       
    </div>
</body>
</html>



           
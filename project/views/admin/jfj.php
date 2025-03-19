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










        <!--  La page "Rapports" qui represente la list des rappore de calcule merchandising et un list des rapport des employer    -->
   
 <!--    CREATE TABLE IF NOT EXISTS merchandising_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    store_id INT NOT NULL,                      -- معرف المتجر
    zone_population INT,                        -- عدد السكان في المنطقة
    avg_household_size DECIMAL(3, 1),           -- متوسط عدد الأفراد في كل أسرة
    nombre_menages DECIMAL(10, 2),              -- عدد الأسر في المنطقة
    avg_annual_spending DECIMAL(10, 2),         -- متوسط الإنفاق السنوي لكل أسرة
    regional_wealth_index DECIMAL(5, 2),        -- مؤشر الثروة الإقليمي
    invasion DECIMAL(15, 2),                    -- الإنفاق من غير المقيمين في المنطقة
    evasion DECIMAL(15, 2),                     -- الإنفاق خارج المنطقة من المقيمين
    CA_potentiel_zone DECIMAL(15, 2),           -- الإيرادات المحتملة للمنطقة
    competitor_revenue DECIMAL(15, 2),          -- إيرادات المنافسين
    CA_potentiel_store DECIMAL(15, 2),          -- الإيرادات المحتملة للمتجر
    result_frot DECIMAL(10,2) NOT NULL DEFAULT 0,
    analysis_date  CURRENT_DATE,
    FOREIGN KEY (store_id) REFERENCES stores(store_id)  -- Foreign key constraint
); in merchandising_data list i want just show store name, zone_population, CA_potentiel_zone, CA_potentiel_store, competitor_revenue,  result_frot. actions(generate/delete)  -->

<!--      
CREATE TABLE IF NOT EXISTS reports (
    report_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each report
    user_id INT NOT NULL,  -- Foreign key referencing the users table
    message TEXT NOT NULL,  -- The content of the report
    report_type ENUM('profitability', 'competitor_analysis', 'sales_performance') NOT NULL,  -- Enum for report type
    generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Timestamp when the report was generated
    subject VARCHAR(255) NOT NULL,  -- The subject of the report
    FOREIGN KEY (user_id) REFERENCES users(id)  -- Foreign key constraint
);  in reports list i want just show user name, report_type, message, subject. actions(generate/delete)  -->







       
    </div>
</body>
</html>



           
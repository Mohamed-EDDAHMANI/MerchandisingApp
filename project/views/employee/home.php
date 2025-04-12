<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de Bord des Ventes</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f9fafb;
    }

    .gradient-bg {
      background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
    }

    .card-hover:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .objectives-container {
      max-height: 300px;
      overflow-y: auto;
    }

    .objectives-container::-webkit-scrollbar {
      width: 6px;
    }

    .objectives-container::-webkit-scrollbar-track {
      background: #f1f5f9;
      border-radius: 10px;
    }

    .objectives-container::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 10px;
    }

    .objectives-container::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }

    .sale-form-container {
      min-height: 500px;
    }

    .pending-sales-container {
      max-height: 200px;
      overflow-y: auto;
    }

    .pending-sales-container::-webkit-scrollbar {
      width: 6px;
    }

    .pending-sales-container::-webkit-scrollbar-track {
      background: #f1f5f9;
      border-radius: 10px;
    }

    .pending-sales-container::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 10px;
    }

    .pending-sales-container::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
  </style>
</head>

<body class="bg-gray-50">
  <div class="min-h-screen">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg hidden lg:block">
      <div class="gradient-bg p-4">
        <h2 class="text-white text-xl font-bold">Tableau de Bord</h2>
      </div>
      <div class="p-4">
        <div class="flex items-center space-x-3 mb-6 p-2 bg-blue-50 rounded-lg">
          <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-900">Ahmed</p>
            <p class="text-xs text-gray-500">Représentant Commercial</p>
          </div>
        </div>
        <nav class="space-y-1">
          <a href="#" class="flex items-center px-2 py-3 text-sm font-medium rounded-md bg-blue-50 text-blue-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-blue-500" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Tableau de Bord
          </a>
          <a href="#"
            class="flex items-center px-2 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            Rapports
          </a>
          <a href="#"
            class="flex items-center px-2 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Ventes
          </a>
        </nav>
      </div>
    </div>

    <!-- Main Content -->
    <div class="lg:pl-64">
      <!-- Top Navigation -->
      <div class="bg-white shadow-sm sticky top-0 z-10">
        <div class="flex items-center justify-between h-16 px-4 md:px-8">
          <div class="flex items-center lg:hidden">
            <button type="button" class="text-gray-500 hover:text-gray-600 focus:outline-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
          </div>
          <div class="flex-1 flex justify-center lg:justify-end">
            <div class="max-w-lg w-full lg:max-w-xs">
              <label for="search" class="sr-only">Rechercher</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
                </div>
                <input id="search"
                  class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-md leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                  placeholder="Rechercher des produits..." type="search">
              </div>
            </div>
          </div>
          <div class="flex items-center">
            <button type="button" class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <main class="px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <div>
              <h1 class="text-2xl font-bold text-gray-900">Bienvenue, Ahmed!</h1>
              <p class="text-gray-600 mt-1">Lundi, 8 Avril 2025</p>
            </div>
            <div>
              <button id="reportBtn"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white gradient-bg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Générer un Rapport
              </button>
            </div>
          </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <div class="bg-white rounded-xl shadow-sm p-6 transition-all duration-200 card-hover border border-gray-100">
            <div class="flex items-center">
              <div class="flex-shrink-0 h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Ventes Totales</h3>
                <p class="text-2xl font-semibold text-gray-900" id="totalSales">5 800 MAD</p>
                <p class="text-sm text-green-600 flex items-center mt-1">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 10l7-7m0 0l7 7m-7-7v18" />
                  </svg>
                  12% par rapport à la semaine dernière
                </p>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-xl shadow-sm p-6 transition-all duration-200 card-hover border border-gray-100">
            <div class="flex items-center">
              <div class="flex-shrink-0 h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
              </div>
              <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Produits Vendus</h3>
                <p class="text-2xl font-semibold text-gray-900" id="productCount">24</p>
                <p class="text-sm text-green-600 flex items-center mt-1">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 10l7-7m0 0l7 7m-7-7v18" />
                  </svg>
                  8% par rapport à la semaine dernière
                </p>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-xl shadow-sm p-6 transition-all duration-200 card-hover border border-gray-100">
            <div class="flex items-center">
              <div class="flex-shrink-0 h-12 w-12 rounded-full bg-emerald-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
              </div>
              <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Progression Objectif</h3>
                <p class="text-2xl font-semibold text-gray-900">80%</p>
                <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                  <div id="progressBar" class="bg-emerald-500 h-2 rounded-full" style="width: 80%"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <!-- Sales Form - Expanded -->
          <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 sale-form-container">
            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Ajouter une Nouvelle Vente
            </h2>
            <form id="saleForm" class="space-y-4">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="relative">
                  <label for="productName" class="block text-sm font-medium text-gray-700 mb-1">Sélectionner un
                    Produit</label>
                  <input type="text" id="productName"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white cursor-pointer"
                    placeholder="Cliquez pour sélectionner un produit">
                  <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400 mt-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                    </svg>
                  </div>
                  <select id="product"
                    class="w-full absolute left-0 top-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white z-20 hidden">
                    <option value="">-- Sélectionner un produit --</option>
                    <?php if (isset($data['products'])): ?>
                      <?php foreach ($data['products'] as $value): ?>
                        <option value="<?php echo $value->getProductId() ?>">
                          <?php echo $value->getProductName() ?>
                        </option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                    <option value="1" data-price="550.00">Smartphone X1</option>
                    <option value="2" data-price="899.99">Ordinateur Portable Pro</option>
                    <option value="3" data-price="349.50">Écouteurs Sans Fil</option>
                    <option value="4" data-price="129.99">Montre Connectée</option>
                    <option value="5" data-price="79.50">Enceinte Bluetooth</option>
                  </select>
                  <p id="productError" class="text-red-500 text-xs mt-1 hidden">Veuillez sélectionner un produit</p>
                </div>
                <div>
                  <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantité</label>
                  <input type="number" id="quantity" min="1" value="1"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                  <p id="quantityError" class="text-red-500 text-xs mt-1 hidden">Veuillez entrer une quantité valide</p>
                </div>
              </div>
              <div>
                <label for="total" class="block text-sm font-medium text-gray-700 mb-1">Prix Total</label>
                <div class="relative">
                  <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">MAD</span>
                  <input type="text" id="total" readonly
                    class="w-full pl-12 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50">
                </div>
              </div>
              <button type="submit"
                class="w-full py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white gradient-bg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                Ajouter à la Liste
              </button>
            </form>

            <!-- Pending Sales List -->
            <div class="mt-6">
              <h3 class="text-md font-medium text-gray-900 mb-2">Ventes en Attente</h3>
              <div class="pending-sales-container border border-gray-200 rounded-lg">
                <table class="min-w-full divide-y divide-gray-200" id="pendingSalesTable">
                  <thead class="bg-gray-50">
                    <tr>
                      <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit
                      </th>
                      <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Quantité</th>
                      <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total
                      </th>
                      <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200" id="pendingSales">
                    <!-- Pending sales will be added here -->
                    <tr class="text-center text-gray-500 py-4">
                      <td colspan="4" class="py-4">Aucune vente en attente</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="mt-4 flex justify-between items-center">
                <div>
                  <span class="text-sm font-medium text-gray-700">Total: </span>
                  <span class="text-lg font-semibold text-gray-900" id="pendingTotal">0.00 MAD</span>
                </div>
                <button id="validateAllSales"
                  class="py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                  disabled>
                  Valider Toutes les Ventes
                </button>
              </div>
            </div>

            <div id="saleSuccess" class="mt-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded-lg hidden">
              <div class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <p class="text-sm font-medium">Ventes validées avec succès!</p>
              </div>
            </div>
          </div>

          <!-- Manager's Objectives Section -->
          <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 h-full ">
            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
              </svg>
              Objectifs du Manager
            </h2>
            <div class="objectives-container space-y-5 flex-grow overflow-y-auto">
              <!-- Weekly Sales Objective -->
              <?php if (isset($data['objectifs'])): ?>
                <?php foreach ($data['objectifs'] as $value): ?>
                  <?php if ($value->getFrequency() === 'weekly'): ?>
                    <div
                      class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-6 rounded-lg transition-all duration-300 hover:shadow-md">
                      <div class="flex items-center justify-between mb-2">
                        <h3 class="text-md font-medium text-gray-900">Objectif de Vente Hebdomadaire
                        </h3>
                        <?php if ($value->getPercentage() == 100): ?>
                          <span
                            class="px-3 py-1.5 text-xs font-medium rounded-full bg-green-100 text-green-800 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                              stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                          </span>
                        <?php else: ?>
                          <span class="px-3 py-1.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800">En Cours</span>
                        <?php endif; ?>

                      </div>
                      <p class="text-gray-700 mb-3">Vendre <?php echo $value->getTarget() ?>
                        <?php echo ($value->getType() === 'quantity_product') ? 'produits' : 'DH' ?>
                        cette semaine (Actuel: <span id="currentProgress"
                          class="font-semibold"><?php echo ($value->getType() === 'quantity_product') ? $value->getTotal_quantity_sold() . ' Unite' : $value->getTotal_sales_amount() . 'DH' ?>
                          / <?php echo $value->getTarget() ?></span>)
                      </p>
                      <div class="relative pt-1">
                        <div class="flex mb-2 items-center justify-between">
                          <div>
                            <span class="text-xs font-semibold inline-block text-blue-800">
                              <?php echo $value->getPercentage() ?>% Complété
                            </span>
                          </div>
                          <div class="text-right">
                            <span class="text-xs font-semibold inline-block text-blue-800">
                              Objectif: <?php echo $value->getTarget() ?>
                              <?php echo ($value->getType() === 'quantity_product') ? 'Unity' : 'DH' ?>
                            </span>
                          </div>
                        </div>
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-blue-200">
                          <div style="width: <?php echo $value->getPercentage() ?>%"
                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600 transition-all duration-500">
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php else: ?>
                    <div
                      class="bg-gradient-to-r from-amber-50 to-yellow-50 border-l-4 border-amber-500 p-6 rounded-lg transition-all duration-300 hover:shadow-md">
                      <div class="flex items-center justify-between mb-2">
                        <h3 class="text-md font-medium text-gray-900">Objectif de Vente Quotidien
                        </h3>
                        <span class="px-3 py-1.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800">En Cours</span>
                      </div>
                      <p class="text-gray-700 mb-3">Vendre <?php echo $value->getTarget() ?>
                        <?php echo ($value->getType() === 'quantity_product') ? 'produits' : 'DH' ?>
                        cette journe (Actuel: <span id="currentProgress"
                          class="font-semibold"><?php echo ($value->getType() === 'quantity_product') ? $value->getTotal_quantity_sold() . ' Unite' : $value->getTotal_sales_amount() . 'DH' ?>
                          / <?php echo $value->getTarget() ?></span>)
                      </p>
                      <div class="relative pt-1">
                        <div class="flex mb-2 items-center justify-between">
                          <div>
                            <span class="text-xs font-semibold inline-block text-blue-800">
                              <?php echo $value->getPercentage() ?>% Complété
                            </span>
                          </div>
                          <div class="text-right">
                            <span class="text-xs font-semibold inline-block text-blue-800">
                              Objectif: <?php echo $value->getTarget() ?>
                              <?php echo ($value->getType() === 'quantity_product') ? 'Unity' : 'DH' ?>
                            </span>
                          </div>
                        </div>
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-blue-200">
                          <div style="width: <?php echo $value->getPercentage() ?>%"
                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600 transition-all duration-500">
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Recent Sales History -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 mt-6">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
              </svg>
              Historique des Ventes Récentes
            </h2>
            <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-800">Voir Tout</a>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantité
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200" id="salesHistory">
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">8 Avr, 2025</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div
                        class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                      </div>
                      <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Smartphone X1</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1 100 MAD</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">7 Avr, 2025</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div
                        class="flex-shrink-0 h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                      </div>
                      <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Écouteurs Sans Fil</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1 048,50 MAD</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">7 Avr, 2025</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div
                        class="flex-shrink-0 h-8 w-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                        </svg>
                      </div>
                      <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Ordinateur Portable Pro</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">899,99 MAD</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Report Modal -->
  <div id="reportModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-xl w-full max-w-md mx-4 p-6 shadow-xl">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Générer un Rapport de Ventes</h3>
        <button id="closeModal" class="text-gray-500 hover:text-gray-700 focus:outline-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <form id="reportForm" method="POST" action="/employee/report/create">
        <div class="mb-4">
          <label for="reportType" class="block text-sm font-medium text-gray-700 mb-1">Type de Rapport</label>
          <select id="reportType" name="report_type"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="problem_report">Rapport de Problème</option>
            <option value="informational_report">Rapport Informatif</option>
          </select>
        </div>
        <div class="mb-4">
          <label for="reportSubject" class="block text-sm font-medium text-gray-700 mb-1">Sujet</label>
          <input type="text" id="reportSubject" name="subject"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Rapport de Ventes Hebdomadaire">
        </div>
        <div class="mb-6">
          <label for="reportMessage" class="block text-sm font-medium text-gray-700 mb-1">Message (Optionnel)</label>
          <textarea id="reportMessage" rows="4" name="message"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Ajoutez des notes ou commentaires pour ce rapport..."></textarea>
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" id="cancelReport"
            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">Annuler</button>
          <button type="submit"
            class="px-4 py-2 text-sm font-medium text-white gradient-bg hover:opacity-90 rounded-lg transition-colors duration-200">Envoyer
            à l'Admin</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Main Report Template (Hidden, used for PDF generation) -->
  <div id="reportTemplate" class="hidden">
    <div id="reportContent" class="p-8 max-w-2xl mx-auto bg-white">
      <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Rapport de Performance des Ventes</h1>
        <p class="text-gray-600" id="reportDate"></p>
      </div>
      <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2" id="reportSubjectDisplay"></h2>
        <p class="text-gray-600" id="reportMessageDisplay"></p>
      </div>
      <div class="mb-6">
        <h3 class="text-lg font-medium text-gray-800 mb-2">Résumé de Performance</h3>
        <p class="text-gray-700">Employé: <strong>Ahmed</strong></p>
        <p class="text-gray-700">Produits Vendus Cette Semaine: <strong><span id="reportProductCount">24</span></strong>
        </p>
        <p class="text-gray-700">Montant Total des Ventes: <strong><span id="reportTotalSales">5 800</span> MAD</strong>
        </p>
        <p class="text-gray-700">Progression Vers l'Objectif: <strong><span id="reportProgress">80</span>%</strong></p>
      </div>
      <div class="mb-6">
        <h3 class="text-lg font-medium text-gray-800 mb-2">Objectifs Actuels</h3>
        <p class="text-gray-700">Objectif de Vente Hebdomadaire: <strong>30 produits</strong></p>
        <p class="text-gray-700">Statut Actuel: <strong><span id="reportStatus">En Bonne Voie</span></strong></p>
      </div>
      <div>
        <h3 class="text-lg font-medium text-gray-800 mb-2">Ventes Récentes</h3>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200" id="reportSalesTable">
            <!-- Sales data will be populated here via JavaScript -->
          </tbody>
        </table>
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

  <script src="../../public/assets/js/employee.js"></script>
</body>

</html>
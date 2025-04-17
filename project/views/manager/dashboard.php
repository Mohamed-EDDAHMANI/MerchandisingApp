<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Manager Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body class="bg-gray-100 font-sans">

    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-blue-800 text-white shadow-lg z-10">
        <div class="flex items-center justify-center h-16 border-b border-blue-700">
            <h1 class="text-xl font-bold">Store Manager</h1>
        </div>
        <nav class="mt-5 sidebar">
            <a data-tab="#dashboard" class="flex items-center py-3 px-6 text-white hover:bg-blue-700 active-nav"
                onclick="switchTab('dashboard')">
                <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
            </a>
            <a data-tab="#categories" id="categoriesBtn"
                class="flex items-center py-3 px-6 text-white hover:bg-blue-700" onclick="switchTab('categories')">
                <i class="fas fa-tags mr-3"></i> Categories
            </a>
            <a data-tab="#products" id="productsBtn" class="flex items-center py-3 px-6 text-white hover:bg-blue-700"
                onclick="switchTab('products')">
                <i class="fas fa-box mr-3"></i> Products
            </a>
            <a data-tab="#suppliers" id="suppliersBtn" class="flex items-center py-3 px-6 text-white hover:bg-blue-700"
                onclick="switchTab('suppliers')">
                <i class="fas fa-truck mr-3"></i> Suppliers
            </a>
            <a data-tab="#orders" id="ordersBtn" class="flex items-center py-3 px-6 text-white hover:bg-blue-700"
                onclick="switchTab('orders')">
                <i class="fas fa-shopping-cart mr-3"></i> Orders
            </a>
            <a data-tab="#objectives" id="objectivesBtn"
                class="flex items-center py-3 px-6 text-white hover:bg-blue-700" onclick="switchTab('objectives')">
                <i class="fas fa-bullseye mr-3"></i> Objectifs
            </a>
            <a data-tab="#employees" class="flex items-center py-3 px-6 text-white hover:bg-blue-700"
                onclick="switchTab('employees')">
                <i class="fas fa-users mr-3"></i> Employees
            </a>
        </nav>
        <div class="absolute bottom-0 w-full border-t border-blue-700 p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center text-white font-bold text-lg uppercase mr-3"
                    style="background-color: <?php echo '#' . substr(md5($data['user']->getFullName()), 0, 6); ?>">
                    <?php echo substr($data['user']->getFullName(), 0, 1); ?>
                </div>
                <div>
                    <p class="font-semibold"><?php echo $data['user']->getFullName() ?></p>
                    <p class="text-sm text-blue-300">Store Manager</p>
                </div>
            </div>
            <div class="p-4 ">
                <a href="/logout" class="flex items-center text-white hover:text-gray-200">
                    <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                    <span>Déconnexion</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header -->

        <!-- Dashboard Tab -->
        <div id="dashboard" class="tab-content active">
            <header class="flex justify-between items-center mb-8">
                <div>
                    <h2 id="page-title" class="text-2xl font-bold text-gray-800">Dashboard</h2>
                    <p class="text-sm text-gray-600">Welcome back, <?php echo $data['user']->getFullName() ?></p>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                        onclick="showModal('orderModal')">
                        <i class="fas fa-plus mr-2"></i> New Order
                    </button>
                    <div class="relative">
                        <i class="fas fa-bell text-gray-500 text-xl cursor-pointer"></i>
                        <span
                            class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs">3</span>
                    </div>
                </div>
            </header>
            <!-- Stats cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Total Products</p>
                            <h3 class="text-2xl font-bold">
                                <?php echo $data['statistecs']['totalProductSales']['total_product_sales'] ?>
                            </h3>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-box text-blue-500"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-green-500 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> 12% from last month
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Total Sales</p>
                            <h3 class="text-2xl font-bold">
                                $<?php echo $data['statistecs']['totalProductSales']['total_montant_sales'] ?></h3>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-dollar-sign text-green-500"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-green-500 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> 18% from last month
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Pending Orders</p>
                            <h3 class="text-2xl font-bold"><?php echo $data['statistecs']['pandingOrder'] ?></h3>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <i class="fas fa-clock text-yellow-500"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-red-500 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> 2 more than yesterday
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Low Stock Items</p>
                            <h3 class="text-2xl font-bold"><?php echo $data['statistecs']['lowProductInStock'] ?></h3>
                        </div>
                        <div class="bg-red-100 p-3 rounded-full">
                            <i class="fas fa-exclamation-triangle text-red-500"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-red-500 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> 5 more than last week
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4">Sales Overview</h3>
                    <canvas id="salesChart" height="250"></canvas>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4">Category Distribution</h3>
                    <canvas id="categoryChart" height="250"></canvas>
                </div>
            </div>


            <!-- Top Selling Products -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Top Selling Products</h3>
                    <a href="#" class="text-blue-500 text-sm">View All Products</a>
                </div>
                <table class="w-full">
                    <thead class="">
                        <tr class="text-left text-gray-500 border-b">
                            <th class="pb-3">Product Name</th>
                            <th class="pb-3">Category</th>
                            <th class="pb-3">Stock</th>
                            <th class="pb-3">Price</th>
                            <th class="pb-3">Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($data['productsTopSales']) && !empty($data['productsTopSales'])): ?>
                            <?php foreach ($data['productsTopSales'] as $value): ?>
                                <tr class="border-b">
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <div class="rounded w-10 h-10 mr-2 flex items-center justify-center text-white font-bold text-lg uppercase"
                                                style="background-color: <?php echo '#' . substr(md5($value->getCategoryName()), 0, 6); ?>">
                                                <?php echo substr($value->getCategoryName(), 0, 1); ?>
                                            </div>
                                            <span><?php echo $value->getProductName() ?></span>
                                        </div>
                                    </td>
                                    <td class="py-3"><?php echo $value->getCategoryName() ?></td>
                                    <td class="py-3">
                                        <?php if ($value->getProductCount() < 300): ?>
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Low (<?php echo $value->getProductCount() ?>)
                                            </span>
                                        <?php else: ?>
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                In Stock (<?php echo $value->getProductCount() ?>)
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-3">
                                        <?php echo intval($value->getSalePrice()) ?> MAD
                                    </td>
                                    <td class="py-3"><?php echo intval($value->getTotalSalesQuantity()) ?> units</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Categories Tab -->
        <div id="categories" class="tab-content hidden">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold">Product Categories</h3>
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                    onclick="showModal('categoryModal')">
                    <i class="fas fa-plus mr-2"></i> New Category
                </button>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Products</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (isset($data['categories']) && !empty($data['categories'])): ?>
                            <?php foreach ($data['categories'] as $category): ?>
                                <tr class="hover:bg-gray-750">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo $category->getCategoryId() ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center text-white font-bold text-lg uppercase"
                                                style="background-color: <?php echo '#' . substr(md5($category->getCategoryName()), 0, 6); ?>">
                                                <?php echo substr($category->getCategoryName(), 0, 1); ?>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?php echo $category->getCategoryName() ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500 line-clamp-2 overflow-hidden">
                                            <?php echo $category->getDescription() ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo $category->getProductCount() ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-blue-600 hover:text-blue-900 mr-3"
                                            onclick="showUpdateCategoryModal('categoryUpdateModal', <?php echo $category->getCategoryId() ?> )"><i
                                                class="fas fa-edit"></i></button>
                                        <a href="/manager/category/delete/<?php echo $category->getCategoryId() ?>"
                                            class="text-red-400 hover:text-red-300"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Il n'y a pas encore de catégories.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Category Modal -->
            <div id="categoryModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <form action="/manager/category/create" method="POST"
                    class="bg-white rounded-lg shadow-lg w-full max-w-md">
                    <div class="px-6 py-4 border-b">
                        <h3 class="text-lg font-semibold">Add New Category</h3>
                    </div>
                    <div class="p-6">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryName">
                                Category Name
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="categoryName" type="text" placeholder="Enter category name" name="category_name">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryDescription">
                                Description
                            </label>
                            <textarea
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="categoryDescription" placeholder="Enter category description" rows="3"
                                name="description"></textarea>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 flex justify-end rounded-b-lg">
                        <button type="button"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="hideModal('categoryModal')">
                            Cancel
                        </button>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Save
                        </button>
                    </div>
                </form>
            </div>

            <!-- Category Modal Updaye -->
            <div id="categoryUpdateModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <form action="/manager/category/update" method="POST"
                    class="bg-white rounded-lg shadow-lg w-full max-w-md">
                    <div class="px-6 py-4 border-b">
                        <h3 class="text-lg font-semibold">Modifier Category</h3>
                    </div>
                    <div class="p-6">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryName">
                                Category Name
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="categoryNameUpdate" type="text" placeholder="Enter category name"
                                name="category_name" value="">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryDescription">
                                Description
                            </label>
                            <textarea
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="categoryDescriptionUpdate" placeholder="Enter category description" rows="3"
                                name="description"></textarea>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 flex justify-end rounded-b-lg">
                        <button type="button"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="hideModal('categoryUpdateModal')">
                            Cancel
                        </button>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Tab -->
        <div id="products" class="tab-content hidden">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold">Product Inventory</h3>
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                    onclick="showModal('productModal')">
                    <i class="fas fa-plus mr-2"></i> New Product
                </button>
            </div>

            <div class="bg-white rounded-lg shadow mb-6 p-4">
                <div class="flex flex-wrap items-center">
                    <div class="w-full md:w-1/3 mb-4 md:mb-0">
                        <input type="text" placeholder="Search products..."
                            class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="w-full md:w-2/3 flex flex-wrap justify-end space-x-2">
                        <select class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="categorySelect">
                            <option value="">All Categories</option>
                            <?php if (isset($data['categories'])): ?>
                                <?php foreach ($data['categories'] as $category): ?>
                                    <option value="<?php echo $category->getCategoryId() ?>">
                                        <?php echo $category->getCategoryName() ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <select class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="stockSelect">
                            <option value="">Sort By:</option>
                            <option value="ASC">Sort By: Stock (Low to High)</option>
                            <option value="DESC">Sort By: Stock (High to Low)</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Marge</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Trade Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sale Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stock</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="productTableBody">
                        <?php if (isset($data['products']) && !empty($data['products'])): ?>
                            <?php foreach ($data['products'] as $value): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo intval($value->getProfit()) ?> MAD
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center text-white font-bold text-lg uppercase"
                                                style="background-color: <?php echo '#' . substr(md5($value->getCategoryName()), 0, 6); ?>">
                                                <?php echo substr($value->getCategoryName(), 0, 1); ?>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?php echo $value->getProductName() ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo $value->getCategoryName() ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo intval($value->getTradePrice()) ?> MAD
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo intval($value->getSalePrice()) ?> MAD
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if ($value->getProductCount() < 300): ?>
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Low (<?php echo $value->getProductCount() ?>)
                                            </span>
                                        <?php else: ?>
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                In Stock (<?php echo $value->getProductCount() ?>)
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-blue-600 hover:text-blue-900 mr-3"
                                            onclick="updateProduct(<?php echo $value->getProductId() ?>)"><i
                                                class="fas fa-edit"></i></button>
                                        <a class="text-red-600 hover:text-red-900"
                                            href="/manager/product/delete/<?php echo $value->getProductId() ?>"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Il n'y a pas encore de produits.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>

            <!-- Product Modal -->
            <div id="productModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg shadow-2xl w-full max-w-xl mx-4 my-8 max-h-[90vh] overflow-y-auto">
                    <div class="sticky top-0 bg-white z-10 px-6 py-4 border-b">
                        <h3 class="text-xl font-bold text-gray-800 titel">Add New Product</h3>
                        <h5 class="bg-red-500 text-white w-full absolute top-full left-0 p-2 text-center rounded-b-lg font-semibold hidden"
                            id="errorPrice">Trade Price must be less than Sale Price</h5>
                    </div>
                    <form id="productForm" action="/manager/product/create" method="POST" class="p-6 space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    Product Name
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    id="name" name="product_name" type="text" placeholder="Enter product name" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
                                    Category
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    id="category_id" name="category_id" required>
                                    <option value="">Select a Category</option>
                                    <?php if (isset($data['categories'])): ?>
                                        <?php foreach ($data['categories'] as $category): ?>
                                            <option value="<?php echo $category->getCategoryId() ?>">
                                                <?php echo $category->getCategoryName() ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="trade_price">
                                    Trade Price (Wholesale)
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    id="trade_price" name="trade_price" type="number" step="0.01"
                                    placeholder="Trade price" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="sale_price">
                                    Sale Price
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    id="sale_price" name="sale_price" type="number" step="0.01" placeholder="Sale price"
                                    required>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="profit">
                                    Profit (La Marge)
                                </label>
                                <input readonly
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    id="profit" name="profit" type="number" step="0.01" placeholder="Profit" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
                                Initial Quantity
                            </label>
                            <div class="flex items-center">
                                <button type="button" onclick=""
                                    class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-3 rounded-l-lg border border-r-0 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <input readonly
                                    class="shadow appearance-none border text-center w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    id="quantity" name="quantity" type="number" min="0" value="0" required>
                                <button type="button" onclick=""
                                    class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-3 rounded-r-lg border border-l-0 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="bg-gray-50 flex justify-end space-x-4 p-4 rounded-b-lg">
                            <button type="button"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded transition duration-300 ease-in-out"
                                onclick="hideModal('productModal')">
                                Cancel
                            </button>
                            <button type="submit" id="productSubmit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">
                                Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Update Product Modal -->
            <div id="updateProductModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg shadow-2xl w-full max-w-xl mx-4 my-8 max-h-[90vh] overflow-y-auto">
                    <div class="sticky top-0 bg-white z-10 px-6 py-4 border-b">
                        <h3 class="text-xl font-bold text-gray-800 titel">Update Product</h3>
                        <h5 class="bg-red-500 text-white w-full absolute top-full left-0 p-2 text-center rounded-b-lg font-semibold hidden"
                            id="errorPrice">Trade Price must be less than Sale Price</h5>
                    </div>
                    <form id="productForm" action="" method="POST" class="p-6 space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    Product Name
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    id="updateName" name="product_name" type="text" placeholder="Enter product name"
                                    required>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
                                    Category
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    id="category_id" name="category_id" required>
                                    <option value="">Select a Category</option>
                                    <?php if (isset($data['categories'])): ?>
                                        <?php foreach ($data['categories'] as $category): ?>
                                            <option value="<?php echo $category->getCategoryId() ?>">
                                                <?php echo $category->getCategoryName() ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="trade_price">
                                    Trade Price (Wholesale)
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    id="trade_price_update" name="trade_price" type="number" step="0.01"
                                    placeholder="Trade price" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="sale_price">
                                    Sale Price
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    id="sale_price_update" name="sale_price" type="number" step="0.01"
                                    placeholder="Sale price" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="profit">
                                    Profit (La Marge)
                                </label>
                                <input readonly
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    id="profit_update" name="profit" type="number" step="0.01" placeholder="Profit"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
                                Initial Quantity
                            </label>
                            <div class="flex items-center">
                                <button type="button"
                                    class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-3 rounded-l-lg border border-r-0 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <input readonly
                                    class="shadow appearance-none border text-center w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    id="quantity_update" name="quantity" type="number" min="0" value="0" required>
                                <button type="button"
                                    class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-3 rounded-r-lg border border-l-0 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="bg-gray-50 flex justify-end space-x-4 p-4 rounded-b-lg">
                            <button type="button"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded transition duration-300 ease-in-out"
                                onclick="hideModal('updateProductModal')">
                                Cancel
                            </button>
                            <button type="submit" id="productSubmit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">
                                Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Modal -->
            <div id="orderModalProduct"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
                    <form action="/manager/order/create" method="POST">
                        <div class="px-6 py-4 border-b">
                            <h3 class="text-lg font-semibold">Create New Order</h3>
                        </div>
                        <div class="p-6">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="orderSupplier">
                                    Supplier
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="orderSupplier" name="orderSupplier">
                                    <option value="">Select supplier</option>
                                    <?php if (isset($data['suppliers'])): ?>
                                        <?php foreach ($data['suppliers'] as $value): ?>
                                            <option value="<?php echo $value->getId() ?>"><?php echo $value->getName() ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="mb-4 relative">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="orderProductName">
                                    Product Name
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="orderProductName" type="text" placeholder="Enter product name"
                                    name="orderProductName">
                                <input class="hidden" id="product_id" name="product_id">
                                <div id="customDropdown"
                                    class="absolute top-full left-0 w-full border border-gray-300 rounded bg-white shadow-md mt-1 z-10 hidden">
                                    <ul id="dropdownOptions" class="py-1 max-h-60 overflow-y-auto">
                                        <?php if (isset($data['products'])): ?>
                                            <?php foreach ($data['products'] as $value): ?>
                                                <li data-value="<?php echo $value->getProductId() ?>"
                                                    class="px-3 py-2 hover:bg-gray-100 cursor-pointer text-gray-700">
                                                    <?php echo $value->getProductName(); ?>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="orderQuantity">
                                    Quantity
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="orderQuantity" name="orderQuantity" type="number" min="500"
                                    placeholder="Enter quantity">
                            </div>
                        </div>
                        <div class="px-6 py-4 bg-gray-50 flex justify-end rounded-b-lg">
                            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                                type="button" onclick="hideModal('orderModal')">
                                Cancel
                            </button>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                type="submit">
                                Place Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- Suppliers Tab -->
        <div id="suppliers" class="tab-content hidden">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold">Suppliers</h3>
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                    onclick="showModal('supplierModal')">
                    <i class="fas fa-plus mr-2"></i> New Supplier
                </button>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Postal Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Supplier</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                City</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (isset($data['suppliers']) && !empty($data['suppliers'])): ?>
                            <?php foreach ($data['suppliers'] as $value): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo $value->getPostalCode() ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900"><?php echo $value->getName() ?>
                                                </div>
                                                <div class="text-sm text-gray-500"><?php echo $value->getCategoryName() ?>
                                                    Supplier</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500"><?php echo $value->getEmail() ?></div>
                                        <div class="text-sm text-gray-500"><?php echo $value->getPhone() ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo $value->getCity() ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            <?php echo $value->getStatus() ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-blue-600 hover:text-blue-900 mr-3"
                                            onclick="showUpdateSupplierModal(<?php echo $value->getId() ?>)"><i
                                                class="fas fa-edit"></i></button>
                                        <a class="text-red-600 hover:text-red-900"
                                            href="/manager/supplier/delete/<?php echo $value->getId() ?>"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Il n'y a pas encore de supplier.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Supplier Modal -->
            <div id="supplierModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-20 hidden">
                <form action="/manager/supplier/create" method="POST">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto">
                        <div class="px-6 py-3 border-b">
                            <h3 class="text-lg font-semibold titel">Add New Supplier</h3>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="mb-3">
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="supplierName">
                                        Supplier Name *
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:shadow-outline"
                                        id="supplierName" type="text" placeholder="Enter supplier name"
                                        name="supplier_name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="supplierStatus">
                                        Supplier Type *
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:shadow-outline"
                                        id="supplierStatus" name="status" required>
                                        <option value="">Select Supplier Type</option>
                                        <option value="company">Company</option>
                                        <option value="individual">Individual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="block text-gray-700 text-sm font-bold mb-1" for="categoryId">
                                    Category
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:shadow-outline"
                                    id="categoryId" name="category_id">
                                    <option value="">Select Category (Optional)</option>
                                    <?php if (isset($data['categories'])): ?>
                                        <?php foreach ($data['categories'] as $category): ?>
                                            <option value="<?php echo $category->getCategoryId() ?>">
                                                <?php echo $category->getCategoryName() ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="mb-3">
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="contactPhone">
                                        Phone
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:shadow-outline"
                                        id="contactPhone" type="tel" placeholder="Phone number" name="contact_phone">
                                </div>
                                <div class="mb-3">
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="email">
                                        Email
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:shadow-outline"
                                        id="email" type="email" placeholder="Email address" name="email">
                                </div>
                            </div>
                            <div class="relative w-full">
                                <div class="mb-3">
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="country">
                                        Country
                                    </label>
                                    <input id="country" type="text" placeholder="Enter country" autocomplete="off"
                                        name="country"
                                        class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:border-blue-500" />
                                    <div id="suggestions"
                                        class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="relative w-full">
                                    <div class="mb-3">
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="city">
                                            City
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:shadow-outline"
                                            id="city" type="text" placeholder="City" name="city">
                                        <div id="suggestionsCity"
                                            class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="postalCode">
                                        Postal Code
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:shadow-outline"
                                        id="postalCode" type="text" placeholder="Postal Code" name="postal_code">
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-3 bg-gray-50 flex justify-end rounded-b-lg">
                            <button type="button"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1.5 px-3 rounded mr-2"
                                onclick="hideModal('supplierModal')">
                                Cancel
                            </button>
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-3 rounded">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Update Supplier Modal -->
            <div id="updateSupplierModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <form action="/manager/supplier/update/" method="POST">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto">
                        <div class="px-6 py-3 border-b">
                            <h3 class="text-lg font-semibold titel">Update Supplier</h3>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="mb-3">
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="supplierName">
                                        Supplier Name *
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:shadow-outline"
                                        id="supplierNameUpdate" type="text" placeholder="Enter supplier name"
                                        name="supplier_name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="supplierStatus">
                                        Supplier Type *
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:shadow-outline"
                                        id="supplierStatusUpdate" name="status" required>
                                        <option value="">Select Supplier Type</option>
                                        <option value="company">Company</option>
                                        <option value="individual">Individual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="block text-gray-700 text-sm font-bold mb-1" for="categoryId">
                                    Category
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:shadow-outline"
                                    id="categoryIdUpdate" name="category_id">
                                    <option value="">Select Category (Optional)</option>
                                    <?php if (isset($data['categories'])): ?>
                                        <?php foreach ($data['categories'] as $category): ?>
                                            <option value="<?php echo $category->getCategoryId() ?>">
                                                <?php echo $category->getCategoryName() ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="mb-3">
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="contactPhone">
                                        Phone
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:shadow-outline"
                                        id="contactPhoneUpdate" type="tel" placeholder="Phone number"
                                        name="contact_phone">
                                </div>
                                <div class="mb-3">
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="email">
                                        Email
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:shadow-outline"
                                        id="emailUpdate" type="email" placeholder="Email address" name="email">
                                </div>
                            </div>
                            <div class="relative w-full">
                                <div class="mb-3">
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="country">
                                        Country
                                    </label>
                                    <input id="countryUpdate" type="text" placeholder="Enter country" autocomplete="off"
                                        name="country"
                                        class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:border-blue-500" />
                                    <div id="suggestions"
                                        class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="relative w-full">
                                    <div class="mb-3">
                                        <label class="block text-gray-700 text-sm font-bold mb-1" for="city">
                                            City
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:shadow-outline"
                                            id="cityUpdate" type="text" placeholder="City" name="city">
                                        <div id="suggestionsCity"
                                            class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="postalCode">
                                        Postal Code
                                    </label>
                                    <input readonly
                                        class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm leading-tight focus:outline-none focus:shadow-outline"
                                        id="postalCodeUpdate" type="text" placeholder="Postal Code" name="postal_code">
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-3 bg-gray-50 flex justify-end rounded-b-lg">
                            <button type="button"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1.5 px-3 rounded mr-2"
                                onclick="hideModal('updateSupplierModal')">
                                Cancel
                            </button>
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-3 rounded">
                                Save
                            </button>
                        </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Orders Tab -->
    <div id="orders" class="tab-content hidden">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold">Orders Management</h3>
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                onclick="showModal('orderModal')">
                <i class="fas fa-plus mr-2"></i> New Order
            </button>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Supplier</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (isset($data['orders']) && !empty($data['orders'])): ?>
                        <?php foreach ($data['orders'] as $value): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $value->getCreatedAt() ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo $value->getSupplierName() ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo $value->getProductName() ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $value->getQuantity() ?>
                                </td>
                                <?php if ($value->isDone()): ?>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Completed
                                        </span>
                                    </td>
                                <?php else: ?>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="/manager/order/confirm/<?php echo $value->getOrderId() ?>"
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 cursor-pointer">
                                            Pending
                                        </a>
                                    </td>
                                <?php endif; ?>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3"
                                        onclick="showOrderModal(<?php echo $value->getOrderId() ?>)"><i
                                            class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                Il n'y a pas encore de order.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Order Modal -->
        <div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
                <form action="/manager/order/create" method="POST">
                    <div class="px-6 py-4 border-b">
                        <h3 class="text-lg font-semibold">Create New Order</h3>
                    </div>
                    <div class="p-6">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="orderSupplier">
                                Supplier
                            </label>
                            <select
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="orderSupplier" name="orderSupplier">
                                <option value="">Select supplier</option>
                                <?php if (isset($data['suppliers'])): ?>
                                    <?php foreach ($data['suppliers'] as $value): ?>
                                        <option value="<?php echo $value->getId() ?>"><?php echo $value->getName() ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="mb-4 relative">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="orderProductName">
                                Product Name
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="orderProductName" type="text" placeholder="Enter product name"
                                name="orderProductName">
                            <input class="hidden" id="product_id" name="product_id">
                            <div id="customDropdown"
                                class="absolute top-full left-0 w-full border border-gray-300 rounded bg-white shadow-md mt-1 z-10 hidden">
                                <ul id="dropdownOptions" class="py-1 max-h-60 overflow-y-auto">
                                    <?php if (isset($data['products'])): ?>
                                        <?php foreach ($data['products'] as $value): ?>
                                            <li data-value="<?php echo $value->getProductId() ?>"
                                                class="px-3 py-2 hover:bg-gray-100 cursor-pointer text-gray-700">
                                                <?php echo $value->getProductName(); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="orderQuantity">
                                Quantity
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="orderQuantity" name="orderQuantity" type="number" min="500"
                                placeholder="Enter quantity">
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 flex justify-end rounded-b-lg">
                        <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            type="button" onclick="hideModal('orderModal')">
                            Cancel
                        </button>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            type="submit">
                            Place Order
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Order Display Modal -->
        <div id="viewOrderModal"
            class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-opacity duration-300">
            <div
                class="bg-white rounded-xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-100 mx-4">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Order Details</h3>
                </div>
                <div class="p-6 space-y-5">
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-700 font-bold">Order ID:</span>
                        <span id="viewOrderId" class="text-gray-700 font-medium col-span-2"></span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-700 font-bold">Supplier:</span>
                        <span id="viewOrderSupplier" class="text-gray-700 font-medium col-span-2"></span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-700 font-bold">Product:</span>
                        <span id="viewOrderProduct" class="text-gray-700 font-medium col-span-2"></span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-700 font-bold">Quantity:</span>
                        <span id="viewOrderQuantity" class="text-gray-700 font-medium col-span-2"></span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-700 font-bold">Status:</span>
                        <span id="viewOrderStatus"
                            class="font-medium px-2 py-1 rounded-full text-sm col-span-2 bg-blue-100 text-blue-800 inline-block w-fit"></span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-700 font-bold">Created At:</span>
                        <span id="viewOrderCreatedAt" class="text-gray-700 font-medium col-span-2"></span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-700 font-bold">Date of Effect:</span>
                        <span id="viewOrderDateOfAffect" class="text-gray-700 font-medium col-span-2"></span>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end rounded-b-lg border-t border-gray-100">
                    <button id="markCompleteBtn"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg mr-2 hidden transition-colors duration-200 shadow-sm"
                        type="button">
                        Mark Complete
                    </button>
                    <button
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition-colors duration-200 shadow-sm"
                        type="button" onclick="hideModal('viewOrderModal')">
                        Close
                    </button>
                </div>
            </div>
        </div>


    </div>

    <!-- objectives Tab -->
    <div id="objectives" class="tab-content hidden">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold">Objectives Management</h3>
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                onclick="showModal('objectiveModal')">
                <i class="fas fa-plus mr-2"></i> New Objective
            </button>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Frequency</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Target</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Created At</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date Experation</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if ($data['objectifs']): ?>
                        <?php foreach ($data['objectifs'] as $value): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $value->getObjectifId() ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full  <?php echo ($value->getFrequency() === 'weekly') ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' ?>">
                                        <?php echo $value->getFrequency() ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php if ($value->getType() === 'quantity_product'): ?>
                                        Product Quantity
                                    <?php else: ?>
                                        Montant Total
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php if ($value->getType() === 'quantity_product'): ?>
                                        <?php echo $value->getTarget() ?> units
                                    <?php else: ?>
                                        <?php echo $value->getTarget() ?> DH
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $value->getCreatedAt() ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $value->getExpirationDate() ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="/manager/objective/delete/<?php echo $value->getObjectifId() ?>"
                                        class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- New Objective Modal -->
        <div id="objectiveModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
                <form action="/manager/objective/create" method="POST">
                    <div class="px-6 py-4 border-b">
                        <h3 class="text-lg font-semibold">Create New Objective</h3>
                    </div>
                    <div class="p-6">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="frequency">
                                Frequency
                            </label>
                            <select
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="frequency" name="frequency">
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                                Type
                            </label>
                            <select
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="type" name="type">
                                <option value="quantity_product">Product Quantity</option>
                                <option value="montant_total">Total Amount</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="target">
                                Target Value
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="target" name="target" type="number" min="1" placeholder="Enter target value">
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 flex justify-end rounded-b-lg">
                        <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            type="button" onclick="hideModal('objectiveModal')">
                            Cancel
                        </button>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            type="submit">
                            Save Objective
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- View Objective Modal -->
        <div id="viewObjectiveModal"
            class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-opacity duration-300">
            <div
                class="bg-white rounded-xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-100 mx-4">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Objective Details</h3>
                </div>
                <div class="p-6 space-y-5">
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-700 font-bold">ID:</span>
                        <span id="viewObjectiveId" class="text-gray-700 font-medium col-span-2">2</span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-700 font-bold">Frequency:</span>
                        <span id="viewObjectiveFrequency" class="text-gray-700 font-medium col-span-2">
                            <span
                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                Weekly
                            </span>
                        </span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-700 font-bold">Type:</span>
                        <span id="viewObjectiveType" class="text-gray-700 font-medium col-span-2">Total Amount</span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-700 font-bold">Target:</span>
                        <span id="viewObjectiveTarget" class="text-gray-700 font-medium col-span-2">$5,000</span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-700 font-bold">Created At:</span>
                        <span id="viewObjectiveCreatedAt" class="text-gray-700 font-medium col-span-2">2025-04-05</span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <span class="text-gray-700 font-bold">Manager:</span>
                        <span id="viewObjectiveManager" class="text-gray-700 font-medium col-span-2">John Doe</span>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end rounded-b-lg border-t border-gray-100">
                    <button
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg mr-2 transition-colors duration-200 shadow-sm"
                        type="button" onclick="editObjective(2)">
                        Edit
                    </button>
                    <button
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition-colors duration-200 shadow-sm"
                        type="button" onclick="hideModal('viewObjectiveModal')">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Employees Tab -->
    <div id="employees" class="tab-content hidden">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-2xl font-semibold">Employee Management</h3>
        </div>

        <!-- Employee Cards Section -->
        <div class="mb-12">
            <!-- Scrollable container with better overflow handling -->
            <div class="overflow-x-auto pb-4">
                <!-- Responsive grid that works better on different screen sizes -->
                <div class="grid grid-flow-col auto-cols-[280px] md:auto-cols-[320px] gap-6">
                    <?php if ($data['employees']): ?>
                        <?php foreach ($data['employees'] as $value): ?>
                            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-6">
                                <div class="flex flex-col items-center">
                                    <!-- Avatar circle -->
                                    <div
                                        class="w-24 h-24 bg-gray-200 rounded-full mb-4 flex items-center justify-center text-2xl font-bold text-gray-600">
                                        <?php
                                        $name = $value->getFullName();
                                        $nameArray = explode(" ", $name);
                                        $firstInitial = !empty($nameArray[0]) ? substr($nameArray[0], 0, 1) : "";
                                        $lastInitial = !empty($nameArray[count($nameArray) - 1]) ? substr($nameArray[count($nameArray) - 1], 0, 1) : "";
                                        echo strtoupper($firstInitial . $lastInitial);
                                        ?>
                                    </div>

                                    <!-- Employee info with better spacing -->
                                    <h3 class="text-lg font-semibold mb-1"><?php echo $value->getFullName() ?></h3>
                                    <p class="text-gray-500 mb-3"><?php echo $value->getStore()->getName() ?></p>

                                    <!-- Badge with improved positioning -->
                                    <div class="mb-5">
                                        <span
                                            class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">Employee</span>
                                    </div>

                                    <!-- Performance bar with better spacing -->
                                    <div class="w-full">
                                        <div class="flex justify-between mb-2">
                                            <span class="text-sm font-medium">Performance</span>
                                            <span
                                                class="text-sm font-medium <?php echo ($value->getEmployee()->getPerformance() ?: 0) > 50 ? 'text-green-600' : 'text-blue-600' ?>"><?php echo $value->getEmployee()->getPerformance() ?: 0 ?>%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="<?php echo ($value->getEmployee()->getPerformance() ?: 0) > 50 ? 'bg-green-500' : 'bg-blue-500' ?> h-2.5 rounded-full"
                                                style="width: <?php echo $value->getEmployee()->getPerformance() ?: 0 ?>%">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Stats with improved spacing and alignment -->
                                    <div class="w-full mt-5 grid grid-cols-2 gap-4 text-center">
                                        <div class="bg-gray-50 p-2 rounded">
                                            <p class="text-gray-500 text-sm mb-1">Sales</p>
                                            <p class="font-semibold">
                                                $<?php echo number_format($value->getEmployee()->getMontantTotal() ?? 0, 2) ?>
                                            </p>
                                        </div>
                                        <div class="bg-gray-50 p-2 rounded">
                                            <p class="text-gray-500 text-sm mb-1">Items Sold</p>
                                            <p class="font-semibold">
                                                <?php echo $value->getEmployee()->getQuantityTotal() ?? 0 ?> units
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Button with improved spacing and hover effect -->
                                    <button
                                        class="mt-6 w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition-colors duration-200">
                                        View Profile
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Performance Chart Section -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold">Employee Performance Chart</h3>
            </div>
            <div class="p-6">
                <canvas id="employeePerformanceChart" height="300"></canvas>
            </div>
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

    <!-- JavaScript -->
    <script src="../../public/assets/js/manager.js"></script>
    <script src="../../public/assets/js/order.js"></script>
    <script src="../../public/assets/js/charts.js"></script>
</body>

</html>
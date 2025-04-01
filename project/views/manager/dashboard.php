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
            <a data-tab="#orders" class="flex items-center py-3 px-6 text-white hover:bg-blue-700"
                onclick="switchTab('orders')">
                <i class="fas fa-shopping-cart mr-3"></i> Orders
            </a>
            <a data-tab="#employees" class="flex items-center py-3 px-6 text-white hover:bg-blue-700"
                onclick="switchTab('employees')">
                <i class="fas fa-users mr-3"></i> Employees
            </a>
        </nav>
        <div class="absolute bottom-0 w-full border-t border-blue-700 p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center text-white font-bold text-lg uppercase mr-3"
                    style="background-color: <?php echo '#' . substr(md5('money'), 0, 6); ?>">
                    <?php echo substr('money', 0, 1); ?>
                </div>
                <div>
                    <p class="font-semibold">John Doe</p>
                    <p class="text-sm text-blue-300">Store Manager</p>
                </div>
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
                    <p class="text-sm text-gray-600">Welcome back, John Doe</p>
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
                            <h3 class="text-2xl font-bold">246</h3>
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
                            <h3 class="text-2xl font-bold">$12,436</h3>
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
                            <h3 class="text-2xl font-bold">12</h3>
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
                            <h3 class="text-2xl font-bold">15</h3>
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

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Recent Activity</h3>
                    <a href="#" class="text-blue-500 text-sm">View All</a>
                </div>
                <div class="divide-y">
                    <div class="py-3 flex items-center">
                        <div class="bg-blue-100 p-2 rounded-full mr-4">
                            <i class="fas fa-shopping-cart text-blue-500"></i>
                        </div>
                        <div>
                            <p class="font-medium">New Order Placed</p>
                            <p class="text-sm text-gray-500">Order #12345 for 25 units of Laptop</p>
                        </div>
                        <p class="ml-auto text-sm text-gray-500">2 hours ago</p>
                    </div>
                    <div class="py-3 flex items-center">
                        <div class="bg-green-100 p-2 rounded-full mr-4">
                            <i class="fas fa-check text-green-500"></i>
                        </div>
                        <div>
                            <p class="font-medium">Order Completed</p>
                            <p class="text-sm text-gray-500">Order #12342 has been delivered</p>
                        </div>
                        <p class="ml-auto text-sm text-gray-500">5 hours ago</p>
                    </div>
                    <div class="py-3 flex items-center">
                        <div class="bg-red-100 p-2 rounded-full mr-4">
                            <i class="fas fa-exclamation-circle text-red-500"></i>
                        </div>
                        <div>
                            <p class="font-medium">Low Stock Alert</p>
                            <p class="text-sm text-gray-500">Smartphone X is running low (5 left)</p>
                        </div>
                        <p class="ml-auto text-sm text-gray-500">1 day ago</p>
                    </div>
                </div>
            </div>

            <!-- Top Selling Products -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Top Selling Products</h3>
                    <a href="#" class="text-blue-500 text-sm">View All Products</a>
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="pb-3">Product Name</th>
                            <th class="pb-3">Category</th>
                            <th class="pb-3">Stock</th>
                            <th class="pb-3">Price</th>
                            <th class="pb-3">Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-3">
                                <div class="flex items-center">
                                    <div class="bg-gray-200 rounded w-10 h-10 mr-2"></div>
                                    <span>Smartphone X</span>
                                </div>
                            </td>
                            <td class="py-3">Electronics</td>
                            <td class="py-3"><span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Low
                                    (5)</span></td>
                            <td class="py-3">$999</td>
                            <td class="py-3">502 units</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3">
                                <div class="flex items-center">
                                    <div class="bg-gray-200 rounded w-10 h-10 mr-2"></div>
                                    <span>Laptop Pro</span>
                                </div>
                            </td>
                            <td class="py-3">Electronics</td>
                            <td class="py-3"><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">In
                                    Stock (42)</span></td>
                            <td class="py-3">$1,299</td>
                            <td class="py-3">342 units</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3">
                                <div class="flex items-center">
                                    <div class="bg-gray-200 rounded w-10 h-10 mr-2"></div>
                                    <span>Wireless Earbuds</span>
                                </div>
                            </td>
                            <td class="py-3">Audio</td>
                            <td class="py-3"><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">In
                                    Stock (78)</span></td>
                            <td class="py-3">$149</td>
                            <td class="py-3">281 units</td>
                        </tr>
                        <tr>
                            <td class="py-3">
                                <div class="flex items-center">
                                    <div class="bg-gray-200 rounded w-10 h-10 mr-2"></div>
                                    <span>Smart Watch</span>
                                </div>
                            </td>
                            <td class="py-3">Wearables</td>
                            <td class="py-3"><span
                                    class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Medium
                                    (15)</span></td>
                            <td class="py-3">$299</td>
                            <td class="py-3">184 units</td>
                        </tr>
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
                    <thead class="bg-gray-50">
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
                        <?php if (isset($data['categories'])): ?>
                            <?php foreach ($data['categories'] as $category): ?>
                                <tr>
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
                                            class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="px-6 py-4 border-t flex justify-between items-center">
                    <p class="text-sm text-gray-700">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span
                            class="font-medium">97</span> results
                    </p>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 rounded border bg-gray-100">Previous</button>
                        <button class="px-3 py-1 rounded border bg-blue-500 text-white">1</button>
                        <button class="px-3 py-1 rounded border">2</button>
                        <button class="px-3 py-1 rounded border">3</button>
                        <button class="px-3 py-1 rounded border">Next</button>
                    </div>
                </div>
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
                    <thead class="bg-gray-50">
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
                        <?php if (isset($data['products'])): ?>
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
                                        <?php if ($value->getProductCount() <= 300): ?>
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
                                        <button class="text-green-600 hover:text-green-900 mr-3"
                                            onclick="genereteOrder(<?php echo $value->getProductId() ?>)"><i
                                                class="fas fa-shopping-cart"></i></button>
                                        <a class="text-red-600 hover:text-red-900"
                                            href="/manager/product/delete/<?php echo $value->getProductId() ?>"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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

        </div>

        <!-- Suppliers Tab -->
        <div id="suppliers" class="tab-content ">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold">Suppliers</h3>
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                    onclick="showModal('supplierModal')">
                    <i class="fas fa-plus mr-2"></i> New Supplier
                </button>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
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
                        <?php if (isset($data['suppliers'])): ?>
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

        <div class="bg-white rounded-lg shadow mb-6 p-4">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-1/3 mb-4 md:mb-0">
                    <input type="text" placeholder="Search orders..."
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="w-full md:w-2/3 flex flex-wrap justify-end space-x-2">
                    <select class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>All Suppliers</option>
                        <option>TechSupply Inc.</option>
                        <option>Fashion World</option>
                    </select>
                    <select class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>All Status</option>
                        <option>Pending</option>
                        <option>Completed</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Order ID</th>
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
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ORD-001</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">TechSupply Inc.</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Smartphone X</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">50</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></button>
                            <button class="text-green-600 hover:text-green-900 mr-3" onclick="generatePDF()"><i
                                    class="fas fa-file-pdf"></i></button>
                            <button class="text-red-600 hover:text-red-900"><i class="fas fa-times"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ORD-002</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Fashion World</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">T-shirts (Assorted)</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">100</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Completed
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></button>
                            <button class="text-green-600 hover:text-green-900 mr-3" onclick="generatePDF()"><i
                                    class="fas fa-file-pdf"></i></button>
                            <button class="text-green-600 hover:text-green-900"><i class="fas fa-check"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="px-6 py-4 border-t flex justify-between items-center">
                <p class="text-sm text-gray-700">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span
                        class="font-medium">24</span> results
                </p>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 rounded border bg-gray-100">Previous</button>
                    <button class="px-3 py-1 rounded border bg-blue-500 text-white">1</button>
                    <button class="px-3 py-1 rounded border">2</button>
                    <button class="px-3 py-1 rounded border">3</button>
                    <button class="px-3 py-1 rounded border">Next</button>
                </div>
            </div>
        </div>

        <!-- Order Modal -->
        <div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
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
                            id="orderSupplier">
                            <option value="">Select Supplier</option>
                            <option value="1">Fashion World</option>
                            <option value="2">TechSupply Inc.</option>
                        </select>
                    </div>
                    <div class="mb-4 relative">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="orderProductName">
                            Product Name
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="orderProductName" type="text" placeholder="Enter product name">
                        <div id="customDropdown"
                            class="absolute top-full left-0 w-full border border-gray-300 rounded bg-white shadow-md mt-1 z-10 hidden">
                            <ul id="dropdownOptions" class="py-1 max-h-60 overflow-y-auto">
                                <?php if (isset($data['products'])): ?>
                                    <?php foreach ($data['products'] as $value): ?>
                                        <li data-value="<?php echo $value->getProductId() ?>"
                                            class="px-3 py-2 hover:bg-gray-100 cursor-pointer text-gray-700">
                                            <?php echo $value->getProductName() ?></li>
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
                            id="orderQuantity" type="number" min="1" placeholder="Enter quantity">
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end rounded-b-lg">
                    <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                        onclick="hideModal('orderModal')">
                        Cancel
                    </button>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Place Order
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Employees Tab -->
    <div id="employees" class="tab-content hidden">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold">Employee Management</h3>
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                <i class="fas fa-plus mr-2"></i> New Employee
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-gray-200 rounded-full mb-4"></div>
                    <h3 class="text-lg font-semibold">Jane Smith</h3>
                    <p class="text-gray-500 mb-2">Senior Sales Associate</p>
                    <div class="flex mb-4">
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Top
                            Performer</span>
                    </div>
                    <div class="w-full mt-2">
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium">Performance</span>
                            <span class="text-sm font-medium text-green-600">97.5%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 97.5%"></div>
                        </div>
                    </div>
                    <div class="w-full mt-4 grid grid-cols-2 gap-4 text-center">
                        <div>
                            <p class="text-gray-500 text-sm">Sales</p>
                            <p class="font-semibold">$24,568</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Items Sold</p>
                            <p class="font-semibold">214</p>
                        </div>
                    </div>
                    <button class="mt-6 w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        View Profile
                    </button>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-gray-200 rounded-full mb-4"></div>
                    <h3 class="text-lg font-semibold">Mike Johnson</h3>
                    <p class="text-gray-500 mb-2">Sales Associate</p>
                    <div class="flex mb-4">
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">Regular</span>
                    </div>
                    <div class="w-full mt-2">
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium">Performance</span>
                            <span class="text-sm font-medium text-blue-600">85.2%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 85.2%"></div>
                        </div>
                    </div>
                    <div class="w-full mt-4 grid grid-cols-2 gap-4 text-center">
                        <div>
                            <p class="text-gray-500 text-sm">Sales</p>
                            <p class="font-semibold">$17,462</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Items Sold</p>
                            <p class="font-semibold">176</p>
                        </div>
                    </div>
                    <button class="mt-6 w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        View Profile
                    </button>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-gray-200 rounded-full mb-4"></div>
                    <h3 class="text-lg font-semibold">Lisa Chen</h3>
                    <p class="text-gray-500 mb-2">Junior Sales Associate</p>
                    <div class="flex mb-4">
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">New
                            Hire</span>
                    </div>
                    <div class="w-full mt-2">
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium">Performance</span>
                            <span class="text-sm font-medium text-yellow-600">76.8%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: 76.8%"></div>
                        </div>
                    </div>
                    <div class="w-full mt-4 grid grid-cols-2 gap-4 text-center">
                        <div>
                            <p class="text-gray-500 text-sm">Sales</p>
                            <p class="font-semibold">$9,845</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Items Sold</p>
                            <p class="font-semibold">98</p>
                        </div>
                    </div>
                    <button class="mt-6 w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        View Profile
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow mb-8">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-semibold">Employee Performance Chart</h3>
            </div>
            <div class="p-6">
                <canvas id="employeePerformanceChart" height="300"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b flex justify-between items-center">
                <h3 class="text-lg font-semibold">Employee List</h3>
                <input type="text" placeholder="Search employees..."
                    class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Employee</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Position</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Performance</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Salary</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full"></div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Jane Smith</div>
                                    <div class="text-sm text-gray-500">jane.smith@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Senior Sales Associate</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-24 bg-gray-200 rounded-full h-2 mr-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 97.5%"></div>
                                </div>
                                <span class="text-sm text-green-600 font-medium">97.5%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$45,000</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></button>
                            <button class="text-green-600 hover:text-green-900 mr-3"><i
                                    class="fas fa-chart-line"></i></button>
                            <button class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full"></div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Mike Johnson</div>
                                    <div class="text-sm text-gray-500">mike.johnson@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Sales Associate</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-24 bg-gray-200 rounded-full h-2 mr-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: 85.2%"></div>
                                </div>
                                <span class="text-sm text-blue-600 font-medium">85.2%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$38,000</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></button>
                            <button class="text-green-600 hover:text-green-900 mr-3"><i
                                    class="fas fa-chart-line"></i></button>
                            <button class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
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

    <!-- JavaScript -->
    <script src="../../public/assets/js/manager.js"></script>
    <script src="../../public/assets/js/charts.js"></script>
</body>

</html>
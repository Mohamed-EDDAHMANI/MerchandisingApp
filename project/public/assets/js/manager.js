const trade_price = document.getElementById('trade_price')
const sale_price = document.getElementById('sale_price')


// Hide the message after 5 seconds
setTimeout(() => {
    const alertMessage = document.getElementById('alert-message');
    if (alertMessage) {
        alertMessage.classList.add('opacity-0');
        setTimeout(() => alertMessage.remove(), 300);
    }
}, 5000);


document.addEventListener("DOMContentLoaded", function () {
    const urlParams = window.location.href;
    const [path, fragment] = urlParams.split("#");
    switch (fragment) {
        case 'categories':
            const categoryButton = document.getElementById('categoriesBtn');
            history.replaceState(null, null, path);
            categoryButton.click();
            break;
        case 'products':
            const productsButton = document.getElementById('productsBtn');
            history.replaceState(null, null, path);
            productsButton.click();
            break;

        default:
            break;
    }
});

// Tab switching
function switchTab(tabId) {
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('hidden');
    });

    // Show selected tab
    document.getElementById(tabId).classList.remove('hidden');

    // Update page title
    document.getElementById('page-title').textContent = tabId.charAt(0).toUpperCase() + tabId.slice(1);

    // Update active nav
    document.querySelectorAll('nav a').forEach(link => {
        link.classList.remove('active-nav', 'bg-blue-700');
        if (link.getAttribute('data-tab') === '#' + tabId) {
            link.classList.add('active-nav', 'bg-blue-700');
        }
    });
}

// Modal functions
function showModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
}

function hideModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

async function showUpdateCategoryModal(modalId, id) {
    category = await getCategories(id);
    document.querySelector('#categoryUpdateModal form').action = `/manager/category/update/${id}`
    document.getElementById('categoryNameUpdate').value = category.category_name || null;
    document.getElementById('categoryDescriptionUpdate').value = category.description || null;
    document.getElementById(modalId).classList.remove('hidden');
}

async function getCategories(id) {
    try {
        const response = await fetch(`/manager/category/getCategory/${id}`, {
            method: 'GET',
        });

        if (!response.ok) {
            throw new Error('Failed to fetch category data');
        }
        const category = await response.json();
        return category[0];
    } catch (error) {
        console.error('Error fetching category data:', error);
    }
}

// Close modal when clicking outside
window.addEventListener('click', function (event) {
    document.querySelectorAll('.fixed.inset-0').forEach(modal => {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
});


function calcProfit() {
    const tradePriceValue = parseFloat(trade_price.value) || 0;
    const salePriceValue = parseFloat(sale_price.value) || 0;

    document.getElementById('profit').value = salePriceValue - tradePriceValue
    if (salePriceValue - tradePriceValue <= 0) {
        document.getElementById('productSubmit').style.backgroundColor = 'red';
        document.getElementById('productSubmit').style.cursor = 'not-allowed';
        document.getElementById('productSubmit').disabled = true;
        document.getElementById('errorPrice').classList.remove('hidden');
        setTimeout(() => {
            document.getElementById('errorPrice').classList.add('hidden');
        }, 5000);
    } else {
        console.log('')
        document.getElementById('productSubmit').style.backgroundColor = 'blue';
        document.getElementById('productSubmit').style.cursor = '';
        document.getElementById('productSubmit').disabled = false;
        document.getElementById('errorPrice').classList.add('hidden');
    }
}

trade_price.addEventListener('input', calcProfit)
sale_price.addEventListener('input', calcProfit)


function incrementQuantity() {
    const quantityInput = document.getElementById('quantity');
    quantityInput.value = parseInt(quantityInput.value) + 1;
}

function decrementQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value);
    if (currentValue > 0) {
        quantityInput.value = currentValue - 1;
    }
}

//update Product
async function updateProduct(productId) {
    const product = await getProductById(productId);
    document.querySelector('#updateProductModal form').action = `/manager/product/update/${productId}`
    document.getElementById('updateName').value = product.product_name
    const options = document.querySelectorAll('#category_id option')
    options.forEach(option => {
        option.value == product.category_id ? option.selected = true : ''
    });
    document.getElementById('trade_price_update').value = product.trade_price
    document.getElementById('sale_price_update').value = product.sale_price
    document.getElementById('profit_update').value = product.profit
    document.getElementById('quantity_update').value = product.quentity
    showModal('updateProductModal')
}

async function getProductById(id) {
    try {
        const response = await fetch(`/manager/product/getProduct/${id}`, {
            method: 'GET',
        });

        if (!response.ok) {
            throw new Error('Failed to fetch category data');
        }
        const category = await response.json();
        return category[0];
    } catch (error) {
        console.error('Error fetching category data:', error);
    }
}

async function sortProducts() {
    const categorySelect = document.getElementById('categorySelect').value;
    const stockSelect = document.getElementById('stockSelect').value;
    const productTableBody = document.getElementById('productTableBody');
    console.log('hello')
    const filters = {}

    if (categorySelect) filters.categorySelect = categorySelect
    if (stockSelect) filters.stockSelect = stockSelect

    try {
        const response = await fetch(`/manager/product/sort`, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(filters)
        });

        if (!response.ok) {
            throw new Error('Failed to fetch category data');
        }
        const products = await response.json();
        console.log(products)

        productTableBody.innerHTML = "";

        (Array.isArray(products) ? products : []).forEach(product => {
            const row = document.createElement("tr");
            row.innerHTML = `<tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${product.profit % 1 === 0 ? Math.floor(product.profit) : product.profit} MAD
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center text-white font-bold text-lg uppercase"
                                                style="background-color: blue">
                                                ${product.category_name.charAt(0)}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    ${product.product_name}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${product.category_name}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${product.trade_price % 1 === 0 ? Math.floor(product.trade_price) : product.trade_price } MAD
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${product.sale_price % 1 === 0 ? Math.floor(product.sale_price) : product.sale_price} MAD
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        ${product.sale_price < 300 ? `
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Low (${product.product_count})
                                            </span>
                                            ` : `
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                In Stock (${product.product_count})
                                            </span>
                                        ` }
                                    </td>
                                     <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-blue-600 hover:text-blue-900 mr-3"
                                            onclick="updateProduct(${product.product_id})"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="text-green-600 hover:text-green-900 mr-3"><i
                                                class="fas fa-shopping-cart"></i></button>
                                        <a class="text-red-600 hover:text-red-900"
                                            href="/manager/product/delete/${product.product_id}"><i
                                                class="fas fa-trash"></i></a>
                                    </td>`;

            productTableBody.appendChild(row);

        });

    } catch (error) {
        console.error('Error fetching category data:', error);
    }
}

document.getElementById('categorySelect').addEventListener('change', sortProducts)
document.getElementById('stockSelect').addEventListener('change', sortProducts)

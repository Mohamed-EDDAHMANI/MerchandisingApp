// DOM Elements
const productSelect = document.getElementById('product');
const quantityInput = document.getElementById('quantity');
const totalInput = document.getElementById('total');
const saleForm = document.getElementById('saleForm');
const saleSuccess = document.getElementById('saleSuccess');
const productError = document.getElementById('productError');
const quantityError = document.getElementById('quantityError');
const productCount = document.getElementById('productCount');
const totalSales = document.getElementById('totalSales');
const currentProgress = document.getElementById('currentProgress');
const reportBtn = document.getElementById('reportBtn');
const reportModal = document.getElementById('reportModal');
const closeModal = document.getElementById('closeModal');
const cancelReport = document.getElementById('cancelReport');
const salesHistory = document.getElementById('salesHistory');
const pendingSales = document.getElementById('pendingSales');
const validateAllSales = document.getElementById('validateAllSales');
const pendingTotal = document.getElementById('pendingTotal');
const productNameInput = document.getElementById('productName');
const productSelectTwo = document.querySelector('select');
const searchSales = document.querySelector('#searchSales');
const previeseBtn = document.querySelector('.previeseBtn');
const nextBtn = document.querySelector('.nextBtn');
const currentPageDisplay = document.querySelector('.currentPageDisplay');
const totalPages = document.querySelector('.totalPages');

// Hide the message after 5 seconds
setTimeout(() => {
    const alertMessage = document.getElementById('alert-message');
    if (alertMessage) {
        alertMessage.classList.add('opacity-0');
        setTimeout(() => alertMessage.remove(), 300);
    }
}, 5000);


function switchTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('hidden');
    });

    document.getElementById(tabId).classList.remove('hidden');

    document.querySelectorAll('nav button').forEach(link => {
        link.classList.remove('bg-blue-50', 'text-blue-700');
        if (link.getAttribute('data-tab') === '#' + tabId) {
            link.classList.add('bg-blue-50', 'text-blue-700');
        }
    });
}

async function getProductSelectByName(name) {
    try {
        const response = await fetch(`/employee/products`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name })
        });
        const products = await response.json();
        console.log('Fetched products:', products);
        if (products) {
            productSelectTwo.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = '-- Sélectionner un produit --';
            productSelectTwo.appendChild(defaultOption);

            products.forEach(product => {
                const option = document.createElement('option');
                option.value = product.product_id;
                option.textContent = product.product_name;
                if (product.sale_price) {
                    option.setAttribute('data-price', product.sale_price);
                }
                productSelectTwo.appendChild(option);
            });

        }
    } catch (error) {
        console.error('Error fetching products:', error);
        return null;
    }
}


productNameInput.addEventListener('input', function () {
    if (productNameInput.value.length < 1) {
        document.getElementById('product').classList.add('hidden');
        return;
    }
    getProductSelectByName(productNameInput.value);

    document.getElementById('product').classList.remove('hidden');
});

document.addEventListener('click', function (event) {
    const input = document.getElementById('productName');
    const select = document.getElementById('product');

    if (event.target !== input && event.target !== select) {
        select.classList.add('hidden');
    }
});

document.getElementById('product').addEventListener('change', function () {
    const select = this;
    const selectedOption = select.options[select.selectedIndex];
    document.getElementById('productName').value = selectedOption.text;
    select.classList.add('hidden');

    if (typeof calculateTotal === 'function') {
        calculateTotal();
    }
});

let pendingSalesArray = [];

function calculateTotal() {
    const selectedOption = productSelect.options[productSelect.selectedIndex];
    if (selectedOption.value) {
        const price = parseFloat(selectedOption.getAttribute('data-price'));
        const quantity = parseInt(quantityInput.value) || 0;
        const total = price * quantity;
        totalInput.value = total.toFixed(2);
    } else {
        totalInput.value = '';
    }
}

productSelect.addEventListener('change', calculateTotal);
quantityInput.addEventListener('input', calculateTotal);

function updatePendingSalesTable() {
    if (pendingSalesArray.length === 0) {
        pendingSales.innerHTML = `
      <tr class="text-center text-gray-500 py-4">
        <td colspan="4" class="py-4">Aucune vente en attente</td>
      </tr>
    `;
        validateAllSales.disabled = true;
        pendingTotal.textContent = "0.00 MAD";
        return;
    }

    validateAllSales.disabled = false;
    pendingSales.innerHTML = '';

    let totalAmount = 0;

    pendingSalesArray.forEach((sale, index) => {
        totalAmount += sale.total;

        let iconBg = 'bg-blue-100';
        let iconColor = 'text-blue-600';
        let iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>';

        if (sale.productName.includes('Ordinateur')) {
            iconBg = 'bg-emerald-100';
            iconColor = 'text-emerald-600';
            iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" /></svg>';
        } else if (sale.productName.includes('Écouteurs')) {
            iconBg = 'bg-indigo-100';
            iconColor = 'text-indigo-600';
            iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>';
        }

        const row = document.createElement('tr');
        row.innerHTML = `
      <td class="px-4 py-3 whitespace-nowrap">
        <div class="flex items-center">
          <div class="flex-shrink-0 h-8 w-8 rounded-full ${iconBg} flex items-center justify-center ${iconColor}">
            ${iconSvg}
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-gray-900">${sale.productName}</p>
          </div>
        </div>
      </td>
      <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">${sale.quantity}</td>
      <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">${sale.total.toFixed(2)} MAD</td>
      <td class="px-4 py-3 whitespace-nowrap text-sm">
        <button class="text-red-500 hover:text-red-700" onclick="removePendingSale(${index})">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </button>
      </td>
    `;

        pendingSales.appendChild(row);
    });

    pendingTotal.textContent = totalAmount.toFixed(2) + " MAD";
}

window.removePendingSale = function (index) {
    pendingSalesArray.splice(index, 1);
    updatePendingSalesTable();
};




saleForm.addEventListener('submit', function (event) {
    event.preventDefault();

    let valid = true;

    if (!productSelect.value) {
        productError.classList.remove('hidden');
        valid = false;
    } else {
        productError.classList.add('hidden');
    }

    const quantity = parseInt(quantityInput.value);
    if (!quantity || quantity < 1) {
        quantityError.classList.remove('hidden');
        valid = false;
    } else {
        quantityError.classList.add('hidden');
    }

    if (valid) {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const productName = selectedOption.text;
        const total = parseFloat(totalInput.value);

        pendingSalesArray.push({
            productId: selectedOption.value,
            productName: productName,
            quantity: quantity,
            total: total
        });

        updatePendingSalesTable();

        productSelect.value = '';
        quantityInput.value = '1';
        totalInput.value = '';
        productNameInput.value = '';
    }
});


async function fetchData(key = null, page = 1) {
    try {
        const response = await fetch(`/employee/sales`, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({key})
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        const pagination = paginateData(data, page);
        currentPageDisplay.textContent = pagination.currentPage;
        totalPages.textContent = pagination.totalPages;

        console.log('Fetched data:', pagination.items);
        const saleTbody = document.getElementById('saleTbody');
        hundlePaginationNumbers(pagination);
        saleTbody.innerHTML = '';
        pagination.items.forEach(sale => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#VNT-2025-${sale.sale_id}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${sale.date}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${sale.product_name}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${sale.quantity}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">${sale.total} MAD</td>
            `;
            saleTbody.appendChild(row);
        });
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
        throw error;
    }
}


function paginateData(data, currentPage = 1) {
    const itemsPerPage = 7; 

    // Calculate pagination values
    const totalItems = data.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, totalItems);

    // Get paginated items
    const paginatedItems = data.slice(startIndex, endIndex);

    return {
        currentPage,
        itemsPerPage,
        totalItems,
        totalPages,
        hasNextPage: currentPage < totalPages,
        hasPreviousPage: currentPage > 1,
        items: paginatedItems
    };
}

function hundlePaginationNumbers(pagination) {
    const paginationNumbers = document.querySelector('.pagination-numbers');
    paginationNumbers.innerHTML = '';

    for (let i = 1; i <= pagination.totalPages; i++) {
        const pageButton = document.createElement('button');
        pageButton.textContent = i;
        pageButton.classList.add('px-4', 'py-2', 'mx-1', 'border', 'rounded-md', 'text-sm', 'font-medium', 'text-gray-700', 'bg-white', 'hover:bg-gray-100');
        pageButton.addEventListener('click', function () {
            fetchData(null, i);
        });
        if (i === pagination.currentPage) {
            pageButton.classList.add('bg-blue-500', 'text-white');
        }
        paginationNumbers.appendChild(pageButton);
    }
}


reportBtn.addEventListener('click', function () {
    reportModal.classList.remove('hidden');
});

closeModal.addEventListener('click', function () {
    reportModal.classList.add('hidden');
});

cancelReport.addEventListener('click', function () {
    reportModal.classList.add('hidden');
});

previeseBtn.addEventListener('click', function () {
    const currentPage = parseInt(currentPageDisplay.textContent);
    if (currentPage > 1) {
        fetchData(null, currentPage - 1);
    }
});

nextBtn.addEventListener('click', function () {
    const currentPage = parseInt(currentPageDisplay.textContent);
    const totalPages = document.querySelector('.totalPages');

    const totalPagess = parseInt(totalPages.textContent);
    if (currentPage < totalPagess) {
        fetchData(null, currentPage + 1);
    }
});

searchSales.addEventListener('input', function () {
    const searchKey = searchSales.value;
    if (searchKey.length > 0) {
        console.log('Searching for:', searchKey);
        fetchData(searchKey);
    } else {
        fetchData();
    }
});

// Close modal when clicking outside
window.addEventListener('click', function (event) {
    if (event.target === reportModal) {
        reportModal.classList.add('hidden');
    }
});

calculateTotal();
fetchData();
updatePendingSalesTable();
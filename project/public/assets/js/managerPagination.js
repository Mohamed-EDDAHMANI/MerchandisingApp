async function fetchData(key = null, page = 1) {
    if (key === null) {
        key = searchSales.value;
    }
    try {
        const response = await fetch(`/employee/sales`, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ key })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        const pagination = paginateData(data, page);
        currentPageDisplay.textContent = pagination.currentPage;
        totalPages.textContent = pagination.totalPages;

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
    const totalItems = data.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, totalItems);
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
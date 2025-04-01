// Hide the message after 5 seconds
setTimeout(() => {
    const alertMessage = document.getElementById('alert-message');
    if (alertMessage) {
        alertMessage.classList.add('opacity-0');
        setTimeout(() => alertMessage.remove(), 300);
    }
}, 5000);

// Toggle form visibility and button styles
const toggleFormBtn = document.getElementById('toggle-form');
const storeForm = document.getElementById('store-form');
const cancelFormBtn = document.getElementById('cancel-form');

toggleFormBtn.addEventListener('click', () => {
    storeForm.classList.toggle('hidden');
    toggleFormBtn.classList.toggle('bg-blue-600');
    toggleFormBtn.classList.toggle('bg-red-600');

    if (!storeForm.classList.contains('hidden')) {
        toggleFormBtn.innerHTML = '<i class="fas fa-times mr-2"></i>Annuler';
    } else {
        toggleFormBtn.innerHTML = '<i class="fas fa-plus mr-2"></i>Nouveau Point de Vente';
    }
});

cancelFormBtn.addEventListener('click', () => {
    storeForm.classList.add('hidden');
    toggleFormBtn.classList.remove('bg-red-600');
    toggleFormBtn.classList.add('bg-blue-600');
    toggleFormBtn.innerHTML = '<i class="fas fa-plus mr-2"></i>Nouveau Point de Vente';
});

// Delete store modal functionality
const deleteButtons = document.querySelectorAll('.delete-store');
const deleteModal = document.getElementById('delete-modal');
const cancelDeleteBtn = document.getElementById('cancel-delete');
const confirmDeleteBtn = document.getElementById('confirm-delete');
const confirmDeleteForm = document.getElementById('confirm-delete-form');

function deleteModel(id) {
    deleteModal.classList.remove('hidden');
    confirmDeleteForm.action = `/admin/points-de-vente/delete/${id}`;
}

cancelDeleteBtn.addEventListener('click', () => {
    deleteModal.classList.add('hidden');
});
// Edit store modal functionality
const editButtons = document.querySelectorAll('.edit-store');
const updateModal = document.getElementById('update-modal');
const cancelUpdateBtn = document.getElementById('cancel-update');
const closeUpdateBtn = document.getElementById('close-update');


async function getStoreById(storeId) {
    try {
        const response = await fetch(`/admin/points-de-vente/${storeId}`, {
            method: 'GET',
        });

        if (!response.ok) {
            throw new Error('Failed to fetch store data');
        }
        const store = await response.json();
        return store[0];
    } catch (error) {
        console.error('Error fetching store data:', error);
    }
}


async function updateModel(storeId) {
    const store = await getStoreById(storeId);
    updateModal.classList.remove('hidden');
    const action = `/admin/points-de-vente/update/${storeId}`
    document.getElementById('update-store-form').action = action;

    document.getElementById('update-store-name').value = store.store_name || '';
    document.getElementById('update-store-address').value = store.address || '';
    document.getElementById('update-store-city').value = store.city || '';
    document.getElementById('update-store-status').value = store.status || null;
    document.getElementById('update-store-parking').checked = store.parking_space || false;
}

cancelUpdateBtn.addEventListener('click', () => {
    updateModal.classList.add('hidden');
});

closeUpdateBtn.addEventListener('click', () => {
    updateModal.classList.add('hidden');
});

const recherchInput = document.getElementById('recherch-input');
const storesTableBody = document.getElementById('stores-table-body');

recherchInput.addEventListener('change', async () => {
    const value = recherchInput.value;
    try {
        const response = await fetch("/admin/points-de-vente", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ searchTerm: value }) 
        });
        if (!response.ok) throw new Error("Failed to fetch stores");

        const stores = await response.json();
        console.log(stores);
        storesTableBody.innerHTML = ""; 

        stores.forEach(store => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="h-8 w-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-3">
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-900">
                            ${store.name}  <!-- Using store.name from the fetched data -->
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">${store.address}</div>  <!-- Using store.address -->
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="h-6 w-6 rounded-full bg-gray-200 flex items-center justify-center mr-2 text-xs font-medium text-gray-700">
                            ${store.city.substring(0, 2).toUpperCase()}  <!-- First two letters of the city -->
                        </div>
                        <div class="text-sm text-gray-500">${store.city}</div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    ${store.status === 'active' ? `
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            <i class="fas fa-circle text-green-500 mr-1 text-xs"></i> Actif
                        </span>
                    ` : store.status === 'inactive' ? `
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            <i class="fas fa-circle text-red-500 mr-1 text-xs"></i> Inactif
                        </span>
                    ` : `
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            <i class="fas fa-circle text-yellow-500 mr-1 text-xs"></i> En attente
                        </span>
                    `}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="p-1.5 rounded-lg text-blue-600 hover:bg-blue-50 mr-2 edit-store"
                        onclick="updateModel(${store.id})" title="Modifier">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="p-1.5 rounded-lg text-red-600 hover:bg-red-50 delete-store"
                        onclick="deleteModel(${store.id})" title="Supprimer">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            `;
            storesTableBody.appendChild(row);
        });
    } catch (error) {
        console.error("Error fetching stores:", error);
    }
});


// Search functionality
const searchInput = document.querySelector('input[placeholder="Rechercher..."]');
searchInput.addEventListener('input', (e) => {
    const searchTerm = e.target.value.toLowerCase();
    const tableRows = document.querySelectorAll('#stores-table-body tr');

    tableRows.forEach(row => {
        const name = row.querySelector('td:nth-child(1) .text-sm.font-medium').textContent.toLowerCase();
        const address = row.querySelector('td:nth-child(2) div').textContent.toLowerCase();
        const manager = row.querySelector('td:nth-child(3) .text-sm.text-gray-500').textContent.toLowerCase();

        if (name.includes(searchTerm) || address.includes(searchTerm) || manager.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Mobile sidebar toggle
const mobileMenuButton = document.querySelector('.md\\:hidden button');
const sidebar = document.querySelector('aside');

mobileMenuButton.addEventListener('click', () => {
    sidebar.classList.toggle('hidden');
    sidebar.classList.toggle('flex');
});

// Close modal when clicking outside of it
window.addEventListener('click', (e) => {
    if (e.target === deleteModal) {
        deleteModal.classList.add('hidden');
    }
    if (e.target === updateModal) {
        updateModal.classList.add('hidden');
    }
});
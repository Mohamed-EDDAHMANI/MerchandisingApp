const toggleFormBtn = document.getElementById('toggle-form');
const storeForm = document.getElementById('store-form');
const cancelFormBtn = document.getElementById('cancel-form');
const saveStoreBtn = document.getElementById('save-store');

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

// Delete store functionality
const deleteButtons = document.querySelectorAll('.delete-store');
const deleteModal = document.getElementById('delete-modal');
const cancelDeleteBtn = document.getElementById('cancel-delete');
const confirmDeleteBtn = document.getElementById('confirm-delete');
let storeToDeleteId = null;

deleteButtons.forEach(button => {
    button.addEventListener('click', () => {
        storeToDeleteId = button.getAttribute('data-id');
        deleteModal.classList.remove('hidden');
    });
});

cancelDeleteBtn.addEventListener('click', () => {
    deleteModal.classList.add('hidden');
    storeToDeleteId = null;
});

confirmDeleteBtn.addEventListener('click', () => {
    // Here you would typically make an API call to delete the store
    console.log(`Deleting store with ID: ${storeToDeleteId}`);

    // For the demo, we'll just remove the row from the table
    if (storeToDeleteId) {
        const storeRow = document.querySelector(`.delete-store[data-id="${storeToDeleteId}"]`).closest('tr');
        storeRow.remove();

        // Update the store count
        updateStoreCount();

        // Close the modal
        deleteModal.classList.add('hidden');
        storeToDeleteId = null;
    }
});

// Edit store functionality
const editButtons = document.querySelectorAll('.edit-store');
const updateModal = document.getElementById('update-modal');
const cancelUpdateBtn = document.getElementById('cancel-update');
const closeUpdateBtn = document.getElementById('close-update');
const updateStoreForm = document.getElementById('update-store-form');
let storeToUpdateId = null;

editButtons.forEach(button => {
    button.addEventListener('click', () => {
        storeToUpdateId = button.getAttribute('data-id');

        // Get the store data from the table row
        const storeRow = button.closest('tr');
        const storeName = storeRow.querySelector('td:nth-child(1) .text-sm.font-medium').textContent;
        const storeAddress = storeRow.querySelector('td:nth-child(2) div').textContent;
        const storeManager = storeRow.querySelector('td:nth-child(3) .text-sm.text-gray-500').textContent;
        const storePhone = storeRow.querySelector('td:nth-child(4) div').textContent;
        const storeStatus = storeRow.querySelector('td:nth-child(5) span').textContent.trim().includes('Actif') ? 'active' : 'inactive';

        // Populate the update form
        document.getElementById('update-store-name').value = storeName;
        document.getElementById('update-store-address').value = storeAddress.split(', ')[0] || '';
        document.getElementById('update-store-city').value = storeAddress.split(', ')[1] || '';
        document.getElementById('update-store-manager').value = storeManager;
        document.getElementById('update-store-phone').value = storePhone;
        document.getElementById('update-store-status').value = storeStatus;

        // Show the modal
        updateModal.classList.remove('hidden');
    });
});

cancelUpdateBtn.addEventListener('click', () => {
    updateModal.classList.add('hidden');
    storeToUpdateId = null;
});

closeUpdateBtn.addEventListener('click', () => {
    updateModal.classList.add('hidden');
    storeToUpdateId = null;
});

updateStoreForm.addEventListener('submit', (e) => {
    e.preventDefault();

    // Get the updated values
    const name = document.getElementById('update-store-name').value;
    const address = document.getElementById('update-store-address').value;
    const city = document.getElementById('update-store-city').value;
    const manager = document.getElementById('update-store-manager').value;
    const phone = document.getElementById('update-store-phone').value;
    const status = document.getElementById('update-store-status').value;

    // Here you would typically make an API call to update the store
    console.log(`Updating store with ID: ${storeToUpdateId}`);

    // For the demo, we'll just update the row in the table
    if (storeToUpdateId) {
        const storeRow = document.querySelector(`.edit-store[data-id="${storeToUpdateId}"]`).closest('tr');

        storeRow.querySelector('td:nth-child(1) .text-sm.font-medium').textContent = name;
        storeRow.querySelector('td:nth-child(2) div').textContent = `${address}, ${city}`;
        storeRow.querySelector('td:nth-child(3) .text-sm.text-gray-500').textContent = manager;
        storeRow.querySelector('td:nth-child(4) div').textContent = phone;

        const statusSpan = storeRow.querySelector('td:nth-child(5) span');
        if (status === 'active') {
            statusSpan.innerHTML = '<i class="fas fa-circle text-green-500 mr-1 text-xs"></i> Actif';
            statusSpan.classList.remove('bg-red-100', 'text-red-800');
            statusSpan.classList.add('bg-green-100', 'text-green-800');
        } else {
            statusSpan.innerHTML = '<i class="fas fa-circle text-red-500 mr-1 text-xs"></i> Inactif';
            statusSpan.classList.remove('bg-green-100', 'text-green-800');
            statusSpan.classList.add('bg-red-100', 'text-red-800');
        }

        // Close the modal
        updateModal.classList.add('hidden');
        storeToUpdateId = null;
    }
});

// Add new store functionality
saveStoreBtn.addEventListener('click', (e) => {
    e.preventDefault();

    // Get the form values
    const name = document.getElementById('store-name').value;
    const address = document.getElementById('store-address').value;
    const city = document.getElementById('store-city').value;
    const manager = document.getElementById('store-manager').value;
    const phone = document.getElementById('store-phone').value;
    const status = document.getElementById('store-status').value;

    // Here you would typically make an API call to create the store
    console.log('Creating new store:', { name, address, city, manager, phone, status });

    // For the demo, we'll just add a new row to the table
    const tableBody = document.getElementById('stores-table-body');
    const newRow = document.createElement('tr');
    newRow.className = 'hover:bg-gray-50 transition-colors';

    // Generate a new ID (for demo purposes)
    const newId = document.querySelectorAll('.delete-store').length + 1;

    // Get initials for the manager avatar
    const initials = manager.split(' ').map(part => part.charAt(0)).join('');

    newRow.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="h-8 w-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-3">
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-900">${name}</div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">${address}, ${city}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="h-6 w-6 rounded-full bg-gray-200 flex items-center justify-center mr-2 text-xs font-medium text-gray-700">${initials}</div>
                        <div class="text-sm text-gray-500">${manager}</div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">${phone}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                        <i class="fas fa-circle ${status === 'active' ? 'text-green-500' : 'text-red-500'} mr-1 text-xs"></i>
                        ${status === 'active' ? 'Actif' : 'Inactif'}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="p-1.5 rounded-lg text-blue-600 hover:bg-blue-50 mr-2 edit-store" data-id="${newId}" title="Modifier">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="p-1.5 rounded-lg text-red-600 hover:bg-red-50 delete-store" data-id="${newId}" title="Supprimer">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            `;

    // Add the new row to the table
    tableBody.appendChild(newRow);

    // Add event listeners to the new buttons
    const newEditButton = newRow.querySelector('.edit-store');
    const newDeleteButton = newRow.querySelector('.delete-store');

    newEditButton.addEventListener('click', () => {
        storeToUpdateId = newEditButton.getAttribute('data-id');

        // Get the store data from the table row
        const storeRow = newEditButton.closest('tr');
        const storeName = storeRow.querySelector('td:nth-child(1) .text-sm.font-medium').textContent;
        const storeAddress = storeRow.querySelector('td:nth-child(2) div').textContent;
        const storeManager = storeRow.querySelector('td:nth-child(3) .text-sm.text-gray-500').textContent;
        const storePhone = storeRow.querySelector('td:nth-child(4) div').textContent;
        const storeStatus = storeRow.querySelector('td:nth-child(5) span').textContent.trim().includes('Actif') ? 'active' : 'inactive';

        // Populate the update form
        document.getElementById('update-store-name').value = storeName;
        document.getElementById('update-store-address').value = storeAddress.split(', ')[0] || '';
        document.getElementById('update-store-city').value = storeAddress.split(', ')[1] || '';
        document.getElementById('update-store-manager').value = storeManager;
        document.getElementById('update-store-phone').value = storePhone;
        document.getElementById('update-store-status').value = storeStatus;

        // Show the modal
        updateModal.classList.remove('hidden');
    });

    newDeleteButton.addEventListener('click', () => {
        storeToDeleteId = newDeleteButton.getAttribute('data-id');
        deleteModal.classList.remove('hidden');
    });

    // Reset the form fields
    document.getElementById('store-name').value = '';
    document.getElementById('store-address').value = '';
    document.getElementById('store-city').value = '';
    document.getElementById('store-manager').value = '';
    document.getElementById('store-phone').value = '';
    document.getElementById('store-status').value = 'active';

    // Hide the form
    storeForm.classList.add('hidden');
    toggleFormBtn.classList.remove('bg-red-600');
    toggleFormBtn.classList.add('bg-blue-600');
    toggleFormBtn.innerHTML = '<i class="fas fa-plus mr-2"></i>Nouveau Point de Vente';

    // Update the store count
    updateStoreCount();
});

// Function to update the store count
function updateStoreCount() {
    const totalStores = document.querySelectorAll('#stores-table-body tr').length;
    const activeStores = document.querySelectorAll('#stores-table-body tr td:nth-child(5) span.bg-green-100').length;
    const inactiveStores = totalStores - activeStores;

    document.getElementById('total-stores').textContent = totalStores;
    document.querySelector('.bg-green-500 + div .text-3xl').textContent = activeStores;
    document.querySelector('.bg-red-500 + div .text-3xl').textContent = inactiveStores;
}

// Initialize the store count
updateStoreCount();

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
        storeToDeleteId = null;
    }
    if (e.target === updateModal) {
        updateModal.classList.add('hidden');
        storeToUpdateId = null;
    }
});
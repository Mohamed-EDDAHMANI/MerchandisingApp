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

deleteButtons.forEach(button => {
    button.addEventListener('click', () => {
        deleteModal.classList.remove('hidden');
    });
});

cancelDeleteBtn.addEventListener('click', () => {
    deleteModal.classList.add('hidden');
});

confirmDeleteBtn.addEventListener('click', () => {
    // Here you would typically make an API call to delete the store
    deleteModal.classList.add('hidden');
});

// Edit store modal functionality
const editButtons = document.querySelectorAll('.edit-store');
const updateModal = document.getElementById('update-modal');
const cancelUpdateBtn = document.getElementById('cancel-update');
const closeUpdateBtn = document.getElementById('close-update');

editButtons.forEach(button => {
    button.addEventListener('click', () => {
        updateModal.classList.remove('hidden');
    });
});

cancelUpdateBtn.addEventListener('click', () => {
    updateModal.classList.add('hidden');
});

closeUpdateBtn.addEventListener('click', () => {
    updateModal.classList.add('hidden');
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
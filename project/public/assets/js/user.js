// Hide the message after 5 seconds
setTimeout(() => {
    const alertMessage = document.getElementById('alert-message');
    if (alertMessage) {
        alertMessage.classList.add('opacity-0');
        setTimeout(() => alertMessage.remove(), 300);
    }
}, 5000);

// DOM Elements
const userFormModal = document.getElementById('userFormModal');
const userDetailsModal = document.getElementById('userDetailsModal');
const openFormBtn = document.getElementById('openFormBtn');
const closeFormBtn = document.getElementById('closeFormBtn');
const cancelBtn = document.getElementById('cancelBtn');
const closeDetailsBtn = document.getElementById('closeDetailsBtn');
const closeDetailsBtnBottom = document.getElementById('closeDetailsBtnBottom');
const userForm = document.getElementById('userForm');
const modalTitle = document.getElementById('modalTitle');
const viewBtns = document.querySelectorAll('.viewBtn');
const editBtns = document.querySelectorAll('.editBtn');
const toggleStatusBtns = document.querySelectorAll('.toggleStatusBtn');

document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle the icon
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
});

// Open form modal for new user
openFormBtn.addEventListener('click', () => {
    document.getElementById('userForm').action = `/admin/utilisateurs/create`;
    let select = document.getElementById('roleContainer').classList.remove('hidden');
    modalTitle.textContent = 'Ajouter un utilisateur';
    document.getElementById('userId').value = '';
    userForm.reset();
    document.getElementById('isValid').checked = true;
    userFormModal.classList.remove('hidden');
});

// Close form modal
closeFormBtn.addEventListener('click', () => {
    userFormModal.classList.add('hidden');
});

cancelBtn.addEventListener('click', () => {
    userFormModal.classList.add('hidden');
});

// Close details modal
closeDetailsBtn.addEventListener('click', () => {
    userDetailsModal.classList.add('hidden');
});

closeDetailsBtnBottom.addEventListener('click', () => {
    userDetailsModal.classList.add('hidden');
});


async function getUserById(userId) {
    try {
        // Fetch user data from the backend
        const response = await fetch(`/admin/utilisateur/${userId}`, {
            method: 'GET',
        });

        if (!response.ok) {
            throw new Error('Failed to fetch user data');
        }
        const user = await response.json();
        return user;
    } catch (error) {
        console.error('Error fetching user data:', error);
    }
}

// View user details
async function showDetailsModal(userId) {
    const user = await getUserById(userId)
    if (user) {
        console.log(`here : ${user}`)
        document.getElementById('detailName').textContent = `${user.first_name} ${user.last_name}`;
        document.getElementById('detailEmail').textContent = user.email;
        document.getElementById('detailRole').textContent = user.role_name;
        document.getElementById('detailStore').textContent = user.store_name;
        document.getElementById('detailSalary').textContent = `${user.salary} DH`;
        document.getElementById('detailStatus').textContent = user.isValid ? 'Actif' : 'Inactif';
        const deleteBtn = document.getElementById('deleteEmployeeBtn');
        const deleteUrl = `/admin/utilisateurs/delete/${userId}`;
        deleteBtn.setAttribute('href', deleteUrl);
        console.log(`Delete URL set to: ${deleteUrl}`);
        userDetailsModal.classList.remove('hidden');
    }
}
// Edit user
async function showModifyModal(userId) {
    document.getElementById('userForm').action = `/admin/utilisateurs/update/${userId}`;
    document.getElementById('password').name = 'passwordUpdate';
    document.getElementById('roleContainer').classList = 'hidden';
    const user = await getUserById(userId)
    if (user) {
        modalTitle.textContent = 'Modifier un utilisateur';
        document.getElementById('userId').value = user.id;
        document.getElementById('firstName').value = user.first_name;
        document.getElementById('lastName').value = user.last_name;
        document.getElementById('email').value = user.email;
        document.getElementById('role_select').value = user.role_name;
        document.getElementById('salary').value = user.salary;
        document.getElementById('isValid').checked = user.is_valid;

        let storeSelect = document.getElementById('store');
        for (let option of storeSelect.options) {
            if (option.textContent == user.store_name) {
                option.selected = true;
                break;
            }
        }

    }
    userFormModal.classList.remove('hidden');
}


// Toggle user status
function toggleStatus() {
    toggleStatusBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const userId = parseInt(btn.getAttribute('data-id'));
            const currentStatus = btn.getAttribute('data-status') === 'true';

            if (user) {
                user.isValid = !currentStatus;

                // Update button and UI
                btn.setAttribute('data-status', (!currentStatus).toString());

                if (!currentStatus) {
                    btn.innerHTML = '<i class="fas fa-user-times"></i>';
                    btn.classList.remove('text-green-600', 'hover:text-green-900');
                    btn.classList.add('text-red-600', 'hover:text-red-900');
                } else {
                    btn.innerHTML = '<i class="fas fa-user-check"></i>';
                    btn.classList.remove('text-red-600', 'hover:text-red-900');
                    btn.classList.add('text-green-600', 'hover:text-green-900');
                }

                // Update status in the table
                const row = btn.closest('tr');
                const statusCell = row.querySelector('td:nth-child(6)');
                if (statusCell) {
                    statusCell.innerHTML = `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${user.isValid ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">${user.isValid ? 'Actif' : 'Inactif'}</span>`;
                }
            }
        });
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const roleFilter = document.getElementById("roleFilter");
    const storeFilter = document.getElementById("storeFilter");
    const statusFilter = document.getElementById("statusFilter");

    // Function to fetch users based on filters
    async function fetchUsers() {
        const filters = {};

        if (roleFilter.value) filters.role = roleFilter.value;
        if (storeFilter.value) filters.store = storeFilter.value;
        if (statusFilter.value) filters.is_valid = statusFilter.value;

        try {
            const response = await fetch("/admin/utilisateurs", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(filters)
            });
            if (!response.ok) throw new Error("Failed to fetch users");

            const users = await response.json();
            // console.log(users);
            usersTableBody.innerHTML = "";

            (Array.isArray(users) ? users : []).forEach(user => {
                const row = document.createElement("tr");
                row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="ml-1">
                                    <div class="text-sm font-medium text-gray-900">
                                        ${user.first_name} ${user.last_name}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${user.email}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${user.role_name === 'manager' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'}">
                                ${user.role_name}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            ${user.store_name ? user.store_name : 'Not assigned'}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            ${user.role_name === 'manager' ? user.manager_salary : user.employee_salary} DH
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                ${user.role_name === 'manager'
                        ? (user.manager_valid ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')
                        : (user.employee_valid ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')}">
                                ${user.role_name === 'manager'
                        ? (user.manager_valid ? 'Actif' : 'Inactif')
                        : (user.employee_valid ? 'Actif' : 'Inactif')}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-indigo-600 hover:text-indigo-900 mr-3 viewBtn" onclick="showDetailsModal(${user.user_id})"><i class="fas fa-eye"></i></button>
                            <button class="text-yellow-600 hover:text-yellow-900 mr-3 editBtn" onclick="showModifyModal(${user.user_id})"><i class="fas fa-edit"></i></button>
                            <form action="/admin/utilisateurs/toggle/${user.user_id}"
                                  method="POST" class="inline-block m-0">
                                <button type="submit"
                                        class="text-red-600 hover:text-red-900 toggleStatusBtn"
                                        data-id="${user.user_id}" 
                                        data-status="true">
                                    ${user.role_name === 'manager'
                        ? `<i class="fas ${user.manager_valid ? 'fa-user-check text-green-500' : 'fa-user-times'}"></i>`
                        : `<i class="fas ${user.employee_valid ? 'fa-user-check text-green-500' : 'fa-user-times'}"></i>`
                    }
                                </button>
                            </form>
                        </td>
                    `;

                usersTableBody.appendChild(row);

            });


        } catch (error) {
            console.error("Error fetching users:", error);
        }
    }

    // Listen for changes in filters
    [roleFilter, storeFilter, statusFilter].forEach((input) => {
        input.addEventListener("change", fetchUsers);
    });

});
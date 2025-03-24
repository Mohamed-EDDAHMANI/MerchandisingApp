
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
            console.log(urlParams)
            const [path, fragment] = urlParams.split("#");
            switch (fragment) {
                case 'categories':
                    const categoryButton = document.getElementById('categoriesBtn');
                    categoryButton.click();
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

        // Close modal when clicking outside
        window.addEventListener('click', function (event) {
            document.querySelectorAll('.fixed.inset-0').forEach(modal => {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });

        // Generate PDF function
        function generatePDF() {
            alert('Generating PDF... This would create a PDF of the order in a real application.');
            // In a real application, this would use jsPDF to generate a PDF
        }

        // Initialize charts when the page loads
        document.addEventListener('DOMContentLoaded', function () {
            // Sales Chart
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Sales',
                        data: [12000, 19000, 15000, 25000, 22000, 30000],
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 2,
                        tension: 0.3
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Category Chart
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            const categoryChart = new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Electronics', 'Clothing', 'Home & Kitchen', 'Books', 'Others'],
                    datasets: [{
                        data: [35, 25, 20, 15, 5],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(16, 185, 129, 0.7)',
                            'rgba(245, 158, 11, 0.7)',
                            'rgba(239, 68, 68, 0.7)',
                            'rgba(107, 114, 128, 0.7)'
                        ],
                        borderWidth: 1
                    }]
                }
            });

            // Employee Performance Chart
            if (document.getElementById('employeePerformanceChart')) {
                const empCtx = document.getElementById('employeePerformanceChart').getContext('2d');
                const empChart = new Chart(empCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Jane Smith', 'Mike Johnson', 'Lisa Chen', 'David Wilson', 'Sarah Brown'],
                        datasets: [{
                            label: 'Performance Score',
                            data: [97.5, 85.2, 76.8, 88.4, 92.1],
                            backgroundColor: [
                                'rgba(16, 185, 129, 0.7)',
                                'rgba(59, 130, 246, 0.7)',
                                'rgba(245, 158, 11, 0.7)',
                                'rgba(59, 130, 246, 0.7)',
                                'rgba(16, 185, 129, 0.7)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100
                            }
                        }
                    }
                });
            }

            // Stock Level Chart
            if (document.getElementById('stockLevelChart')) {
                const stockCtx = document.getElementById('stockLevelChart').getContext('2d');
                const stockChart = new Chart(stockCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Electronics', 'Clothing', 'Home & Kitchen', 'Books', 'Others'],
                        datasets: [{
                            label: 'Current Stock',
                            data: [120, 85, 65, 40, 30],
                            backgroundColor: 'rgba(59, 130, 246, 0.7)',
                            borderWidth: 1
                        }, {
                            label: 'Reorder Level',
                            data: [50, 40, 30, 20, 15],
                            backgroundColor: 'rgba(239, 68, 68, 0.7)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            // Reports Charts
            if (document.getElementById('salesByCategoryChart')) {
                const salesCatCtx = document.getElementById('salesByCategoryChart').getContext('2d');
                const salesCatChart = new Chart(salesCatCtx, {
                    type: 'pie',
                    data: {
                        labels: ['Electronics', 'Clothing', 'Home & Kitchen', 'Books', 'Others'],
                        datasets: [{
                            data: [45, 20, 15, 10, 10],
                            backgroundColor: [
                                'rgba(59, 130, 246, 0.7)',
                                'rgba(16, 185, 129, 0.7)',
                                'rgba(245, 158, 11, 0.7)',
                                'rgba(239, 68, 68, 0.7)',
                                'rgba(107, 114, 128, 0.7)'
                            ],
                            borderWidth: 1
                        }]
                    }
                });

                const revenueCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
                const revenueChart = new Chart(revenueCtx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                        datasets: [{
                            label: 'Revenue',
                            data: [15000, 22000, 18000, 30000, 25000, 35000],
                            backgroundColor: 'rgba(16, 185, 129, 0.2)',
                            borderColor: 'rgba(16, 185, 129, 1)',
                            borderWidth: 2,
                            tension: 0.3
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
                const topProductsChart = new Chart(topProductsCtx, {
                    type: 'horizontalBar',
                    data: {
                        labels: ['Smartphone X', 'Laptop Pro', 'Wireless Earbuds', 'Smart Watch', 'Tablet Mini'],
                        datasets: [{
                            label: 'Units Sold',
                            data: [502, 342, 281, 184, 156],
                            backgroundColor: 'rgba(59, 130, 246, 0.7)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        scales: {
                            x: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                const employeeCtx = document.getElementById('employeeChart').getContext('2d');
                const employeeChart = new Chart(employeeCtx, {
                    type: 'radar',
                    data: {
                        labels: ['Sales', 'Customer Service', 'Attendance', 'Product Knowledge', 'Team Work'],
                        datasets: [{
                            label: 'Jane Smith',
                            data: [95, 90, 100, 85, 95],
                            backgroundColor: 'rgba(16, 185, 129, 0.2)',
                            borderColor: 'rgba(16, 185, 129, 1)',
                            borderWidth: 2
                        }, {
                            label: 'Mike Johnson',
                            data: [85, 95, 80, 90, 85],
                            backgroundColor: 'rgba(59, 130, 246, 0.2)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            r: {
                                beginAtZero: true,
                                max: 100
                            }
                        }
                    }
                });
            }
        });
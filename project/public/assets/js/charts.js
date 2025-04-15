
async function fetchSalesData() {
    try {
        const response = await fetch('/manager/sales');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}
async function fetchCategoriesData() {
    try {
        const response = await fetch('/manager/categories');
        const data = await response.json();
        console.log('Data fetched:', data);
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}



document.addEventListener('DOMContentLoaded', async function () {
        const salesData = await fetchSalesData();
        const salesDataPerCategories = await fetchCategoriesData();
        
        // Extract day names and sales counts from the data
        const labels = salesData.map(item => item.day_name);
        const dailySales = salesData.map(item => item.total_sales);
        
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Daily Sales',
                    data: dailySales,
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Sales'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Days of This Week'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Sales: ${context.raw}`;
                            }
                        }
                    }
                }
            }
        });

        const labelss = salesDataPerCategories.map(item => item.category_name);
        const salesDatas = salesDataPerCategories.map(item => item.total_sales_amount);
        const backgroundColors = [
            'rgba(59, 130, 246, 0.7)',
            'rgba(16, 185, 129, 0.7)',
            'rgba(245, 158, 11, 0.7)',
            'rgba(239, 68, 68, 0.7)',
            'rgba(107, 114, 128, 0.7)'
        ].slice(0, labels.length); // Use only as many colors as needed
    
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: labelss,
                datasets: [{
                    data: salesDatas,
                    backgroundColor: backgroundColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = Number(context.raw) || 0;
                                const total = context.dataset.data.reduce((a, b) => a + Number(b), 0);
                                const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                return `${context.label}: $${value.toFixed(2)} (${percentage}%)`;
                            }
                        }
                    }
                }
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
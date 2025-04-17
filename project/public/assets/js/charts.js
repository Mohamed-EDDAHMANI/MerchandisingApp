
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
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}
async function fetchEmployeeSales() {
    try {
        const response = await fetch('/manager/employees/sales');
        
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
        const employeeSales = await fetchEmployeeSales();
        
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
        ].slice(0, labels.length);
    
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

        if (document.getElementById('employeePerformanceChart')) {
            try {
                if (!employeeSales || employeeSales.error) {
                    console.error('Failed to fetch employee sales:', employeeSales?.error);
                    return;
                }
        
                const labels = employeeSales.map(emp => `${emp.first_name} ${emp.last_name}`);
                const salesData = employeeSales.map(emp => parseInt(emp.total_sales_quantity));
                const transactionsData = employeeSales.map(emp => emp.number_of_transactions);
        
                // Custom colors with better opacity and matching the design
                const salesColor = 'rgba(59, 130, 246, 0.8)';  // Vibrant blue
                const salesBorder = 'rgba(37, 99, 235, 1)';    // Darker blue border
                const transactionColor = 'rgba(16, 185, 129, 0.7)'; // Green
                const transactionBorder = 'rgba(5, 150, 105, 1)';   // Darker green border
        
                const empCtx = document.getElementById('employeePerformanceChart').getContext('2d');
                const empChart = new Chart(empCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Total Sales Quantity',
                                data: salesData,
                                backgroundColor: salesColor,
                                borderColor: salesBorder,
                                borderWidth: 1,
                                borderRadius: 4,
                                yAxisID: 'y'
                            },
                            {
                                label: 'Number of Transactions',
                                data: transactionsData,
                                backgroundColor: transactionColor,
                                borderColor: transactionBorder,
                                borderWidth: 1,
                                borderRadius: 4,
                                yAxisID: 'y1'
                            }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20,
                                    font: {
                                        size: 12
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(255, 255, 255, 0.95)',
                                titleColor: '#1f2937',
                                bodyColor: '#4b5563',
                                borderColor: '#e5e7eb',
                                borderWidth: 1,
                                padding: 12,
                                cornerRadius: 6,
                                callbacks: {
                                    label: function(context) {
                                        const label = context.dataset.label || '';
                                        const value = context.raw || 0;
                                        return `${label}: ${value}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    maxRotation: 45,
                                    minRotation: 45,
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            y: {
                                type: 'linear',
                                display: true,
                                position: 'left',
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Sales Quantity',
                                    font: {
                                        size: 12,
                                        weight: 'bold'
                                    }
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                }
                            },
                            y1: {
                                type: 'linear',
                                display: true,
                                position: 'right',
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Transactions',
                                    font: {
                                        size: 12,
                                        weight: 'bold'
                                    }
                                },
                                grid: {
                                    drawOnChartArea: false,
                                    color: 'rgba(0, 0, 0, 0.05)'
                                }
                            }
                        },
                        animation: {
                            duration: 1000,
                            easing: 'easeOutQuart'
                        },
                        layout: {
                            padding: {
                                top: 10,
                                right: 16,
                                bottom: 10,
                                left: 16
                            }
                        }
                    }
                });
        
            } catch (error) {
                console.error('Error creating chart:', error);
            }
        }
});

async function fetchPerformance() {
    try {
        const response = await fetch('/admin/stores/performance');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}
async function fetchCategoriesData() {
    try {
        const response = await fetch('/admin/stores/rentabilite');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}


document.addEventListener('DOMContentLoaded', async function () {
    $performance = await fetchPerformance();

    const cities = $performance.map(item => item.city);
    const performances = $performance.map(item => parseFloat(item.chiffre_daffaire));

    const maxPerformance = Math.max(...performances);

    // Convertir en pourcentage par rapport au max
    const performancePercent = performances.map(value =>
        maxPerformance > 0 ? (value / maxPerformance * 100).toFixed(2) : 0
    );

    // City Performance Chart
    const cityCtx = document.getElementById('cityChart').getContext('2d');
    const cityChart = new Chart(cityCtx, {
        type: 'bar',
        data: {
            labels: cities,
            datasets: [{
                label: 'Rentabilité (%)',
                data: performancePercent,
                backgroundColor: '#1d4ed8',
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Rentabilité (%)'
                    }
                }
            }
        }
    });

    // Margin Trend Chart
    const marginCtx = document.getElementById('marginChart').getContext('2d');
    const marginChart = new Chart(marginCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
                label: 'Marge moyenne (%)',
                data: [22, 24, 27, 23, 25, 28],
                fill: false,
                borderColor: '#1d4ed8',
                tension: 0.1
            }]
        },
        options: {
            responsive: true
        }
    });
});

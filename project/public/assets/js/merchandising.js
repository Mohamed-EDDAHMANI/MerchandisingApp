// Hide the message after 5 seconds
setTimeout(() => {
    const alertMessage = document.getElementById('alert-message');
    if (alertMessage) {
        alertMessage.classList.add('opacity-0');
        setTimeout(() => alertMessage.remove(), 300);
    }
}, 5000);

const store = document.querySelector('select[name="stores"]');

// Navigation between steps
document.getElementById('nextToStep2').addEventListener('click', function () {
    let timeout = 500;
    if (!store || store.value.trim() === '') {
        store.classList.add('border-red-500')
        setTimeout(() => {
            store.classList.remove('border-red-500')
        }, timeout);
    } else {
        document.getElementById('step1').classList.add('hidden');
        document.getElementById('step2').classList.remove('hidden');
        updateProgressBar(2);
        calculateHouseholds();
    }
});

document.getElementById('backToStep1').addEventListener('click', function () {
    document.getElementById('step2').classList.add('hidden');
    document.getElementById('step1').classList.remove('hidden');
    updateProgressBar(1);
});

document.getElementById('nextToStep3').addEventListener('click', function () {
    document.getElementById('step2').classList.add('hidden');
    document.getElementById('step3').classList.remove('hidden');
    updateProgressBar(3);
    calculateAverageSpending();
    updateZoneSummary();
});

document.getElementById('backToStep2').addEventListener('click', function () {
    document.getElementById('step3').classList.add('hidden');
    document.getElementById('step2').classList.remove('hidden');
    updateProgressBar(2);
});

document.getElementById('nextToStep4').addEventListener('click', function () {
    document.getElementById('step3').classList.add('hidden');
    document.getElementById('step4').classList.remove('hidden');
    updateProgressBar(4);
    calculatePotentialRevenue();
});

document.getElementById('backToStep3').addEventListener('click', function () {
    document.getElementById('step4').classList.add('hidden');
    document.getElementById('step3').classList.remove('hidden');
    updateProgressBar(3);
});

// Function to update progress bar
function updateProgressBar(step) {
    const texts = document.querySelectorAll('.flex-1 .text-sm');

    texts.forEach((text, index) => {
        if (index < step) {
            text.classList.remove('text-gray-400', 'text-blue-300', 'text-blue-400');
            text.classList.add('text-blue-600');
        } else if (index === step) {
            text.classList.remove('text-gray-400', 'text-blue-300', 'text-blue-600');
            text.classList.add('text-blue-400');
        } else if (index === step + 1) {
            text.classList.remove('text-gray-400', 'text-blue-400', 'text-blue-600');
            text.classList.add('text-blue-300');
        } else {
            text.classList.remove('text-blue-600', 'text-blue-400', 'text-blue-300');
            text.classList.add('text-gray-400');
        }
    });
}

// Calculate number of households
function calculateHouseholds() {
    const population = document.getElementById('population').value || 5000;
    const avgPersonsPerHousehold = document.getElementById('avgPersonsPerHousehold').value || 2.2;

    const households = Math.round(parseFloat(population) / parseFloat(avgPersonsPerHousehold));

    // Update the result display
    document.getElementById('householdsResult').textContent = households.toLocaleString();

    return households;
}


// Calculate average spending per household
function calculateAverageSpending() {
    const avgConsumption = parseFloat(document.getElementById('avgConsumption').value) || 0;
    const consumptionIndex = parseFloat(document.getElementById('consumptionIndex').value) || 100;

    // Calculate average spending with regional index adjustment
    const avgSpending = avgConsumption * (consumptionIndex / 100);

    // Update the result display
    document.getElementById('avgSpendingResult').textContent = avgSpending.toLocaleString() + ' €';

    return avgSpending;
}

// Update zone summary and calculate potential zone revenue
function updateZoneSummary() {
    const households = calculateHouseholds();
    const avgSpending = calculateAverageSpending();
    const evasionRate = parseFloat(document.getElementById('evasionRate').value) || 10;
    const invasionRate = parseFloat(document.getElementById('invasionRate').value) || 5;

    // Calculate theoretical revenue (before evasion/invasion)
    const theoreticalRevenue = households * avgSpending;

    // Calculate revenue adjustment due to evasion (loss) and invasion (gain)
    const evasionAdjustment = theoreticalRevenue * (evasionRate / 100);
    const invasionAdjustment = theoreticalRevenue * (invasionRate / 100);

    // Calculate potential zone revenue
    const potentialZoneRevenue = theoreticalRevenue - evasionAdjustment + invasionAdjustment;

    // Update summary displays
    document.getElementById('householdsSummary').textContent = households.toLocaleString();
    document.getElementById('avgSpendingSummary').textContent = avgSpending.toLocaleString() + ' €';
    document.getElementById('theoreticalRevenue').textContent = theoreticalRevenue.toLocaleString() + ' €';
    document.getElementById('potentialZoneRevenue').textContent = potentialZoneRevenue.toLocaleString() + ' €';

    return potentialZoneRevenue;
}

// Calculate potential store revenue and update store summary
function calculatePotentialRevenue() {
    const zoneRevenue = updateZoneSummary();
    const competitorsRevenue = parseFloat(document.getElementById('competitorsRevenue').value) || 0;

    // Calculate potential store revenue based on market share
    let availableMarket = zoneRevenue - competitorsRevenue;

    // const potentialStoreRevenue = (availableMarket * (marketShare / 100));

    // Update summary displays
    document.getElementById('zonePotentialSummary').textContent = zoneRevenue.toLocaleString() + ' €';
    document.getElementById('competitorsRevenueSummary').textContent = competitorsRevenue.toLocaleString() + ' €';
    document.getElementById('potentialStoreRevenue').textContent = availableMarket.toLocaleString() + ' €';

    // Update profitability indicator
    updateProfitabilityIndicator(availableMarket, zoneRevenue);

    return availableMarket;
}

let poursentage;
// Update the profitability indicator
function updateProfitabilityIndicator(storeRevenue, zoneRevenue) {

    if (storeRevenue == 0) {
        poursentage = 0
    } else {
        poursentage = (storeRevenue * 100) / zoneRevenue;
        console.log('store Revenue ' + storeRevenue)
        console.log('poursentage ' + poursentage)
    }
    // Cap at 100%
    if (poursentage < 0) poursentage = 0;
    if (poursentage > 100) poursentage = 100;

    console.log('poursentage ' + poursentage)
    // Update the indicator
    const indicator = document.getElementById('profitabilityIndicator');
    const percentage = document.getElementById('profitabilityPercentage');
    const message = document.getElementById('profitabilityMessage');

    indicator.style.width = poursentage + '%';
    percentage.textContent = Math.round(poursentage) + '%';

    // Set color and message based on profitability level
    if (poursentage < 30) {
        indicator.classList.remove('bg-green-500', 'bg-yellow-500');
        indicator.classList.add('bg-red-500');
        message.innerHTML = '<i class="fas fa-exclamation-circle text-red-500 mr-1"></i> Ce point de vente présente un risque élevé de non-rentabilité.';
    } else if (poursentage < 60) {
        indicator.classList.remove('bg-green-500', 'bg-red-500');
        indicator.classList.add('bg-yellow-500');
        message.innerHTML = '<i class="fas fa-exclamation-triangle text-yellow-500 mr-1"></i> Ce point de vente présente un potentiel moyen. Une analyse supplémentaire est recommandée.';
    } else {
        indicator.classList.remove('bg-yellow-500', 'bg-red-500');
        indicator.classList.add('bg-green-500');
        message.innerHTML = '<i class="fas fa-check-circle text-green-500 mr-1"></i> Ce point de vente semble avoir un bon potentiel de rentabilité.';
    }
}

async function saveMerchandisingData() {
    const data = {
        store_id: store.value,
        zone_population: document.getElementById('population').value,
        avg_household_size: document.getElementById('avgPersonsPerHousehold').value,
        nombre_menages: calculateHouseholds(),
        avg_annual_spending: calculateAverageSpending(),
        regional_wealth_index: document.getElementById('consumptionIndex').value,
        invasion: document.getElementById('invasionRate').value || 5,
        evasion: document.getElementById('evasionRate').value || 10,
        CA_potentiel_zone: updateZoneSummary(),
        competitor_revenue: document.getElementById('competitorsRevenue').value || 0,
        CA_potentiel_store: calculatePotentialRevenue(),
        result_frot: poursentage

    };

    try {
        const response = await fetch('/admin/analyse', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const textResponse = await response.text();
        console.log("Raw Response:", textResponse);

        const result = JSON.parse(textResponse);

        if (response.ok) {
            window.location.reload();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

// Add an event listener to the save button
document.getElementById('saveDataBtn').addEventListener('click', saveMerchandisingData);


document.getElementById('population').addEventListener('input', calculateHouseholds);
document.getElementById('avgPersonsPerHousehold').addEventListener('input', calculateHouseholds);
document.getElementById('avgConsumption').addEventListener('input', calculateAverageSpending);
document.getElementById('consumptionIndex').addEventListener('input', calculateAverageSpending);
document.getElementById('evasionRate').addEventListener('input', updateZoneSummary);
document.getElementById('invasionRate').addEventListener('input', updateZoneSummary);
document.getElementById('competitors').addEventListener('input', calculatePotentialRevenue);
document.getElementById('competitorsRevenue').addEventListener('input', calculatePotentialRevenue);
function showOrderModal(orderId) {
    fetch(`/manager/order/${orderId}`)
        .then(response => response.json())
        .then(order => {
            console.log(order);
            document.getElementById('viewOrderId').textContent = order.order_id;
            document.getElementById('viewOrderSupplier').textContent = order.supplier_name;
            document.getElementById('viewOrderProduct').textContent = order.product_name;
            document.getElementById('viewOrderQuantity').textContent = order.quantity;
            document.getElementById('viewOrderCreatedAt').textContent = order.created_at;
            document.getElementById('viewOrderDateOfAffect').textContent = order.date_of_affect || "En attende";

            const statusSpan = document.getElementById('viewOrderStatus');
            if (order.is_done) {
                statusSpan.textContent = 'Completed';
                statusSpan.className = 'text-green-600 font-medium';
            } else {
                statusSpan.textContent = 'Pending';
                statusSpan.className = 'text-yellow-600 font-medium';
            }


            document.getElementById('viewOrderModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Erreur de récupération de la commande:', error);
        });
}
function hideModal(id) {
    document.getElementById(id).classList.add('hidden');
}
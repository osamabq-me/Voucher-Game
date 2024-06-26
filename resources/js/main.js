document.addEventListener('DOMContentLoaded', function () {
    let selectedProduct = null;
    let customAmount = 0;

    function openModal(product) {
        selectedProduct = product;
        document.getElementById('productImage').src = product.image_url;
        document.getElementById('productName').innerText = product.name;
        document.getElementById('productDescription').innerText = product.description;
        document.getElementById('productPrice').innerText = (product.price / 1000).toLocaleString('id-ID', {
            minimumFractionDigits: 3
        });
        document.getElementById('productId').value = product.id_product;
        document.getElementById('customAmount').value = customAmount;
        document.getElementById('totalPrice').innerText = (product.price * customAmount / 1000).toLocaleString(
            'id-ID', {
            minimumFractionDigits: 3
        });

        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    document.getElementById('customAmount').addEventListener('input', function () {
        customAmount = this.value;
        updateTotalPrice();
    });

    function updateTotalPrice() {
        if (selectedProduct && customAmount) {
            const totalPrice = selectedProduct.price * customAmount;
            document.getElementById('totalPrice').innerText = (totalPrice / 1000).toLocaleString('id-ID', {
                minimumFractionDigits: 3
            });
        }
    }

    function processOrder(event) {
        event.preventDefault();

        // Check if the user is authenticated
        if (!document.getElementById('isAuthenticated').value) {
            alert('Please log in first to place an order.');
            window.location.href = '/login';
            return;
        }

        const payload = {
            id_product: selectedProduct.id_product,
            custom_amount: customAmount,
            user_id: document.getElementById('userId').value,
            payment_method: document.getElementById('paymentMethod').value,
            whatsapp_number: document.getElementById('whatsappNumber').value,
            total_price: selectedProduct.price * customAmount
        };
        console.log('Order Payload:', payload);

        fetch('/order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(payload)
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw err
                    });
                }
                return response.json();
            })
            .then(data => {
                closeModal();
                if (data.success) {
                    alert('Order placed successfully!');
                } else {
                    alert('Failed to place order!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
    }

    window.openModal = openModal;
    window.closeModal = closeModal;
    window.processOrder = processOrder;

    document.getElementById('orderForm').addEventListener('submit', processOrder);
});

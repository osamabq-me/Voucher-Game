document.addEventListener('DOMContentLoaded', function () {
    let selectedProduct = null;
    let customAmount = 0;

    const themeToggleDesktop = document.getElementById('theme-toggle-desktop');
    const themeIconDesktop = document.getElementById('theme-icon-desktop');
    const themeToggleMobile = document.getElementById('theme-toggle-mobile');
    const themeIconMobile = document.getElementById('theme-icon-mobile');

    function applyTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
            themeIconDesktop.classList.remove('fa-sun');
            themeIconDesktop.classList.add('fa-moon');
            themeIconMobile.classList.remove('fa-sun');
            themeIconMobile.classList.add('fa-moon');
        } else {
            document.documentElement.classList.remove('dark');
            themeIconDesktop.classList.remove('fa-moon');
            themeIconDesktop.classList.add('fa-sun');
            themeIconMobile.classList.remove('fa-moon');
            themeIconMobile.classList.add('fa-sun');
        }
    }

    function toggleTheme() {
        const isDark = document.documentElement.classList.toggle('dark');
        const theme = isDark ? 'dark' : 'light';
        localStorage.setItem('theme', theme);
        applyTheme(theme);
    }

    const storedTheme = localStorage.getItem('theme') || 'light';
    applyTheme(storedTheme);

    themeToggleDesktop.addEventListener('click', toggleTheme);
    themeToggleMobile.addEventListener('click', toggleTheme);

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
        document.getElementById('totalPrice').innerText = (product.price * customAmount / 1000).toLocaleString('id-ID', {
            minimumFractionDigits: 3
        });

        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }

    function openEditModal(product) {
        selectedProduct = product;
        document.getElementById('editProductId').value = product.id_product;
        document.getElementById('editName').value = product.name;
        document.getElementById('editDescription').value = product.description;
        document.getElementById('editPrice').value = product.price;
        document.getElementById('editImageUrl').value = product.image_url;

        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    document.getElementById('customAmount').addEventListener('input', function () {
        customAmount = parseInt(this.value, 10);
        if (isNaN(customAmount) || customAmount < 0) {
            customAmount = 0;
            this.value = customAmount;
        }
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

        // Check if the custom amount is at least one and not negative
        if (customAmount < 1) {
            alert('The amount must be at least one and not negative.');
            return;
        }

        const payload = {
            id_product: selectedProduct.id_product,
            custom_amount: customAmount,
            user_id: document.getElementById('userId').value,
            payment_method: document.getElementById('paymentMethod').value,
            whatsapp: document.getElementById('whatsappNumber').value,
            total_price: selectedProduct.price * customAmount
        };
        console.log('Order Payload:', payload);

        $.ajax({
            url: '/order',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: 'application/json',
            data: JSON.stringify(payload),
            success: function (response) {
                console.log('Response:', response);
                closeModal();
                alert('Order placed successfully!');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error:', jqXHR.responseText);
                alert('An error occurred. Please try again.');
            }
        });
    }

    function addProduct() {
        const name = document.getElementById('name').value;
        const description = document.getElementById('description').value;
        const price = document.getElementById('price').value;
        const image_url = document.getElementById('image_url').value;

        const payload = {
            name: name,
            description: description,
            price: price,
            image_url: image_url
        };

        $.ajax({
            url: '/products',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: 'application/json',
            data: JSON.stringify(payload),
            success: function (response) {
                console.log('Response:', response);
                closeAddModal();
                alert('Product added successfully!');
                window.location.reload();  // Refresh the page
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error:', jqXHR.responseText);
                alert('An error occurred. Please try again.');
            }
        });
    }

    function editProduct() {
        const id = document.getElementById('editProductId').value;
        const name = document.getElementById('editName').value;
        const description = document.getElementById('editDescription').value;
        const price = document.getElementById('editPrice').value;
        const image_url = document.getElementById('editImageUrl').value;

        const payload = {
            name: name,
            description: description,
            price: price,
            image_url: image_url
        };

        $.ajax({
            url: `/products/${id}`,
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: 'application/json',
            data: JSON.stringify(payload),
            success: function (response) {
                console.log('Response:', response);
                closeEditModal();
                alert('Product edited successfully!');
                window.location.reload();  // Refresh the page
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error:', jqXHR.responseText);
                alert('An error occurred. Please try again.');
            }
        });
    }

    function deleteProduct(id) {
        $.ajax({
            url: `/products/${id}`,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log('Response:', response);
                alert('Product deleted successfully!');
                window.location.reload();  // Refresh the page
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error:', jqXHR.responseText);
                alert('An error occurred. Please try again.');
            }
        });
    }

    window.openModal = openModal;
    window.closeModal = closeModal;
    window.openAddModal = openAddModal;
    window.closeAddModal = closeAddModal;
    window.openEditModal = openEditModal;
    window.closeEditModal = closeEditModal;
    window.processOrder = processOrder;
    window.addProduct = addProduct;
    window.editProduct = editProduct;
    window.deleteProduct = deleteProduct;

    document.getElementById('orderForm').addEventListener('submit', processOrder);

    setTimeout(function () {
        let flashMessages = document.querySelectorAll('.flash-message');
        flashMessages.forEach(function (flashMessage) {
            flashMessage.style.transition = 'opacity 1s';
            flashMessage.style.opacity = '0';
            setTimeout(function () {
                flashMessage.style.display = 'none';
            }, 1000);
        });
    }, 2000);
});

document.addEventListener('DOMContentLoaded', function () {
    function openModal(product) {
        populateModal(product);
        document.getElementById('product-detail-modal').classList.add('is-active');
    }

    function toggleFavorite(productId, button) {
        fetch('/favorites/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ id_product: productId })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'removed') {
                    button.querySelector('i').classList.remove('fas');
                    button.querySelector('i').classList.add('far');
                    button.style.color = 'gray';
                    // Remove the product card if on the favorites page
                    const productCard = document.getElementById(`favorite-${productId}`);
                    if (productCard) {
                        productCard.remove();
                    }
                } else {
                    button.querySelector('i').classList.remove('far');
                    button.querySelector('i').classList.add('fas');
                    button.style.color = 'red';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    document.querySelectorAll('.favorite-button').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.stopPropagation();
            const productId = button.getAttribute('data-product-id');
            toggleFavorite(productId, button);
        });
    });

    document.querySelectorAll('.favorite-card').forEach(function (card) {
        card.addEventListener('click', function () {
            const product = JSON.parse(card.getAttribute('data-product'));
            openModal(product);
        });
    });
});

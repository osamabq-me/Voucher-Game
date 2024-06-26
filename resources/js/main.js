document.addEventListener('alpine:init', () => {
    Alpine.data('productManagement', () => ({
        showDetailModal: false,
        showAddModal: false,
        showEditModal: false,
        selectedProduct: null,
        customAmount: 0,
        userId: '',
        paymentMethod: 'GOPAY',
        whatsappNumber: '',
        totalPrice: 0,
        newProduct: {
            name: '',
            description: '',
            price: '',
            image_url: ''
        },
        isLoading: false,

        init() {
            this.$watch('customAmount', () => this.updateTotalPrice());
            this.$watch('selectedProduct', () => this.updateTotalPrice());
        },

        formatPrice(price) {
            return (price / 1000).toLocaleString('id-ID', { minimumFractionDigits: 3 });
        },

        setSelectedProduct(product) {
            this.selectedProduct = product;
            this.updateTotalPrice();
        },

        toggleFavorite(productId) {
            // Implement favorite functionality here
        },

        isFavorite(productId) {
            // Implement check if product is favorite here
        },

        deleteProduct(productId) {
            // Implement delete functionality here
        },

        addProduct() {
            this.isLoading = true;
            // Implement add product functionality here
            // After successful add, close modal and reset form
            this.showAddModal = false;
            this.newProduct = {
                name: '',
                description: '',
                price: '',
                image_url: ''
            };
            this.isLoading = false;
        },

        editProduct() {
            this.isLoading = true;
            // Implement edit product functionality here
            // After successful edit, close modal
            this.showEditModal = false;
            this.isLoading = false;
        },

        processOrder() {
            // Implement order processing functionality here
        },

        redirectToLogin() {
            window.location.href = '/login';
        },

        updateTotalPrice() {
            if (this.selectedProduct && this.customAmount) {
                this.totalPrice = this.selectedProduct.price * this.customAmount;
            } else {
                this.totalPrice = 0;
            }
        }
    }));
});

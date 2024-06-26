<div x-show="showDetailModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    style="display: none;">
    <div class="w-3/4 max-w-4xl overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
        <div class="flex">
            <img :src="selectedProduct ? selectedProduct.image_url : ''" alt=""
                class="object-cover w-1/2 h-auto p-8">
            <div class="w-1/2 p-8">
                <button @click="showDetailModal = false"
                    class="float-right text-gray-700 dark:text-gray-300">&times;</button>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white"
                    x-text="selectedProduct ? selectedProduct.name : ''"></h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400"
                    x-text="selectedProduct ? selectedProduct.description : ''"></p>
                <p class="mt-2 font-bold text-gray-900 dark:text-white">Rp <span
                        x-text="formatPrice(selectedProduct.price)"></span></p>

                <div class="mt-4">
                    <label for="custom_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Custom
                        Amount
                        (CP)</label>
                    <input type="number" id="custom_amount" x-model="customAmount"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700">
                </div>

                <div class="mt-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User
                        ID/Player
                        ID</label>
                    <input type="text" id="user_id" x-model="userId"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700">
                </div>

                <div class="mt-4">
                    <label for="payment_method"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment
                        Method</label>
                    <select id="payment_method" x-model="paymentMethod"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700">
                        <option value="GOPAY">E-Wallet</option>
                        <option value="QRIS">QRIS</option>
                        <option value="Transfer BCA">Transfer BCA</option>
                        <option value="Alfamart">Alfamart</option>
                    </select>
                </div>

                <div class="mt-4">
                    <label for="whatsapp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Whatsapp
                        Number</label>
                    <input type="text" id="whatsapp" x-model="whatsappNumber"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700">
                </div>

                <div class="mt-4">
                    <p class="font-bold text-gray-900 dark:text-white">Total Price: Rp <span x-text="totalPrice"></span>
                    </p>
                </div>

                @auth
                    <div class="mt-4">
                        <button @click="processOrder"
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Process
                            Order</button>
                    </div>
                @else
                    <div class="mt-4">
                        <button @click="redirectToLogin"
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Login to
                            Order</button>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>

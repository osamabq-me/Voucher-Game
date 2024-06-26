<div id="detailModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="w-3/4 max-w-4xl overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
        <div class="flex">
            <img id="productImage" src="" alt="" class="object-cover w-1/2 h-auto p-8">
            <div class="w-1/2 p-8">
                <button onclick="closeModal()" class="float-right text-gray-700 dark:text-gray-300">&times;</button>
                <h2 id="productName" class="text-2xl font-bold text-gray-900 dark:text-white"></h2>
                <p id="productDescription" class="mt-2 text-gray-600 dark:text-gray-400"></p>
                <p class="mt-2 font-bold text-gray-900 dark:text-white">Rp <span id="productPrice"></span></p>

                <form id="orderForm">
                    <input type="hidden" id="productId" name="product_id">
                    <input type="hidden" id="isAuthenticated" value="{{ Auth::check() ? 'true' : '' }}">
                    <div class="mt-4">
                        <label for="customAmount"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Custom Amount
                            (CP)</label>
                        <input type="number" id="customAmount" name="custom_amount"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                            required>
                    </div>

                    <div class="mt-4">
                        <label for="userId" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User
                            ID/Player ID</label>
                        <input type="text" id="userId" name="user_id"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                            required>
                    </div>

                    <div class="mt-4">
                        <label for="paymentMethod"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Method</label>
                        <select id="paymentMethod" name="payment_method"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                            required>
                            <option value="GOPAY">GOPAY</option>
                            <option value="QRIS">QRIS</option>
                            <option value="Transfer BCA">Transfer BCA</option>
                            <option value="Alfamart">Alfamart</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <label for="whatsappNumber"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Whatsapp Number</label>
                        <input type="text" id="whatsappNumber" name="whatsapp_number"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                            required>
                    </div>

                    <div class="mt-4">
                        <p class="font-bold text-gray-900 dark:text-white">Total Price: Rp <span id="totalPrice"></span>
                        </p>
                    </div>

                    <div class="mt-4">
                        <button type="submit"
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Process
                            Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8" x-data="productManagement()">
        <div class="mt-8 overflow-hidden bg-white shadow dark:bg-gray-800 sm:rounded-lg">
            <div id="product-list" class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($products as $product)
                    <div class="relative overflow-hidden transition-transform transform bg-white rounded-lg shadow-lg cursor-pointer dark:bg-gray-800 hover:scale-105"
                        @click="showDetailModal = true; selectedProduct = {{ $product->toJson() }}">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="object-cover w-full">
                        @auth
                            @if (auth()->user()->is_admin)
                                <div class="absolute flex space-x-2 top-2 right-2">
                                    <button @click.stop="showEditModal = true; selectedProduct = {{ $product->toJson() }}"
                                        class="p-2 text-white bg-yellow-500 rounded-full hover:bg-yellow-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button @click.stop="deleteProduct({{ $product->id_product }})"
                                        class="p-2 text-white bg-red-500 rounded-full hover:bg-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endif
                        @endauth
                        <div class="p-4">
                            <h2 class="flex items-center justify-between text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $product->name }}
                                <button @click.stop="toggleFavorite({{ $product->id_product }})" class="ml-2 text-red-500">
                                    <i
                                        :class="isFavorite({{ $product->id_product }}) ? 'fas fa-heart' : 'far fa-heart'"></i>
                                </button>
                            </h2>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $product->description }}</p>
                            <p class="mt-2 font-bold text-gray-900 dark:text-white">Rp
                                {{ number_format($product->price / 1000, 3, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Floating Add Button -->
        @auth
            @if (auth()->user()->is_admin)
                <button @click="showAddModal = true"
                    class="fixed px-5 py-5 font-bold text-white bg-green-500 rounded-full shadow-lg bottom-8 right-8 hover:bg-green-700">
                    <i class="fas fa-plus"></i>
                </button>
            @endif
        @endauth

        <!-- Detail Modal -->
        <template x-if="showDetailModal">
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
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
                                <label for="custom_amount"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Custom Amount
                                    (CP)</label>
                                <input type="number" id="custom_amount" x-model="customAmount"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700">
                            </div>

                            <div class="mt-4">
                                <label for="user_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">User ID/Player
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
                                <label for="whatsapp"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Whatsapp
                                    Number</label>
                                <input type="text" id="whatsapp" x-model="whatsappNumber"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700">
                            </div>

                            <div class="mt-4">
                                <p class="font-bold text-gray-900 dark:text-white">Total Price: Rp <span
                                        x-text="totalPrice"></span></p>
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
        </template>

        <!-- Add Modal -->
        @auth
            @if (auth()->user()->is_admin)
                <template x-if="showAddModal">
                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="w-1/2 overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
                            <div class="p-6">
                                <button @click="showAddModal = false"
                                    class="float-right text-gray-700 dark:text-gray-300">&times;</button>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Add Product</h2>
                                <form @submit.prevent="addProduct" class="mt-4" id="add-product-form">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="name"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                        <input type="text" name="name" id="name" x-model="newProduct.name"
                                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="description"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                        <textarea name="description" id="description" rows="3" x-model="newProduct.description"
                                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700" required></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="price"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                                        <input type="number" name="price" id="price" x-model="newProduct.price"
                                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="image_url"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image
                                            URL</label>
                                        <input type="text" name="image_url" id="image_url" x-model="newProduct.image_url"
                                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                                            required>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" :disabled="isLoading"
                                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Add
                                            Product</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </template>
            @endif
        @endauth

        <!-- Edit Modal -->
        <template x-if="showEditModal">
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="w-1/2 overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
                    <div class="p-6">
                        <button @click="showEditModal = false"
                            class="float-right text-gray-700 dark:text-gray-300">&times;</button>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Product</h2>
                        <form @submit.prevent="editProduct" class="mt-4" id="edit-product-form">
                            @csrf
                            <input type="hidden" x-model="selectedProduct.id_product">
                            <div class="mb-4">
                                <label for="edit-name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" id="edit-name" x-model="selectedProduct.name"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label for="edit-description"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                <textarea id="edit-description" x-model="selectedProduct.description" rows="3"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="edit-price"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                                <input type="number" id="edit-price" x-model="selectedProduct.price"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label for="edit-image-url"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image URL</label>
                                <input type="text" id="edit-image-url" x-model="selectedProduct.image_url"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                                    required>
                            </div>
                            <div class="mt-4">
                                <button type="submit" :disabled="isLoading"
                                    class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">Save
                                    Changes</button>
                            </div>
                            <div x-show="isLoading" class="mt-4 text-center">
                                <span>Loading...</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>
@endsection

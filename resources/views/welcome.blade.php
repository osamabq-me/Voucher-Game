<x-app-layout>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8" x-data="productManagement()">
        <div class="mt-8 overflow-hidden bg-white shadow dark:bg-gray-800 sm:rounded-lg">
            <div id="product-list" class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($products as $product)
                    <div class="relative overflow-hidden transition-transform transform bg-white rounded-lg shadow-lg cursor-pointer dark:bg-gray-800 hover:scale-105"
                        onclick="openModal({{ $product->toJson() }})">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="object-cover w-full">
                        <div class="p-4">
                            <h2
                                class="flex items-center justify-between text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $product->name }}
                                <button class="ml-2 favorite-button"
                                    data-product-id="{{ $product->id_product }}"
                                    style="color: {{ in_array($product->id_product, $favorites) ? 'red' : 'gray' }}">
                                    <i class="{{ in_array($product->id_product, $favorites) ? 'fas' : 'far' }} fa-heart"></i>
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
                    class="fixed w-16 h-16 font-bold text-white bg-green-500 rounded-full shadow-lg bottom-8 right-8 hover:bg-green-700">
                    <i class="fas fa-plus"></i>
                </button>
            @endif
        @endauth

        <!-- Detail Modal Component -->
        <x-product-detail-modal></x-product-detail-modal>

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
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image URL</label>
                                        <input type="text" name="image_url" id="image_url" x-model="newProduct.image_url"
                                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                                            required>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" :disabled="isLoading"
                                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700">Add
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
                                    class="px-4 py-2 font-bold text-white bg-green-500 rounded-full hover:bg-green-700">Save
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
</x-app-layout>

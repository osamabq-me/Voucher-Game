<x-app-layout>
    <input type="hidden" id="isAuthenticated" value="{{ auth()->check() }}">
    <input type="hidden" id="isAdmin" value="{{ auth()->check() && auth()->user()->is_admin }}">

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 overflow-hidden bg-white shadow dark:bg-gray-800 sm:rounded-lg">
            <div id="product-list" class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($products as $product)
                    <div class="relative overflow-hidden transition-transform transform bg-white rounded-lg shadow-lg cursor-pointer dark:bg-gray-800 hover:scale-105"
                        onclick="openModal({{ $product->toJson() }})">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="object-cover w-full">
                        @auth
                            @if (auth()->user()->is_admin)
                                <div class="absolute flex space-x-2 top-2 right-2">
                                    <button onclick="event.stopPropagation(); openEditModal({{ $product->toJson() }})"
                                        class="w-8 h-8 text-white bg-yellow-500 rounded-full hover:bg-yellow-700">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button onclick="event.stopPropagation(); deleteProduct({{ $product->id_product }})"
                                        class="w-8 h-8 text-white bg-red-500 rounded-full hover:bg-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endif
                        @endauth
                        <div class="p-4">
                            <h2
                                class="flex items-center justify-between text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $product->name }}
                                @auth
                                    <button class="ml-2 favorite-button" data-product-id="{{ $product->id_product }}"
                                        style="color: {{ in_array($product->id_product, $favorites) ? 'red' : 'gray' }}">
                                        <i
                                            class="{{ in_array($product->id_product, $favorites) ? 'fas' : 'far' }} fa-heart"></i>
                                    </button>
                                @endauth
                            </h2>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $product->description }}</p>
                            <p class="mt-2 font-bold text-gray-900 dark:text-white">Rp
                                {{ number_format($product->price / 1000, 3, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination Links -->
        <div class="mt-10 mb-10">
            {{ $products->links() }}
        </div>

        <!-- Floating Add Button -->
        @auth
            @if (auth()->user()->is_admin)
                <button onclick="openAddModal()"
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
                <div id="addModal"
                    class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                    <div class="w-1/2 overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
                        <div class="p-6">
                            <button onclick="closeAddModal()"
                                class="float-right text-gray-700 dark:text-gray-300">&times;</button>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Add Product</h2>
                            <form id="addProductForm" class="mt-4" onsubmit="event.preventDefault(); addProduct();">
                                @csrf
                                <div class="mb-4">
                                    <label for="name"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                    <input type="text" name="name" id="name"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                    <textarea name="description" id="description" rows="3"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700" required></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="price"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                                    <input type="number" name="price" id="price"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <label for="image_url"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image URL</label>
                                    <input type="text" name="image_url" id="image_url"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                                        required>
                                </div>
                                <div class="mt-4">
                                    <button type="submit"
                                        class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700">Add
                                        Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endauth

        <!-- Edit Modal -->
        <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
            <div class="w-1/2 overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <div class="p-6">
                    <button onclick="closeEditModal()"
                        class="float-right text-gray-700 dark:text-gray-300">&times;</button>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Product</h2>
                    <form id="editProductForm" class="mt-4" onsubmit="event.preventDefault(); editProduct();">
                        @csrf
                        <input type="hidden" id="editProductId">
                        <div class="mb-4">
                            <label for="editName"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input type="text" id="editName"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="editDescription"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea id="editDescription" rows="3"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="editPrice"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                            <input type="number" id="editPrice"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="editImageUrl"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image URL</label>
                            <input type="text" id="editImageUrl"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700"
                                required>
                        </div>
                        <div class="mt-4">
                            <button type="submit"
                                class="px-4 py-2 font-bold text-white bg-green-500 rounded-full hover:bg-green-700">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

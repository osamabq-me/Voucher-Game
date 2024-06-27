<x-app-layout>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 overflow-hidden bg-white shadow dark:bg-gray-800 sm:rounded-lg">
            <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($favorites as $favorite)
                    <div id="favorite-{{ $favorite->product->id_product }}"
                        class="relative overflow-hidden transition-transform transform bg-white rounded-lg shadow-lg cursor-pointer favorite-card dark:bg-gray-800 hover:scale-105"
                        onclick="openModal({{ $favorite->product->toJson() }})">
                        <img src="{{ $favorite->product->image_url }}" alt="{{ $favorite->product->name }}"
                            class="object-cover w-full">
                        <div class="p-4">
                            <h2
                                class="flex items-center justify-between text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $favorite->product->name }}
                                @auth
                                    <button class="ml-2 text-red-500 favorite-button"
                                        data-product-id="{{ $favorite->product->id_product }}">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                @endauth
                            </h2>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $favorite->product->description }}</p>
                            <p class="mt-2 font-bold text-gray-900 dark:text-white">Rp
                                {{ number_format($favorite->product->price / 1000, 3, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Detail Modal Component -->
    <x-product-detail-modal></x-product-detail-modal>
</x-app-layout>

@section('scripts')
    <script src="{{ mix('js/main.js') }}"></script>
@endsection

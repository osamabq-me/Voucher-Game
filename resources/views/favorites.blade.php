@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 overflow-hidden bg-white shadow dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Favorite Products</h2>
                <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($favorites as $favorite)
                        <div id="favorite-{{ $favorite->product->id_product }}"
                            class="relative overflow-hidden transition-transform transform bg-white rounded-lg shadow-lg cursor-pointer dark:bg-gray-800 hover:scale-105">
                            <img src="{{ $favorite->product->image_url }}" alt="{{ $favorite->product->name }}"
                                class="object-cover w-full">
                            <div class="p-4">
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $favorite->product->name }}</h2>
                                <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $favorite->product->description }}</p>
                                <p class="mt-2 font-bold text-gray-900 dark:text-white">Rp
                                    {{ number_format($favorite->product->price / 1000, 3, ',', '.') }}</p>
                                <button class="ml-2 text-red-500 favorite-button" data-product-id="{{ $favorite->product->id_product }}">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/main.js') }}"></script>
@endsection

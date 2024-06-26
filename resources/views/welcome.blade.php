<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        .product-card {
            transition: transform 0.2s ease-in-out;
        }

        .product-card:hover {
            transform: translateY(-10px) scale(1.02);
        }
    </style>
</head>

<body class="text-gray-100 bg-gray-900">
    @include('layouts.navigation')

    <div class="container px-6 py-8 mx-auto">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <div class="overflow-hidden bg-gray-800 shadow-lg rounded-2xl product-card">
                    <img class="object-cover w-full" src="{{ $product->image_url }}" alt="{{ $product->name }}">
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>

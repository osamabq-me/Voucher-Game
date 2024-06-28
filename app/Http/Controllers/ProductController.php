<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $favorites = [];
        if (Auth::check()) {
            $favorites = Favorite::where('id_user', Auth::id())->pluck('id_product')->toArray();
        }

        return view('product', compact('products', 'favorites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image_url' => 'required|string|url',
        ]);

        $product = Product::create($validated);

        return response()->json(['message' => 'Product added successfully.', 'product' => $product], 201);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image_url' => 'required|string|url',
        ]);

        $product->update($validated);

        return response()->json(['message' => 'Product updated successfully.', 'product' => $product], 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully.'], 200);
    }
}

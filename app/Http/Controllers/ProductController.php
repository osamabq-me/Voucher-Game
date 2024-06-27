<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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

        return view('welcome', compact('products', 'favorites'));
    }
}

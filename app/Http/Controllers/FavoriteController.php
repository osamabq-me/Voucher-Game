<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with('product')->where('id_user', Auth::id())->get();
        return view('favorites', compact('favorites'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'id_product' => 'required|exists:products,id_product'
        ]);

        $favorite = Favorite::where('id_user', Auth::id())
            ->where('id_product', $request->id_product)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'id_user' => Auth::id(),
                'id_product' => $request->id_product
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}

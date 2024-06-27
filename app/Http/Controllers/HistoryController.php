<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::with(['user', 'product', 'payment'])->where('id_user', auth()->id())->get();
        return view('history.index', compact('histories'));
    }

    public function adminIndex()
    {
        $histories = History::with(['user', 'product', 'payment'])->get();
        return view('history.adminhistory', compact('histories'));
    }
}

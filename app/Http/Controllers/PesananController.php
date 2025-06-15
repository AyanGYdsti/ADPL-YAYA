<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function pesanDetail($id)
    {
        $product = Product::with('user')->find($id);

        return view('pesan', compact('product'));
    }
}

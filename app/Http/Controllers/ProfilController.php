<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $product = Product::where('user_id', Auth::user()->id);
        return view('profile', compact('user', 'product'));
    }
}

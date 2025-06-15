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

    public function editProfile($id)
    {
        $user = User::find($id);
        return view('edit-profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'password' => 'sometimes',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('user', 'public');
            $data['gambar'] = $path;
        }

        User::find($id)->update($data);

        return back();
    }

    public function hapusProfile($id)
    {
        Product::find($id)->delete();
        return Auth::user()->role_id == 1 ? redirect('/laporan') : back();
    }
}

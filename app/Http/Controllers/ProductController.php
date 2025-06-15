<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create()
    {
        return view('upload-produk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'jenis' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'lokasi' => 'required|string',
            'gambar.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('produk', 'public');
                $gambarPaths[] = $path;
            }
        }

        Product::create([
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kategori'  => $request->kategori,
            'jenis'     => $request->jenis,
            'harga'     => $request->harga,
            'lokasi'    => $request->lokasi,
            'user_id'    => Auth::user()->id,
            'gambar'    => json_encode($gambarPaths),
        ]);

        return response()->json([
            'message' => 'Produk berhasil disimpan!',
        ]);
    }

    public function report(Request $request, $id) {}

    public function getProducts(Request $request)
    {
        $query = Product::query();

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->keyword) {
            $query->where('nama', 'like', '%' . $request->keyword . '%');
        }

        return response()->json($query->get());
    }
}

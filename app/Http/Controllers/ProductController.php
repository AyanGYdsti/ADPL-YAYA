<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
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

    public function report(Request $request, $id)
    {
        $data = $request->validate([
            'alasan' => 'required'
        ]);

        $data['user_id'] = Auth::user()->id;
        $data['product_id'] = $id;

        Laporan::create($data);

        return response()->json([
            'message' => 'Produk berhasil melaporkan!',
        ]);
    }

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
    public function edit($id)
    {
        $product = Product::find($id);

        return view('edit-produk', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'jenis' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'lokasi' => 'required|string',
            'gambar.*' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048', // <-- gunakan 'sometimes'
        ]);

        $product = Product::findOrFail($id); // Tambahkan fail-safe

        $data = [
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kategori'  => $request->kategori,
            'jenis'     => $request->jenis,
            'harga'     => $request->harga,
            'lokasi'    => $request->lokasi,
            'user_id'   => Auth::id(),
        ];

        // Cek apakah ada file gambar diupload
        if ($request->hasFile('gambar')) {
            $gambarPaths = [];

            foreach ($request->file('gambar') as $file) {
                $path = $file->store('produk', 'public');
                $gambarPaths[] = $path;
            }

            // Simpan path gambar sebagai JSON jika ada
            $data['gambar'] = json_encode($gambarPaths);
        }

        $product->update($data);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'message' => 'Produk berhasil disimpan!',
                'redirect' => route('profile')
            ]);
        }
    }


    public function hapus($id)
    {
        Product::find($id)->delete();

        return back()->with('success', 'Berhasil Menghapus Data');
    }
}

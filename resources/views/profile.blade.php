@extends('layouts.jelajah')

@section('title', 'Profil')

@section('content')
    <div class="profile-header">
        <img src="{{ asset('img/avatar.png') }}" alt="Avatar">
        <div class="info">
            <h2>{{ $user->nama }}</h2>
            <div class="stats">
                <span>{{ $product->count() }} Barang</span>
                <span>18 Transaksi</span>
                <span>4.8 Rating</span>
            </div>
            <div class="buttons">
                <a href="/upload-produk">+ Unggah barang baru</a>
                <a href="/profile/{{ $user->id }}">Edit Profil</a>
            </div>
        </div>
    </div>

    <div class="tabs">
        <button class="active">Barang saya</button>
    </div>

    <h3 style="margin-left: 20px">Daftar Barang yang Dijual</h3>
    @if ($product->count() > 0)
        <div class="barang-list">
            @foreach ($product->get() as $product)
                <div class="barang-item" style="position: relative;">
                    <!-- Tombol Hapus -->
                    <div style="position: absolute; top: 8px; right: 8px;">
                        <a href="/profile/hapus/{{ $product->id }}" onclick="return confirm('Yakin ingin menghapus produk ini?')"
                            style="background: #e74c3c; color: white; border: none; border-radius: 4px; padding: 4px 8px; cursor: pointer; font-size: 12px; text-decoration:none">
                            ✕
                        </a>
                    </div>

                    <!-- Konten Produk -->
                    <a href="/edit-produk/{{ $product->id }}" style="text-decoration: none; color: inherit;">
                        <img src="/storage/{{ json_decode($product['gambar'])[0] ?? 'produk/avatar.png' }}"
                            alt="{{ $product['nama'] }}">
                        <h4>{{ $product['nama'] }}</h4>
                        <p>Rp {{ number_format($product['harga'], 0, ',', '.') }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center;width:100%">
            <p>Tidak ada data</p>
        </div>
    @endif
@endsection

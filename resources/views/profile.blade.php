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
                <a href="">Edit Profil</a>
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
                <a href="/pesan/detail/{{ $product->id }}" style="text-decoration: none">
                    <div class="barang-item">
                        <img src="{{ asset('img/avatar.png') }}" alt="{{ $product['nama'] }}">
                        <h4>{{ $product['nama'] }}</h4>
                        <p>Rp {{ number_format($product['harga'], 0, ',', '.') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div style="text-align: center;width:100%">
            <p>Tidak ada data</p>
        </div>
    @endif
@endsection

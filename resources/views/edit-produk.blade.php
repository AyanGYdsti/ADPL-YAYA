@extends('layouts.jelajah')

@section('title', 'Edit Produk')

@section('content')
    <div class="container">
        <div class="header">
            <button class="back-btn" onclick="goBack()">&larr;</button>

            <div class="upload-section">
                <div class="upload-container">
                    <!-- Image Slider -->
                    <div class="image-slider" id="imageSlider">
                        <div class="image-counter" id="imageCounter">1 / 1</div>
                        <div class="slider-container" id="sliderContainer"></div>
                        <button class="slider-nav prev" onclick="changeSlide(-1)">‹</button>
                        <button class="slider-nav next" onclick="changeSlide(1)">›</button>
                        <div class="slider-dots" id="sliderDots"></div>
                    </div>

                    <!-- Upload Box -->
                    <label class="upload-box" for="upload-image" id="uploadBox">
                        <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <div class="edit-text">Unggah Gambar Produk</div>
                    </label>

                    <button class="add-more-btn" id="addMoreBtn" onclick="document.getElementById('upload-image').click()"
                        style="display: none;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Gambar
                    </button>

                    <input type="file" id="upload-image" name="gambar[]" multiple accept="image/*" hidden>
                </div>
            </div>
        </div>

        <div class="form-section">
            @if (session('success'))
                <div style="background: #d4edda; padding: 10px; border-radius: 10px; margin-bottom: 20px; color: #155724;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('produk.update', [$product->id]) }}" method="POST" enctype="multipart/form-data"
                onsubmit="handleSubmit(event,'put')">
                @csrf
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama" id="nama" value="{{ $product->nama }}" required />
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" required>{{ $product->deskripsi }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Kategori Barang</label>
                        <input type="text" name="kategori" id="kategori" value="{{ $product->kategori }}" required />
                    </div>
                    <div class="form-group">
                        <label>Jenis Barang</label>
                        <input type="text" name="jenis" id="jenis" value="{{ $product->jenis }}" required />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" id="harga" value="{{ $product->harga }}" min="0"
                            required />
                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <div class="location-group">
                            <input type="text" class="location-input" name="lokasi" id="lokasi"
                                value="{{ $product->lokasi }}" />
                        </div>
                    </div>
                </div>

                <button type="submit" class="confirm-btn">Konfirmasi</button>
            </form>
        </div>
    </div>
@endsection

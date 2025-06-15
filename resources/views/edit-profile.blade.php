@extends('layouts.jelajah')

@section('title', 'Edit Profile')

@section('content')
    <div class="container">
        <div class="header">
            <button class="back-btn" onclick="goBack()">&larr;</button>

            <div class="upload-section">
                <div class="upload-container">
                    <!-- Upload Box -->
                    <label class="upload-box" for="upload-image" id="uploadBox">
                        <img src="/storage/{{ $user->gambar ?? 'produk/avatar.png' }}" alt="foto"
                            style="background-size:cover;width:150px">
                    </label>

                    <button class="add-more-btn" id="addMoreBtn" style="display: none;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Gambar
                    </button>
                </div>
            </div>
        </div>

        <div class="form-section">
            @if (session('success'))
                <div style="background: #d4edda; padding: 10px; border-radius: 10px; margin-bottom: 20px; color: #155724;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update', [$user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" id="nama" value="{{ $user->nama }}" required />
                </div>

                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" name="gambar" id="gambar" />
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" id="email" value="{{ $user->email }}" required></input>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" id="alamat" value="{{ $user->alamat }}" required />
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="no_hp" id="no_hp" value="{{ $user->no_hp }}" required />
                    </div>
                </div>

                <button type="submit" class="confirm-btn">Konfirmasi</button>
            </form>
        </div>
    </div>
@endsection

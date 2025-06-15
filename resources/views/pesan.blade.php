@extends('layouts.jelajah')

@section('title', 'Detail Tas Sekolah')

@section('content')
    <div class="card">
        <button class="back-button" onclick="goBack()">&larr;</button>

        @php
            $gambarArray = json_decode($product->gambar, true) ?? [];
        @endphp

        <div class="image-slider">
            <div class="slider-container" id="sliderContainer">
                @foreach ($gambarArray as $gambar)
                    <img src="{{ asset('storage/' . $gambar) }}" alt="Gambar Produk" />
                @endforeach
            </div>

            @if (count($gambarArray) > 1)
                <button class="slider-nav prev" onclick="changeSlide(-1)">‹</button>
                <button class="slider-nav next" onclick="changeSlide(1)">›</button>

                <div class="slider-dots">
                    @foreach ($gambarArray as $index => $gambar)
                        <div class="dot {{ $index === 0 ? 'active' : '' }}" onclick="currentSlide({{ $index + 1 }})">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="content">
            <div class="title">{{ $product->nama }}</div>
            <div class="price">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>

            <div class="section-title">Keterangan</div>
            <p class="description">
                {{ $product->deskripsi }}
            </p>
            @php
                function formatNomorTelepon($nomor)
                {
                    $nomor = trim($nomor);

                    // Jika diawali 0, ubah ke +62
                    if (substr($nomor, 0, 1) === '0') {
                        return '+62' . substr($nomor, 1);
                    }

                    // Jika sudah +62 atau format lain, biarkan
                    return $nomor;
                }

            @endphp
            <div class="chat-box">
                <img src="https://img.icons8.com/color/24/whatsapp--v1.png" alt="WhatsApp" />
                <input type="text" placeholder="Apa ini masih ada?" id="messageInput" />
                <a
                    href="http://wa.me/{{ formatNomorTelepon($product->user->no_hp) . '?text=Apakah ini masih ada?' }}">Kirim</a>
            </div>

            <div class="info-section">
                <div class="info-card">
                    <div class="section-title">👤 Penjual</div>
                    <div class="profile">
                        <img src="/img/avatar.png" alt="User Profile">
                        <div class="profile-info">
                            <strong>{{ $product->user->nama }}</strong>
                        </div>
                    </div>
                </div>

                <div class="info-card location-card">
                    <div class="section-title">📍 Lokasi Pengambilan</div>
                    <div style="font-size: 14px; line-height: 1.5;">
                        {{ $product->lokasi }}
                    </div>
                </div>
            </div>
            @if (auth()->user()->id == $product->user_id)
                <button class="order-btn" onclick="orderItem()">Sold Out</button>
            @endif
        </div>
    </div>
@endsection

@extends('layouts.jelajah')

@section('content')
<link rel="stylesheet" href="{{ asset('css/pesananku.css') }}">

<div class="container">
    <!-- Header -->
    <div class="header">
        <div class="header-top">
            <div class="logo">
                <div class="recycle-icon">♻</div>
                Reuse & share
            </div>
            <div class="user-avatar">👤</div>
        </div>

        <div class="header-content">
            <div class="header-text">
                <h1>Pesanan ku</h1>
            </div>
        </div>

        <div class="nav-tabs">
            <button class="nav-tab active" onclick="switchTab('proses')">Proses</button>
            <button class="nav-tab" onclick="switchTab('riwayat')">Riwayat</button>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <div id="proses-content">
            <div class="order-item">
                <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=200&h=200&fit=crop&crop=center" alt="Tas Sekolah" class="item-image">
                <div class="item-details">
                    <div class="item-title">Tas Sekolah</div>
                    <div class="item-meta">1 Pesanan | 17 Oct 2025</div>
                    <div class="item-status">
                        <div class="status-indicator status-pending">⏳</div>
                        <span class="status-text">Menunggu Konfirmasi Merchant</span>
                    </div>
                    <div class="item-status">
                        <div class="status-indicator status-cancelled">✖</div>
                        <span class="status-text">Batalkan</span>
                    </div>
                    <div class="item-price">Rp.0</div>
                    <div class="item-actions">
                        <button class="btn btn-outline" onclick="showDetail('Tas Sekolah')">Detail</button>
                        <button class="btn btn-primary" onclick="openChat('Tas Sekolah')">Chat</button>
                    </div>
                </div>
            </div>

            <div class="order-item">
                <img src="https://images.unsplash.com/photo-1606983340126-99ab4feaa64a?w=200&h=200&fit=crop&crop=center" alt="Camera Canon" class="item-image">
                <div class="item-details">
                    <div class="item-title">Camera Canon</div>
                    <div class="item-meta">1 Camera 2 hari | 17 Oct 2025</div>
                    <div class="item-status">
                        <div class="status-indicator status-pending">⏳</div>
                        <span class="status-text">Menunggu Konfirmasi Merchant</span>
                    </div>
                    <div class="item-status">
                        <div class="status-indicator status-cancelled">✖</div>
                        <span class="status-text">Batalkan</span>
                    </div>
                    <div class="item-price">Rp.180.000</div>
                    <div class="item-actions">
                        <button class="btn btn-outline" onclick="showDetail('Camera Canon')">Detail</button>
                        <button class="btn btn-primary" onclick="openChat('Camera Canon')">Chat</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="riwayat-content" style="display: none;">
            <div class="review-card">
                <div class="review-header">
                    <div class="review-item-info">
                        <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=200&h=200&fit=crop&crop=center" alt="Tas Sekolah" class="review-item-image">
                        <div class="review-item-details">
                            <h3>Tas Sekolah</h3>
                            <div class="review-meta">1 Pesanan | 17 Oct 2025</div>
                        </div>
                    </div>
                    <div class="review-status">
                        <div class="status-indicator status-delivered">✓</div>
                        <span class="status-text">Order Delivered</span>
                    </div>
                    <div class="item-price">Rp.0</div>
                </div>
                <div class="review-content">
                    <div class="review-question">Berapa Rating Anda ke Merchant ini?</div>
                    <div class="interactive-rating" data-item="tas-sekolah">
                        <div class="interactive-star" onclick="setRating('tas-sekolah', 1)"></div>
                        <div class="interactive-star" onclick="setRating('tas-sekolah', 2)"></div>
                        <div class="interactive-star" onclick="setRating('tas-sekolah', 3)"></div>
                        <div class="interactive-star" onclick="setRating('tas-sekolah', 4)"></div>
                        <div class="interactive-star" onclick="setRating('tas-sekolah', 5)"></div>
                    </div>
                    <textarea class="review-textarea" placeholder="Pelayanan prima, tepat waktu, respon cepat." data-item="tas-sekolah"></textarea>
                    <button class="submit-review-btn" onclick="submitReview('tas-sekolah')">Submit</button>
                </div>
            </div>

            <div class="review-card">
                <div class="review-header">
                    <div class="review-item-info">
                        <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=200&h=200&fit=crop&crop=center" alt="Laptop Bekas" class="review-item-image">
                        <div class="review-item-details">
                            <h3>Laptop Bekas</h3>
                            <div class="review-meta">1 Laptop | 15 Oct 2025</div>
                        </div>
                    </div>
                    <div class="review-status">
                        <div class="status-indicator status-delivered">✓</div>
                        <span class="status-text">Order Delivered</span>
                    </div>
                    <div class="item-price">Rp.2.500.000</div>
                </div>
                <div class="review-content">
                    <div class="review-question">Berapa Rating Anda ke Merchant ini?</div>
                    <div class="interactive-rating" data-item="laptop-bekas">
                        <div class="interactive-star active" onclick="setRating('laptop-bekas', 1)"></div>
                        <div class="interactive-star active" onclick="setRating('laptop-bekas', 2)"></div>
                        <div class="interactive-star active" onclick="setRating('laptop-bekas', 3)"></div>
                        <div class="interactive-star active" onclick="setRating('laptop-bekas', 4)"></div>
                        <div class="interactive-star" onclick="setRating('laptop-bekas', 5)"></div>
                    </div>
                    <textarea class="review-textarea" data-item="laptop-bekas">Laptop dalam kondisi sangat baik, sesuai deskripsi. Penjual responsif dan pengiriman cepat.</textarea>
                    <button class="submit-review-btn" onclick="submitReview('laptop-bekas')">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-logo">
            <div class="recycle-icon">♻</div>
            <div class="footer-text">
                <h2>REUSE & SHARE</h2>
                <p>Berbagi Barang, Menyeimbangkan kehidupan.</p>
            </div>
        </div>
        <div class="footer-description">
            <p>Bergabunglah dengan komunitas yang peduli lingkungan. Berbagi barang bekas, temukan kebutuhan Anda, dan ciptakan dunia yang lebih berkelanjutan.</p>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="detailModal">
    <div class="modal-content">
        <button class="close-modal" onclick="closeModal()">&times;</button>
        <h3 id="modalTitle">Detail Barang</h3>
        <p id="modalDescription">Informasi detail tentang barang yang dipilih.</p>
        <button class="btn btn-primary" onclick="closeModal()">Tutup</button>
    </div>
</div>

<script src="{{ asset('js/pesananku.js') }}"></script>
@endsection

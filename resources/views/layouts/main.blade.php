<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Reuse & Share</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Reuse & Share</div>
        <div class="nav-links">
            <a href="/login" class="btn btn-primary" style="color: white">Login</a>
        </div>
    </nav>

    <!-- Konten -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-links">
                <a href="#">Tentang Kami</a>
                <a href="#">Cara Kerja</a>
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">Kontak</a>
            </div>
            <p>&copy; 2024 Reuse & Share. Semua hak dilindungi.</p>
        </div>
    </footer>

</body>

</html>

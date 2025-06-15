function loadProductsFromAPI(kategori = null, keyword = null) {
    const params = {};

    if (kategori) params.kategori = kategori;
    if (keyword) params.keyword = keyword;


    $.ajax({
        url: "/products",
        method: "GET",
        data: params,
        success: function (data) {
            const grid = document.getElementById("productsGrid");
            grid.innerHTML = "";

            if (data.length === 0) {
                grid.innerHTML = `<p style="text-align:center;">Produk tidak ditemukan.</p>`;
                return;
            }

            data.forEach((product) => {
                const gambarArray = JSON.parse(product.gambar || "[]");
                const gambarPertama =
                    gambarArray.length > 0
                        ? `/storage/${gambarArray[0]}`
                        : "/img/avatar.jpg";

                const card = document.createElement("div");
                card.className = "product-card";

                card.innerHTML = `
                    <div class="product-image" style="background-image: url('${gambarPertama}'); background-size: cover; position: relative;">
                        <div class="product-badge">Tersedia</div>
                        <button class="report-icon-btn" onclick="reportProduct(${product.id})" title="Laporkan Produk">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M2.5 1a.5.5 0 0 0-.5.5V15h1V10h2.293l1.5 1.5a.5.5 0 0 0 .707-.707L6.707 10H13a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.5-.5H5.707L4.207.5a.5.5 0 0 0-.707.707L5.293 3H2.5V1.5a.5.5 0 0 0-.5-.5z"/>
                            </svg>
                        </button>
                    </div>

                    <div class="product-info">
                        <div class="product-title">${product.nama}</div>
                        <div class="product-description">${product.deskripsi}</div>
                        <div class="product-footer">
                            <div class="product-location">📍 ${product.lokasi}</div>
                            <a href="/pesan/detail/${product.id}" class="contact-btn">Pesan</a>
                        </div>
                    </div>
                `;

                grid.appendChild(card);
            });
        },
        error: function (err) {
            console.error("Gagal mengambil data produk:", err);
        },
    });
}

function reportProduct(productId) {
    const alasan = prompt("Tulis alasan laporan untuk produk ini:");

    if (alasan === null) return; // Dibatalkan

    if (alasan.trim() === "") {
        alert("Alasan laporan tidak boleh kosong.");
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]');

    $.ajax({
        url: `/products/report/${productId}`,
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrfToken.getAttribute("content"),
        },
        data: {
            alasan: alasan,
        },
        success: function (res) {
            alert(res.message || "Laporan berhasil dikirim.");
        },
        error: function (err) {
            console.error("Gagal mengirim laporan:", err);
            alert("Terjadi kesalahan saat mengirim laporan.");
        },
    });
}

document.addEventListener("DOMContentLoaded", function () {
    loadProductsFromAPI();

    document.querySelectorAll(".filter-pill").forEach((pill) => {
        pill.addEventListener("click", function () {
            // aktifkan pill yang dipilih
            document
                .querySelectorAll(".filter-pill")
                .forEach((p) => p.classList.remove("active"));
            pill.classList.add("active");

            const kategoriDipilih = pill.dataset.category;
            if (kategoriDipilih === "Semua") {
                loadProductsFromAPI(); // tanpa filter
            } else {
                loadProductsFromAPI(kategoriDipilih); // filter berdasarkan kategori
            }
        });
    });

    const searchBtn = document.getElementById("searchBtn");
    const searchInput = document.getElementById("searchInput");

    searchBtn.addEventListener("click", function () {
        const keyword = searchInput.value.trim();
        const aktif = document.querySelector(".filter-pill.active");
        const kategori =
            aktif && aktif.dataset.category !== "Semua"
                ? aktif.dataset.category
                : null;
        loadProductsFromAPI(kategori, keyword);
    });

    searchInput.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            searchBtn.click();
        }
    });
});

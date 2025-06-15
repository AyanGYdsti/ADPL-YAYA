 const reviewData = {
            'tas-sekolah': { rating: 0, review: '' },
            'laptop-bekas': { rating: 4, review: 'Laptop dalam kondisi sangat baik, sesuai deskripsi. Penjual responsif dan pengiriman cepat.' }
        };

        function switchTab(tab) {
            // Remove active class from all tabs
            document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked tab
            event.target.classList.add('active');
            
            // Show/hide content
            if (tab === 'proses') {
                document.getElementById('proses-content').style.display = 'block';
                document.getElementById('riwayat-content').style.display = 'none';
            } else {
                document.getElementById('proses-content').style.display = 'none';
                document.getElementById('riwayat-content').style.display = 'block';
            }
        }

        function showDetail(itemName) {
            document.getElementById('modalTitle').textContent = `Detail ${itemName}`;
            
            let description = '';
            switch(itemName) {
                case 'Tas Sekolah':
                    description = 'Tas sekolah dengan kondisi baik. Cocok untuk anak sekolah menengah. Masih berfungsi dengan baik dan bersih.';
                    break;
                case 'Camera Canon':
                    description = 'Kamera Canon DSLR dengan kondisi sangat baik. Semua fungsi masih berjalan normal. Cocok untuk fotografi pemula.';
                    break;
                case 'Laptop Bekas':
                    description = 'Laptop bekas dengan spesifikasi yang masih layak pakai. Cocok untuk pekerjaan ringan dan browsing.';
                    break;
                default:
                    description = 'Informasi detail tentang barang yang dipilih.';
            }
            
            document.getElementById('modalDescription').textContent = description;
            document.getElementById('detailModal').classList.add('active');
        }

        function openChat(itemName) {
            alert(`Membuka chat untuk ${itemName}`);
        }

        function setRating(itemId, rating) {
            reviewData[itemId].rating = rating;
            updateRatingDisplay(itemId);
        }

        function updateRatingDisplay(itemId) {
            const ratingContainer = document.querySelector(`[data-item="${itemId}"]`);
            const stars = ratingContainer.querySelectorAll('.interactive-star');
            const currentRating = reviewData[itemId].rating;
            
            stars.forEach((star, index) => {
                if (index < currentRating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        function submitReview(itemId) {
            const textarea = document.querySelector(`textarea[data-item="${itemId}"]`);
            const rating = reviewData[itemId].rating;
            const reviewText = textarea.value.trim();
            
            if (rating === 0) {
                alert('Silakan pilih rating terlebih dahulu!');
                return;
            }
            
            if (reviewText === '') {
                alert('Silakan tulis ulasan Anda!');
                return;
            }
            
            reviewData[itemId].review = reviewText;
            
            alert(`Terima kasih! Ulasan Anda telah dikirim.\nRating: ${rating} bintang\nUlasan: ${reviewText}`);
            
            // Disable the submit button after submission
            const submitBtn = document.querySelector(`button[onclick="submitReview('${itemId}')"]`);
            submitBtn.textContent = 'Ulasan Terkirim';
            submitBtn.disabled = true;
        }

        function closeModal() {
            document.querySelectorAll('.modal').forEach(modal => {
                modal.classList.remove('active');
            });
        }

        // Close modal when clicking outside
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });
        });

        // Initialize ratings on page load
        document.addEventListener('DOMContentLoaded', function() {
            Object.keys(reviewData).forEach(itemId => {
                if (reviewData[itemId].rating > 0) {
                    updateRatingDisplay(itemId);
                }
            });
        });
  
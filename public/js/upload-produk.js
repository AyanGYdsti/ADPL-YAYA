let uploadedImages = [];
let currentSlideIndex = 0;

// Handle image upload preview
document
    .getElementById("upload-image")
    .addEventListener("change", function (e) {
        const files = Array.from(e.target.files);

        files.forEach((file) => {
            if (file && file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    uploadedImages.push({
                        src: e.target.result,
                        file: file,
                    });
                    updateImageDisplay();
                };
                reader.readAsDataURL(file);
            }
        });

        // Reset input value so same files can be selected again
        e.target.value = "";
    });

function updateImageDisplay() {
    const uploadBox = document.getElementById("uploadBox");
    const imageSlider = document.getElementById("imageSlider");
    const sliderContainer = document.getElementById("sliderContainer");
    const sliderDots = document.getElementById("sliderDots");
    const imageCounter = document.getElementById("imageCounter");
    const addMoreBtn = document.getElementById("addMoreBtn");

    if (uploadedImages.length > 0) {
        // Hide upload box and show slider
        uploadBox.style.display = "none";
        imageSlider.style.display = "block";
        addMoreBtn.style.display = "flex";

        // Clear existing images and dots
        sliderContainer.innerHTML = "";
        sliderDots.innerHTML = "";

        // Set slider container width to accommodate all images
        sliderContainer.style.width = `${uploadedImages.length * 100}%`;

        // Add images to slider
        uploadedImages.forEach((image, index) => {
            const img = document.createElement("img");
            img.src = image.src;
            img.alt = `Product Image ${index + 1}`;
            img.style.width = `${100 / uploadedImages.length}%`;
            sliderContainer.appendChild(img);

            // Add dot
            const dot = document.createElement("div");
            dot.className = index === currentSlideIndex ? "dot active" : "dot";
            dot.onclick = () => currentSlide(index + 1);
            sliderDots.appendChild(dot);
        });

        // Update counter
        imageCounter.textContent = `${currentSlideIndex + 1} / ${
            uploadedImages.length
        }`;

        // Reset to first slide if current index is out of bounds
        if (currentSlideIndex >= uploadedImages.length) {
            currentSlideIndex = 0;
        }

        // Update slider position
        updateSlider();
    } else {
        // Show upload box and hide slider
        uploadBox.style.display = "flex";
        imageSlider.style.display = "none";
        addMoreBtn.style.display = "none";
    }
}

function changeSlide(direction) {
    currentSlideIndex += direction;

    if (currentSlideIndex >= uploadedImages.length) {
        currentSlideIndex = 0;
    } else if (currentSlideIndex < 0) {
        currentSlideIndex = uploadedImages.length - 1;
    }

    updateSlider();
}

function currentSlide(slideIndex) {
    currentSlideIndex = slideIndex - 1;
    updateSlider();
}

function updateSlider() {
    if (uploadedImages.length === 0) return;

    const sliderContainer = document.getElementById("sliderContainer");
    const dots = document.querySelectorAll(".dot");
    const imageCounter = document.getElementById("imageCounter");

    // Fix: Use translateX with percentage based on current slide
    const translateX = -currentSlideIndex * 100;
    sliderContainer.style.transform = `translateX(${translateX}%)`;

    // Update dots
    dots.forEach((dot, index) => {
        dot.classList.toggle("active", index === currentSlideIndex);
    });

    // Update counter
    imageCounter.textContent = `${currentSlideIndex + 1} / ${
        uploadedImages.length
    }`;
}

// Touch/swipe support for mobile
let startX = 0;
let endX = 0;

const slider = document.getElementById("imageSlider");

slider.addEventListener("touchstart", function (e) {
    startX = e.touches[0].clientX;
});

slider.addEventListener("touchend", function (e) {
    endX = e.changedTouches[0].clientX;
    handleSwipe();
});

function handleSwipe() {
    const swipeThreshold = 50;
    const swipeDistance = startX - endX;

    if (Math.abs(swipeDistance) > swipeThreshold) {
        if (swipeDistance > 0) {
            changeSlide(1); // Swipe left - next slide
        } else {
            changeSlide(-1); // Swipe right - previous slide
        }
    }
}

// Handle back button
function goBack() {
    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = "/";
    }
}

// Handle form submission
async function handleSubmit(event) {
    event.preventDefault();

    const form = event.target;

    if (uploadedImages.length === 0) {
        alert("Silakan unggah minimal satu gambar produk!");
        return;
    }

    const submitBtn = document.querySelector(".confirm-btn");
    const originalText = submitBtn.textContent;
    submitBtn.textContent = "Menyimpan...";
    submitBtn.disabled = true;

    // Ambil data dari form
    const formData = new FormData(form);

    // Tambahkan file asli dari uploadedImages
    uploadedImages.forEach((imgObj) => {
        if (imgObj.file instanceof File) {
            formData.append("gambar[]", imgObj.file);
        }
    });

    try {
        // DEBUG (opsional): tampilkan isi formData di konsol
        // for (let pair of formData.entries()) {
        //     console.log(pair[0], pair[1]);
        // }

        const response = await fetch(form.action, {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]')
                    .value,
            },
        });

        if (response.ok) {
            const result = await response.json();
            alert(result.message || "Produk berhasil disimpan!");

            // Reset form dan slider
            form.reset();
            uploadedImages = [];
            currentSlideIndex = 0;
            updateImageDisplay();
        } else if (response.status === 422) {
            const errorData = await response.json();
            const firstError = Object.values(errorData.errors)[0][0];
            alert("Validasi gagal: " + firstError);
        } else {
            throw new Error("Server error");
        }
    } catch (error) {
        console.error("AJAX Error:", error);
        alert("Terjadi kesalahan saat mengirim data.");
    } finally {
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
    }
}

// Auto slide every 4 seconds when there are multiple images
setInterval(() => {
    if (uploadedImages.length > 1) {
        changeSlide(1);
    }
}, 4000);

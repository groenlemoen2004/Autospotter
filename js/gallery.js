document.addEventListener('DOMContentLoaded', () => {
    const galleryImages = document.querySelectorAll('.gallery-image');
    let currentImageIndex = 0;

    function rotateImages() {
        galleryImages.forEach((img, index) => {
            img.style.display = index === currentImageIndex ? 'block' : 'none';
        });
        currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
    }

    setInterval(rotateImages, 3000); // Rotate images every 3 seconds
    rotateImages(); // Initial call to display the first image
});
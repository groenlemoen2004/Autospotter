document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelectorAll("#slider .slide");
    let currentSlide = 0;
    const totalSlides = slides.length;
    const nextButton = document.getElementById("nextSlide");
    const prevButton = document.getElementById("prevSlide");

    // Function to update the slide visibility by toggling the 'active' class
    function updateSlides() {
        slides.forEach((slide, index) => {
            if (index === currentSlide) {
                slide.classList.add("active");
            } else {
                slide.classList.remove("active");
            }
        });
    }

    nextButton.addEventListener("click", function() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlides();
    });

    prevButton.addEventListener("click", function() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlides();
    });

    // Set interval to automatically change slides every 3 seconds
    setInterval(function() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlides();
    }, 3000);
});

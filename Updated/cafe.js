// JavaScript to control the sliding effect
let currentSlide = 0;
const slides = document.querySelector('.slides');
const totalSlides = document.querySelectorAll('.slide').length;

function showNextSlide() {
    currentSlide = (currentSlide + 1) % totalSlides;
    const offset = -currentSlide * 100;
    slides.style.transform = `translateX(${offset}%)`;
}

// Automatically change slide every 5 seconds
setInterval(showNextSlide, 5000);

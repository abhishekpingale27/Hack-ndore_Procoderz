let currentSlide = 0;

document.addEventListener('DOMContentLoaded', () => {
    showSlide(currentSlide);
});

function showSlide(index) {
    const slides = document.querySelectorAll('.slide');
    const slider = document.querySelector('.slider');
    slider.style.transform = `translateX(-${index * 100}%)`;
}

function changeSlide(direction) {
    const slides = document.querySelectorAll('.slide');
    currentSlide = (currentSlide + direction + slides.length) % slides.length;
    showSlide(currentSlide);
}
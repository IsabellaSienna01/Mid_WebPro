import './bootstrap';

let lastScroll = 0;
const navbar = document.getElementById('navbar');

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;

    if (currentScroll <= 0) {
        navbar.style.transform = 'translateY(0)';
        return;
    }

    if (currentScroll > lastScroll) {
        navbar.style.transform = 'translateY(-100%)';
    } else {
        navbar.style.transform = 'translateY(0)';
    }

    lastScroll = currentScroll;
});

document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.getElementById('book-carousel');
    const nextBtn = document.getElementById('next');
    const prevBtn = document.getElementById('prev');

    const slides = carousel.children;
    let index = 0;
    const firstClone = slides[0].cloneNode(true);
    const lastClone = slides[slides.length - 1].cloneNode(true);
    carousel.appendChild(firstClone);
    carousel.insertBefore(lastClone, slides[0]);
    let currentIndex = 1;
    const slideWidth = carousel.clientWidth;
    carousel.style.transform = `translateX(-${slideWidth * currentIndex}px)`;

    const moveToSlide = (newIndex) => {
        carousel.style.transition = 'transform 0.6s ease-in-out';
        carousel.style.transform = `translateX(-${slideWidth * newIndex}px)`;
        currentIndex = newIndex;
    };

    nextBtn.addEventListener('click', () => {
        if (currentIndex >= slides.length - 1) return;
        moveToSlide(currentIndex + 1);
    });

    prevBtn.addEventListener('click', () => {
        if (currentIndex <= 0) return;
        moveToSlide(currentIndex - 1);
    });

    carousel.addEventListener('transitionend', () => {
        if (slides[currentIndex].isSameNode(firstClone)) {
        carousel.style.transition = 'none';
        currentIndex = 1;
        carousel.style.transform = `translateX(-${slideWidth * currentIndex}px)`;
        }
        if (slides[currentIndex].isSameNode(lastClone)) {
        carousel.style.transition = 'none';
        currentIndex = slides.length - 2;
        carousel.style.transform = `translateX(-${slideWidth * currentIndex}px)`;
        }
    });
    window.addEventListener('resize', () => {
        const newWidth = carousel.clientWidth;
        carousel.style.transition = 'none';
        carousel.style.transform = `translateX(-${newWidth * currentIndex}px)`;
    });
});

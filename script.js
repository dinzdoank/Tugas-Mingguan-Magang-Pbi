document.addEventListener('DOMContentLoaded', () => {
    // 1. Toggle menu navigasi untuk tampilan mobile
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('nav ul');
    

    if (navToggle && navMenu) {
        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
    }
// Smooth scrolling for navigation links
document.querySelectorAll('nav ul li a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        document.querySelector(targetId).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
    // 2. Validasi form input pada halaman kontak
    const contactForm = document.querySelector('#contact form');

    if (contactForm) {
        contactForm.addEventListener('submit', (event) => {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const message = document.getElementById('message').value.trim();
            let valid = true;

            // Reset error messages
            const errorMessages = document.querySelectorAll('.error-message');
            errorMessages.forEach(msg => msg.remove());

            // Validasi nama
            if (name === '') {
                valid = false;
                showError('name', 'Nama tidak boleh kosong.');
            }

            // Validasi email
            if (email === '') {
                valid = false;
                showError('email', 'Email tidak boleh kosong.');
            } else if (!validateEmail(email)) {
                valid = false;
                showError('email', 'Email tidak valid.');
            }

            // Validasi pesan
            if (message === '') {
                valid = false;
                showError('message', 'Pesan tidak boleh kosong.');
            }

            if (!valid) {
                event.preventDefault(); // Mencegah pengiriman form jika ada error
            }
        });
    }

    function showError(inputId, message) {
        const input = document.getElementById(inputId);
        if (input) {
            const error = document.createElement('div');
            error.className = 'error-message';
            error.style.color = 'red';
            error.style.marginTop = '4px';
            error.textContent = message;
            input.parentNode.insertBefore(error, input.nextSibling);
        }
    }

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }

    // 3. Efek animasi saat pengguna menscroll halaman
    const animatedElements = document.querySelectorAll('.animate-on-scroll');

    if (animatedElements.length > 0) {
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        });

        animatedElements.forEach(element => {
            observer.observe(element);
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    // Existing code...

    // Carousel functionality
    const carouselItems = document.querySelectorAll('.carousel-item');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    let currentIndex = 0;

    function showCarouselItem(index) {
        carouselItems.forEach((item, i) => {
            item.classList.toggle('active', i === index);
        });
    }

    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : carouselItems.length - 1;
        showCarouselItem(currentIndex);
    });

    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex < carouselItems.length - 1) ? currentIndex + 1 : 0;
        showCarouselItem(currentIndex);
    });

    // Auto-play carousel
    setInterval(() => {
        nextButton.click();
    }, 5000);
});

// Modal functionality
const modal = document.getElementById('productModal');
const modalTitle = document.getElementById('modalTitle');
const modalImage = document.getElementById('modalImage');
const modalDescription = document.getElementById('modalDescription');
const modalPrice = document.getElementById('modalPrice');
const closeModal = document.querySelector('.close');

document.querySelectorAll('.product-item').forEach(item => {
    item.addEventListener('click', () => {
        const title = item.querySelector('h3').innerText;
        const image = item.querySelector('img').src;
        const description = item.querySelector('p') ? item.querySelector('p').innerText : 'Deskripsi tidak tersedia.';
        const price = item.querySelector('span').innerText;

        modalTitle.innerText = title;
        modalImage.src = image;
        modalDescription.innerText = description;
        modalPrice.innerText = price;

        modal.style.display = 'block';
    });
});

closeModal.addEventListener('click', () => {
    modal.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

// Back-to-top button functionality
const backToTopButton = document.getElementById('backToTop');

window.onscroll = function() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        backToTopButton.style.display = "block";
    } else {
        backToTopButton.style.display = "none";
    }
};

backToTopButton.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// Lightbox functionality
const lightbox = document.getElementById('lightbox');
const lightboxImage = document.getElementById('lightboxImage');

document.querySelectorAll('.product-item img').forEach(image => {
    image.addEventListener('click', () => {
        lightboxImage.src = image.src;
        lightbox.style.display = 'block';
    });
});

// Close lightbox when clicking on the close button or outside the image
const closeLightbox = document.querySelector('.lightbox .close');

closeLightbox.addEventListener('click', () => {
    lightbox.style.display = 'none';
});

lightbox.addEventListener('click', (event) => {
    if (event.target === lightbox) {
        lightbox.style.display = 'none';
    }
});
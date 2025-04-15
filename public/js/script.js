document.addEventListener('DOMContentLoaded', () => {
    // 1. Toggle menu navigasi untuk tampilan mobile
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('nav ul');
    
    // Pastikan elemen ada sebelum menambahkan event listener
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
    }

    // Smooth scrolling untuk link navigasi
    document.querySelectorAll('nav ul li a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            // Pastikan elemen target ada
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // 2. Validasi form input pada halaman kontak
    const contactForm = document.querySelector('#contact form');

    if (contactForm) {
        contactForm.addEventListener('submit', (event) => {
            const name = document.getElementById('name')?.value.trim() || '';
            const email = document.getElementById('email')?.value.trim() || '';
            const message = document.getElementById('message')?.value.trim() || '';
            let valid = true;

            // Reset pesan error
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
                event.preventDefault();
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

    // 3. Efek animasi scroll
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

    // Carousel functionality
    const carouselItems = document.querySelectorAll('.carousel-item');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    let currentIndex = 0;

    // Pastikan semua elemen carousel ada
    if (carouselItems.length && prevButton && nextButton) {
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
            if (nextButton) nextButton.click();
        }, 5000);
    }
});

// Modal functionality
const modal = document.getElementById('productModal');
const modalTitle = document.getElementById('modalTitle');
const modalImage = document.getElementById('modalImage');
const modalDescription = document.getElementById('modalDescription');
const modalPrice = document.getElementById('modalPrice');
const closeModal = document.querySelector('.close');

// Pastikan semua elemen modal ada sebelum menambahkan event listeners
if (modal && modalTitle && modalImage && modalDescription && modalPrice && closeModal) {
    document.querySelectorAll('.product-item').forEach(item => {
        item.addEventListener('click', (e) => {
            e.stopPropagation(); // Mencegah event bubbling
            const title = item.querySelector('h3')?.innerText;
            const image = item.querySelector('img')?.src;
            const description = item.querySelector('p')?.innerText || 'Deskripsi tidak tersedia.';
            const price = item.querySelector('span')?.innerText;

            if (title && image && price) {
                modalTitle.innerText = title;
                modalImage.src = image;
                modalDescription.innerText = description;
                modalPrice.innerText = price;
                modal.style.display = 'block';
            }
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
}

// Back-to-top button functionality
const backToTopButton = document.getElementById('backToTop');

if (backToTopButton) {
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
}

// Lightbox functionality
const lightbox = document.getElementById('lightbox');
const lightboxImage = document.getElementById('lightboxImage');
const closeLightbox = document.querySelector('.lightbox .close');

if (lightbox && lightboxImage && closeLightbox) {
    document.querySelectorAll('.product-item img').forEach(image => {
        image.addEventListener('click', (e) => {
            e.stopPropagation(); // Mencegah konflik dengan modal
            lightboxImage.src = image.src;
            lightbox.style.display = 'block';
        });
    });

    closeLightbox.addEventListener('click', () => {
        lightbox.style.display = 'none';
    });

    lightbox.addEventListener('click', (event) => {
        if (event.target === lightbox) {
            lightbox.style.display = 'none';
        }
    });
}

// Fungsi untuk menangani form kontak
const contactForm = document.getElementById('contact-form');
const contactMessage = document.getElementById('contact-message');

if (contactForm) {
    contactForm.addEventListener('submit', (event) => {
        event.preventDefault();
        
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();
        
        // Validasi form
        if (!name || !email || !message) {
            showContactMessage('Semua field harus diisi', 'error');
            return;
        }
        
        if (!validateEmail(email)) {
            showContactMessage('Format email tidak valid', 'error');
            return;
        }
        
        // Simulasi pengiriman pesan
        showContactMessage('Pesan Anda telah berhasil dikirim. Terima kasih telah menghubungi kami!', 'success');
        contactForm.reset();
    });
}

function showContactMessage(message, type) {
    contactMessage.textContent = message;
    contactMessage.style.display = 'block';
    contactMessage.className = `alert alert-${type}`;
    
    // Sembunyikan pesan setelah 5 detik
    setTimeout(() => {
        contactMessage.style.display = 'none';
    }, 5000);
}

(() => {
    const gallery = document.querySelector('[data-gallery]');
    if (!gallery) return;

    const items = Array.from(gallery.querySelectorAll('.dj-gallery-item'));

    // Staggered reveal on scroll
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        el.classList.add('is-visible');
                        observer.unobserve(el);
                    }
                });
            },
            {
                rootMargin: '0px 0px -10% 0px',
                threshold: 0.25,
            }
        );

        items.forEach((item, index) => {
            item.style.transitionDelay = `${Math.min(index * 60, 360)}ms`;
            observer.observe(item);
        });
    } else {
        items.forEach((item) => item.classList.add('is-visible'));
    }

    // Minimal lightbox
    let lightbox;
    let lightboxImage;

    function createLightbox() {
        lightbox = document.createElement('div');
        lightbox.className = 'dj-gallery-lightbox';
        lightbox.setAttribute('role', 'dialog');
        lightbox.setAttribute('aria-modal', 'true');

        lightbox.innerHTML = `
            <div class="dj-gallery-lightbox-inner">
                <button class="dj-gallery-lightbox-close" type="button">
                    <span>Close</span>
                </button>
                <img src="" alt="">
            </div>
        `;

        lightboxImage = lightbox.querySelector('img');

        document.body.appendChild(lightbox);

        const closeButton = lightbox.querySelector('.dj-gallery-lightbox-close');
        const close = () => {
            lightbox.classList.remove('is-open');
            document.body.style.removeProperty('overflow');
        };

        closeButton.addEventListener('click', close);
        lightbox.addEventListener('click', (event) => {
            if (event.target === lightbox) {
                close();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && lightbox.classList.contains('is-open')) {
                close();
            }
        });
    }

    items.forEach((item) => {
        item.addEventListener('click', () => {
            const fullUrl = item.getAttribute('data-full');
            const img = item.querySelector('img');
            if (!fullUrl || !img) return;

            if (!lightbox) {
                createLightbox();
            }

            lightboxImage.src = fullUrl;
            lightboxImage.alt = img.alt || '';
            lightbox.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        });
    });
})();


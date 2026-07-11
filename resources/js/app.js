// Marks JS as active so CSS may hide .reveal elements pre-animation
document.documentElement.classList.add('js');

// Scroll-reveal via IntersectionObserver
const revealObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                revealObserver.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.12, rootMargin: '0px 0px -40px 0px' },
);

document.querySelectorAll('.reveal').forEach((el) => revealObserver.observe(el));

// Header background on scroll
const header = document.getElementById('site-header');

if (header) {
    const onScroll = () => {
        header.classList.toggle('is-scrolled', window.scrollY > 24);
    };

    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
}

// Mobile menu
const menuToggle = document.getElementById('menu-toggle');
const mobileMenu = document.getElementById('mobile-menu');

if (menuToggle && mobileMenu) {
    menuToggle.addEventListener('click', () => {
        const nowHidden = mobileMenu.classList.toggle('hidden');
        menuToggle.setAttribute('aria-expanded', String(!nowHidden));
        document.body.classList.toggle('overflow-hidden', !nowHidden);
    });
}

// Count-up stats
const countObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            const el = entry.target;
            const target = parseFloat(el.dataset.count);
            const decimals = el.dataset.count.includes('.') ? 1 : 0;
            const duration = 1400;
            const start = performance.now();

            const tick = (now) => {
                const progress = Math.min((now - start) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                el.textContent = (target * eased).toFixed(decimals);

                if (progress < 1) {
                    requestAnimationFrame(tick);
                }
            };

            requestAnimationFrame(tick);
            countObserver.unobserve(el);
        });
    },
    { threshold: 0.5 },
);

document.querySelectorAll('[data-count]').forEach((el) => countObserver.observe(el));

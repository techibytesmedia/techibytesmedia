/*
 *
 *   Created by Techibytes Media Development Team
 *   Copyright Ⓒ 2026. All rights reserved, https://techibytesmedia.com/
 *   Project: techibytesmedia
 *   Last modified: 7/18/26, 8:37 PM
 *   Modified or Created by: erigb
 *
 *   Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file
 *   except in compliance with the License. You may obtain a copy of the License at
 *   https://www.apache.org/licenses/LICENSE-2.0. Unless required by applicable law or agreed to in writing, software
 *    distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
 *    either express or implied. See the License for the specific language governing permissions and
 *    limitations under the License.
 * /
 */

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

// Theme toggle — light by default, choice persisted per visitor (see head script in layout)
const themeToggle = document.getElementById('theme-toggle');

if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
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

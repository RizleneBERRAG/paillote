// public/js/restaurant.js
(() => {
    const $  = (sel, ctx = document) => ctx.querySelector(sel);
    const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));

    /* ============ 1) Reveal on scroll ============ */
    const initReveals = () => {
        const reveals = $$('.reveal');
        if (!reveals.length) return;

        if ('IntersectionObserver' in window) {
            const io = new IntersectionObserver(entries => {
                entries.forEach(en => {
                    if (en.isIntersecting) {
                        en.target.classList.add('in');
                        io.unobserve(en.target);
                    }
                });
            }, { threshold: 0.18 });
            reveals.forEach(el => io.observe(el));
        } else {
            // Fallback anciens navigateurs
            reveals.forEach(el => el.classList.add('in'));
        }
    };

    /* ============ 2) Lightbox ============ */
    const initLightbox = () => {
        const lb      = $('#lightbox');
        const lbImg   = $('#lightboxImg');
        const lbClose = lb ? $('.lb-close', lb) : null;
        if (!lb || !lbImg) return;

        const open = (src) => {
            lbImg.src = src;
            lb.classList.add('is-open');
            document.documentElement.classList.add('no-scroll');
        };
        const close = () => {
            lb.classList.remove('is-open');
            document.documentElement.classList.remove('no-scroll');
            setTimeout(() => { lbImg.src = ''; }, 160);
        };

        // Ouvre depuis la grille
        document.addEventListener('click', (e) => {
            const img = e.target.closest('.g-item img');
            if (img) {
                open(img.getAttribute('data-full') || img.src);
            }
        }, { passive: true });

        lbClose?.addEventListener('click', close);
        lb.addEventListener('click', (e) => { if (e.target === lb) close(); });
        window.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); }, { passive: true });
    };

    /* ============ 3) Filtres (pills) ============ */
    const initFilters = () => {
        const btns = $$('.gf-btn');
        const grid = $('#galleryGrid');
        if (!btns.length || !grid) return;

        const apply = (filter) => {
            $$('.g-item', grid).forEach(it => {
                const cat = it.getAttribute('data-cat');
                const show = (filter === 'all' || filter === cat);
                it.classList.toggle('is-hidden', !show);
            });
        };

        btns.forEach(btn => {
            btn.addEventListener('click', () => {
                btns.forEach(b => b.classList.remove('is-active'));
                btn.classList.add('is-active');
                apply(btn.dataset.filter);
            });
        });
    };

    /* ============ Boot ============ */
    document.addEventListener('DOMContentLoaded', () => {
        initReveals();
        initLightbox();
        initFilters();
    });
})();

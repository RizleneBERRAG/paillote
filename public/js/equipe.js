// public/js/equipe.js
(() => {
    document.addEventListener('DOMContentLoaded', () => {
        /* =========================================================
           1) VOILE D’INTRO (cohérent avec le Blade)
           ========================================================= */
        const veil     = document.getElementById('teamVeil');   // <div id="teamVeil" class="team-veil">
        const veilBtn  = document.getElementById('veilEnter');  // <button id="veilEnter">
        const teamPage = document.getElementById('team-page');  // <div id="team-page">

        let veilClosed = false;

        // Bloque le scroll tant que le voile est visible
        if (veil) {
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
        }

        function closeVeil() {
            if (!veil || veilClosed) return;
            veilClosed = true;

            veil.classList.add('is-off');

            // Débloque le scroll après la transition
            setTimeout(() => {
                if (veil && veil.parentNode) veil.parentNode.removeChild(veil);
                document.documentElement.style.overflow = '';
                document.body.style.overflow = '';
            }, 460);

            // Apparition douce du contenu
            const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            if (teamPage) {
                if (reduce) {
                    teamPage.style.opacity = '1';
                    teamPage.style.transform = 'none';
                } else {
                    teamPage.animate(
                        [{ opacity: 0, transform: 'translateY(6px)' }, { opacity: 1, transform: 'none' }],
                        { duration: 4320, easing: 'ease-out' }
                    );
                }
            }
        }

        // Bouton “Entrer”
        if (veilBtn) {
            veilBtn.addEventListener('click', (e) => {
                e.preventDefault();
                closeVeil();
            });
        }

        // Échap
        if (veil) {
            window.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeVeil();
            });
        }

        // (Important) On NE ferme PAS sur scroll/clic auto pour éviter la fermeture involontaire
        // Si tu veux réactiver la fermeture par clic fond, décommente :
        // veil.addEventListener('click', (e) => {
        //   if (!e.target.closest('#veilEnter')) closeVeil();
        // }, { passive: true });

        /* =========================================================
           2) REVEAL-ON-SCROLL (scopé à #team-page)
           ========================================================= */
        const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const revealEls = document.querySelectorAll('#team-page .reveal');
        const doRevealAll = () => revealEls.forEach(el => el.classList.add('in'));

        if (revealEls.length) {
            if (reduce || !('IntersectionObserver' in window)) {
                doRevealAll();
            } else {
                const io = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('in');
                            io.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.18 });
                revealEls.forEach(el => io.observe(el));
            }
        }

        /* =========================================================
           3) MARQUEE — duplication (strip photos)
           ========================================================= */
        document.querySelectorAll('.strip-inner').forEach((row) => {
            if (row.dataset.doubled) return;
            row.innerHTML = row.innerHTML + row.innerHTML; // une duplication suffit
            row.dataset.doubled = '1';
        });

        /* =========================================================
           4) COMPTEURS (stats)
           ========================================================= */
        const easeOutCubic = (t) => 1 - Math.pow(1 - t, 3);
        const animateNumber = (el, to, suffix, duration = 1000) => {
            const from = 0;
            const start = performance.now();
            const step = (now) => {
                const p = Math.min(1, (now - start) / duration);
                const value = Math.round(from + (to - from) * easeOutCubic(p));
                el.textContent = value.toString() + (suffix || '');
                if (p < 1) requestAnimationFrame(step);
            };
            requestAnimationFrame(step);
        };

        const statBoxes = document.querySelectorAll('.stat b');
        if (statBoxes.length) {
            const runCounters = () => {
                statBoxes.forEach((el) => {
                    if (el.dataset.animated) return;
                    const txt = (el.textContent || '').trim();
                    const numMatch = txt.match(/(\d+)/);
                    if (!numMatch) return;
                    const target = parseInt(numMatch[1], 10);
                    const suffix = txt.replace(numMatch[1], '');
                    el.dataset.animated = '1';
                    animateNumber(el, target, suffix, 1100);
                });
            };

            if (reduce || !('IntersectionObserver' in window)) {
                runCounters();
            } else {
                const io2 = new IntersectionObserver((ents) => {
                    ents.forEach((e) => {
                        if (e.isIntersecting) {
                            runCounters();
                            io2.disconnect(); // une seule fois
                        }
                    });
                }, { threshold: 0.25 });
                io2.observe(statBoxes[0]);
            }
        }

        /* =========================================================
           5) Hover “lift” : réduire le jitter sur mobile
           ========================================================= */
        const isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
        if (isTouch) {
            document.querySelectorAll('.lift').forEach(el => {
                el.style.transition = 'box-shadow .18s ease';
            });
        }
    });
})();

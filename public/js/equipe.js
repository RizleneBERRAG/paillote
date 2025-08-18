(() => {
    document.addEventListener('DOMContentLoaded', () => {
        /* =========================
           1) VOILE D’INTRO
           ========================= */
        const veil     = document.querySelector('.team-veil');
        const veilBtn  = document.getElementById('veilEnter');
        const teamPage = document.getElementById('team-page');

        // écouteurs "déverrouillage"
        const unlockEvents = ['wheel', 'touchstart', 'scroll'];
        const rmUnlock = () => unlockEvents.forEach(ev => window.removeEventListener(ev, closeVeil, optPassiveOnce));

        // options d’écoute “passive”
        const optPassive     = { passive: true };
        const optPassiveOnce = { passive: true, once: true };

        let veilClosed = false;

        // Si le voile existe, bloque le scroll
        if (veil) {
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
        }

        function closeVeil() {
            if (!veil || veilClosed) return;
            veilClosed = true;

            veil.classList.add('is-off');

            // Débloque le scroll après la transition + nettoyage
            setTimeout(() => {
                if (veil && veil.parentNode) veil.parentNode.removeChild(veil);
                document.documentElement.style.overflow = '';
                document.body.style.overflow = '';
                rmUnlock();
            }, 460);

            // Petite apparition douce du contenu (si animations permises)
            const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            if (teamPage) {
                if (reduce) {
                    teamPage.style.opacity = '1';
                    teamPage.style.transform = 'none';
                } else {
                    teamPage.animate(
                        [{ opacity: 0, transform: 'translateY(6px)' }, { opacity: 1, transform: 'none' }],
                        { duration: 4200, easing: 'ease-out' }
                    );
                }
            }
        }

        if (veilBtn) {
            veilBtn.addEventListener('click', (e) => { e.preventDefault(); closeVeil(); });
        }
        if (veil) {
            // Clic partout (sauf sur le bouton) => ferme aussi
            veil.addEventListener('click', (e) => {
                if (!e.target.closest('#veilEnter')) closeVeil();
            }, optPassive);
            // Échap
            window.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeVeil();
            });
            // Fallback : premier scroll/touch/wheel => ferme
            unlockEvents.forEach(ev => window.addEventListener(ev, closeVeil, optPassiveOnce));
        }

        /* =========================
           2) REVEAL-ON-SCROLL
           ========================= */
        const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const revealEls = document.querySelectorAll('#team-page .reveal'); // << scoping
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

        /* =========================
           3) MARQUEE — duplication
           ========================= */
        document.querySelectorAll('.strip-inner').forEach((row) => {
            if (row.dataset.doubled) return;
            row.innerHTML = row.innerHTML + row.innerHTML;
            row.dataset.doubled = '1';
        });

        /* =========================
           4) COMPTEURS (stats)
           ========================= */
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
                            io2.disconnect();
                        }
                    });
                }, { threshold: 0.25 });
                io2.observe(statBoxes[0]);
            }
        }

        /* =========================
           5) Hover “lift” : réduire le jitter sur mobile
           ========================= */
        const isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
        if (isTouch) {
            document.querySelectorAll('.lift').forEach(el => el.style.transition = 'box-shadow .18s ease');
        }
    });
})();

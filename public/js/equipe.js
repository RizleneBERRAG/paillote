// public/js/equipe.js
(() => {
    document.addEventListener('DOMContentLoaded', () => {
        /* =========================================================
           1) VOILE D’INTRO (optionnel)
           ========================================================= */
        const veil = document.querySelector('.team-veil');
        const veilBtn = document.getElementById('veilEnter');
        const teamPage = document.getElementById('team-page');

        // Si le voile existe, on bloque le scroll jusqu’à fermeture
        if (veil) {
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
        }

        const closeVeil = () => {
            if (!veil || veil.classList.contains('is-off')) return;
            veil.classList.add('is-off');
            // débloque le scroll après la transition
            setTimeout(() => {
                if (veil && veil.parentNode) veil.parentNode.removeChild(veil);
                document.documentElement.style.overflow = '';
                document.body.style.overflow = '';
            }, 460);
            // petite apparition douce du contenu
            if (teamPage) {
                teamPage.animate(
                    [{ opacity: 0, transform: 'translateY(6px)' }, { opacity: 1, transform: 'none' }],
                    { duration: 320, easing: 'ease-out' }
                );
            }
        };

        if (veilBtn) {
            veilBtn.addEventListener('click', (e) => {
                e.preventDefault();
                closeVeil();
            });
        }
        if (veil) {
            // clic n’importe où (hors bouton) => ferme aussi
            veil.addEventListener('click', (e) => {
                if (!e.target.closest('#veilEnter')) closeVeil();
            });
            // touche Échap
            window.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeVeil();
            }, { passive: true });
            // petit fallback : si l’utilisateur scrolle/roue, on ferme
            const unlockEvents = ['wheel', 'touchstart', 'scroll'];
            unlockEvents.forEach(ev => window.addEventListener(ev, closeVeil, { passive: true, once: true }));
        }

        /* =========================================================
           2) REVEAL-ON-SCROLL
           Ajoute la classe .in aux éléments .reveal quand ils entrent en vue
           ========================================================= */
        const revealEls = document.querySelectorAll('.reveal');
        const doRevealAll = () => revealEls.forEach(el => el.classList.add('in'));

        if (revealEls.length) {
            if ('IntersectionObserver' in window) {
                const io = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('in');
                            io.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.18 });
                revealEls.forEach((el) => io.observe(el));
            } else {
                doRevealAll();
            }
        }

        /* =========================================================
           3) MARQUEE : DUPLICATION AUTOMATIQUE
           Duplique le contenu de .strip-inner pour une boucle fluide
           ========================================================= */
        document.querySelectorAll('.strip-inner').forEach((row) => {
            if (row.dataset.doubled) return;
            // duplique 1x tout le contenu (suffisant pour l’anim CSS -50%)
            row.innerHTML = row.innerHTML + row.innerHTML;
            row.dataset.doubled = '1';
        });

        /* =========================================================
           4) COMPTEUR (facultatif) pour .stat b
           Si le texte contient un nombre (ex: "450+" / "100%"), on anime.
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

            if ('IntersectionObserver' in window) {
                const io2 = new IntersectionObserver((ents) => {
                    ents.forEach((e) => {
                        if (e.isIntersecting) {
                            runCounters();
                            io2.disconnect(); // une seule fois
                        }
                    });
                }, { threshold: 0.25 });
                io2.observe(statBoxes[0]);
            } else {
                runCounters();
            }
        }

        /* =========================================================
           5) HOVER LIFT fin : réduire le “jitter” sur mobile
           (désactive la translation au touch)
           ========================================================= */
        const isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
        if (isTouch) {
            document.querySelectorAll('.lift').forEach(el => el.style.transition = 'box-shadow .18s ease');
        }
    });
})();

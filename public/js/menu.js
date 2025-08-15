// public/js/menu.js
(function () {
    const qs  = (sel, root = document) => root.querySelector(sel);
    const qsa = (sel, root = document) => Array.from(root.querySelectorAll(sel));

    const overlayId = 'site-menu';

    function getOverlay() {
        return qs('#' + overlayId);
    }
    function getPanel() {
        const ov = getOverlay();
        return ov ? qs('.menu-panel', ov) : null;
    }

    function openMenu() {
        const ov = getOverlay();
        if (!ov) return;
        ov.classList.add('is-open');
        ov.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        // état visuel du burger -> croix (si CSS prévu)
        qsa('.menu-toggle, .burger').forEach(b => b.classList.add('is-active'));
    }

    function closeMenu() {
        const ov = getOverlay();
        if (!ov) return;
        ov.classList.remove('is-open');
        ov.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        qsa('.menu-toggle, .burger').forEach(b => b.classList.remove('is-active'));
    }

    // --- DÉLÉGATION : on écoute tout le document ---
    document.addEventListener('click', (e) => {
        const target = e.target;

        // OUVRIR si on clique sur .menu-toggle ou .burger
        if (target.closest('.menu-toggle, .burger')) {
            e.preventDefault();
            openMenu();
            return;
        }

        const ov = getOverlay();
        if (!ov) return;

        // FERMER si on clique sur .menu-close
        if (target.closest('#' + overlayId + ' .menu-close')) {
            e.preventDefault();
            closeMenu();
            return;
        }

        // FERMER si on clique hors du panneau (dans l’overlay)
        if (target.id === overlayId || target.closest('#' + overlayId) && !getPanel()?.contains(target)) {
            closeMenu();
        }
    });

    // FERMER avec ESC
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeMenu();
    });

    // (Optionnel) changement d’image au survol/focus
    document.addEventListener('mouseover', (e) => {
        const a = e.target.closest('#' + overlayId + ' .menu-list a[data-image]');
        if (!a) return;
        swapImage(a.getAttribute('data-image'));
    });
    document.addEventListener('focusin', (e) => {
        const a = e.target.closest('#' + overlayId + ' .menu-list a[data-image]');
        if (!a) return;
        swapImage(a.getAttribute('data-image'));
    });

    function swapImage(src) {
        const ov = getOverlay();
        const media = ov ? qs('.media', ov) : null;
        if (!media || !src) return;
        const current = qs('.media-img.is-active', media);
        if (current && current.getAttribute('src') === src) return;

        const img = new Image();
        img.className = 'media-img';
        img.onload = () => {
            media.appendChild(img);
            requestAnimationFrame(() => img.classList.add('is-active'));
            if (current) setTimeout(() => current.remove(), 380);
        };
        img.src = src;
        img.alt = '';
    }
})();

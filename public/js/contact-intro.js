/* =========================================================================
   Contact page – curtain intro + EmailJS + fallback Laravel submit
   Fichier : public/js/contact-intro.js
   ======================================================================== */

/* =======================
   0) EmailJS – initialiser
   =======================

*/
(function initEmailJS() {
    if (window.emailjs && typeof emailjs.init === 'function') {
        try { emailjs.init('0inxyCI23tIIDpDhL'); } catch (e) { console.warn('EmailJS init:', e); }
    }
})();

/* ============================================================
   1) Rideau d’intro : clic sur “Entrer” => anime puis affiche
   ============================================================ */
document.addEventListener('DOMContentLoaded', () => {
    const curtain      = document.querySelector('.contact-curtain');
    const enterBtn     = document.getElementById('revealContact');
    const pageWrapper  = document.getElementById('contact-page');

    const openPage = () => {
        if (!curtain || !pageWrapper) return;
        // Déclenche l’animation CSS
        curtain.classList.add('reveal');

        // Après la transition, on masque le rideau et on montre la page
        const done = () => {
            curtain.style.display = 'none';
            pageWrapper.style.display = 'block';
            curtain.removeEventListener('transitionend', done);
            curtain.removeEventListener('animationend', done);
        };

        // Si l’utilisateur préfère réduire les animations,
        // le CSS met déjà display:none, mais on sécurise :
        const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (reduce) {
            done();
        } else {
            // Selon le navigateur, la fin peut être "transitionend" ou "animationend"
            curtain.addEventListener('transitionend', done);
            curtain.addEventListener('animationend', done);
            // Sécurité (au cas où l’évènement ne se déclenche pas)
            setTimeout(done, 900);
        }
    };

    if (enterBtn) enterBtn.addEventListener('click', openPage);
    // Fallback clavier : Enter/Space
    if (enterBtn) {
        enterBtn.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openPage(); }
        });
    }

    // Accessibilité : si hash direct vers le contenu
    if (location.hash === '#contact-page') {
        if (curtain) curtain.style.display = 'none';
        if (pageWrapper) pageWrapper.style.display = 'block';
    }
});

/* ============================================================
   2) Envoi du formulaire : EmailJS puis submit Laravel (BDD)
   ============================================================ */
document.addEventListener('DOMContentLoaded', () => {
    const form      = document.getElementById('contact-form');
    const overlay   = document.getElementById('loadingOverlay');
    const resultEl  = document.getElementById('result');
    const submitBtn = document.getElementById('contact-submit');

    if (!form) return;

    const setBusy = (busy) => {
        if (overlay) overlay.style.display = busy ? 'grid' : 'none';
        if (submitBtn) {
            submitBtn.disabled = busy;
            submitBtn.setAttribute('aria-busy', busy ? 'true' : 'false');
        }
    };

    const showMessage = (msg, type = 'info') => {
        if (!resultEl) return;
        resultEl.textContent = msg || '';
        resultEl.className = ''; // reset
        resultEl.classList.add(type === 'error' ? 'text-error' : 'text-success');
        // (Tu peux styler .text-error / .text-success dans contact.css si tu veux)
    };

    // Petit check côté client pour éviter les allers/retours inutiles
    const quickValidate = () => {
        const name    = form.querySelector('[name="name"]')?.value?.trim();
        const email   = form.querySelector('[name="email"]')?.value?.trim();
        const message = form.querySelector('[name="message"]')?.value?.trim();
        const consent = form.querySelector('[name="consent"]')?.checked;

        if (!name || !email || !message || !consent) {
            showMessage('Veuillez renseigner les champs obligatoires et accepter le traitement des données.', 'error');
            return false;
        }
        return true;
    };

    form.addEventListener('submit', async (e) => {
        // On intercepte toujours pour placer EmailJS d’abord
        e.preventDefault();
        showMessage('');
        setBusy(true);

        const emailJsIsReady = !!(window.emailjs && typeof emailjs.sendForm === 'function');

        try {
            // 1) Validation rapide côté client
            if (!quickValidate()) {
                setBusy(false);
                return;
            }

            // 2) Si EmailJS est dispo → envoyer l’e-mail via EmailJS
            if (emailJsIsReady) {
                const SERVICE_ID  = 'service_j8gsazd';
                const TEMPLATE_ID = 'template_mi664sv';

                await emailjs.sendForm(SERVICE_ID, TEMPLATE_ID, form);
            }

            // 3) Ensuite, on soumet réellement le formulaire
            //    pour que Laravel enregistre en base (ContactController@send)
            form.submit();

            // NB : on ne clear pas l’overlay ici car un redirect survient.
            // Si jamais le redirect est annulé (erreurs de validation), Laravel
            // renverra la page et l’overlay sera de toute façon réinitialisé.

        } catch (err) {
            console.error('EmailJS error:', err);
            setBusy(false);

            // Fallback : si l’e-mail échoue, on sauvegarde quand même en BDD
            // en envoyant le POST natif vers Laravel.
            try {
                form.submit();
            } catch (submitErr) {
                console.error('Fallback submit error:', submitErr);
                showMessage("Impossible d'envoyer votre message pour le moment. Réessayez plus tard.", 'error');
            }
        }
    });
});

/* ============================================================
   3) Confort : auto-resize du textarea (si pas déjà dans la vue)
   ============================================================ */
document.addEventListener('input', (e) => {
    const ta = e.target.matches('#c_message') ? e.target : null;
    if (!ta) return;
    ta.style.height = 'auto';
    ta.style.height = ta.scrollHeight + 'px';
}, { passive: true });

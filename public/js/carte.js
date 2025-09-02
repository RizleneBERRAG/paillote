// public/js/menu.js
// Gestion du lightbox + filtres + hotfix overlay

document.addEventListener("DOMContentLoaded", () => {
    /**
     * ================
     * Lightbox images
     * ================
     */
    const lightbox = document.getElementById("img-lightbox");
    const lightboxImg = document.getElementById("img-lightbox-img");
    const lightboxCaption = document.getElementById("img-lightbox-caption");

    document.addEventListener("click", (e) => {
        const btn = e.target.closest(".see-photo");
        if (btn) {
            lightboxImg.src = btn.dataset.img || "";
            lightboxCaption.textContent = btn.dataset.title || "";
            lightbox.hidden = false;
            lightbox.setAttribute("aria-hidden", "false");
            document.documentElement.classList.add("no-scroll");
            return;
        }

        if (
            e.target.closest(".img-lightbox-close") ||
            e.target.closest(".img-lightbox-backdrop")
        ) {
            closeLightbox();
        }
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closeLightbox();
    });

    function closeLightbox() {
        lightboxImg.src = "";
        lightboxCaption.textContent = "";
        lightbox.hidden = true;
        lightbox.setAttribute("aria-hidden", "true");
        document.documentElement.classList.remove("no-scroll");
    }

    /**
     * ================================
     * Scroll automatique sur catégorie
     * ================================
     */
    const cat = new URLSearchParams(location.search).get("cat");
    if (cat) {
        document
            .getElementById(cat)
            ?.scrollIntoView({ behavior: "smooth", block: "start" });
    }

    /**
     * ==========================
     * Hotfix overlays fantômes
     * ==========================
     * Si une autre page (contact/intro/menu overlay) a laissé des éléments ouverts,
     * on les force à disparaître ici pour éviter le blocage.
     */
    const kill = (sel) =>
        document.querySelectorAll(sel).forEach((el) => {
            el.setAttribute("aria-hidden", "true");
            el.hidden = true;
            el.style.display = "none";
            el.classList.remove("is-open");
        });

    kill(".contact-curtain, #loadingOverlay, .img-lightbox, .menu-overlay");
    document.documentElement.classList.remove("no-scroll");
});

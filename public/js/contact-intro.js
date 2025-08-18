document.addEventListener("DOMContentLoaded", () => {
    // === EmailJS === //
    const EMAILJS_SERVICE_ID  = "service_j8gsazd";
    const EMAILJS_TEMPLATE_ID = "template_mi664sv";
    const EMAILJS_PUBLIC_KEY  = "0inxyCI23tIIDpDhL";

    // Init SDK (une seule fois)
    if (window.emailjs) {
        try { emailjs.init(EMAILJS_PUBLIC_KEY); } catch(e){ console.warn("EmailJS init:", e); }
    }

    /* ---------- Rideau d’intro ---------- */
    const curtain     = document.querySelector(".contact-curtain");
    const btnReveal   = document.getElementById("revealContact");
    const contactPage = document.getElementById("contact-page");

    if (curtain && btnReveal && contactPage) {
        contactPage.style.display = "none";
        curtain.setAttribute("aria-hidden", "false");

        const openCurtain = () => {
            curtain.classList.add("reveal");
            setTimeout(() => {
                curtain.style.display = "none";
                curtain.setAttribute("aria-hidden", "true");
                contactPage.style.display = "block";
                contactPage.animate(
                    [{opacity:0, transform:"translateY(6px)"},{opacity:1, transform:"none"}],
                    {duration:320, easing:"ease-out"}
                );
            }, 760);
        };

        btnReveal.addEventListener("click", (e)=>{ e.preventDefault(); openCurtain(); });
        curtain.addEventListener("click", (e)=>{ if (!e.target.closest(".curtain-cta")) openCurtain(); });
        window.addEventListener("keydown", (e)=>{ if (e.key === "Escape") openCurtain(); });
    }

    /* ---------- Formulaire → EmailJS ---------- */
    const form           = document.getElementById("contact-form");
    const loadingOverlay = document.getElementById("loadingOverlay");
    const resultBox      = document.getElementById("result");
    const btnSubmit      = document.getElementById("contact-submit");

    if (!form) return;

    const isValidEmail = (v) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        if (!window.emailjs) {
            resultBox.innerHTML = "<p class='text-danger'>Service d’envoi indisponible.</p>";
            return;
        }

        // IDs HTML (avec préfixe c_)
        const name    = document.getElementById("c_name")?.value?.trim()    || "";
        const email   = document.getElementById("c_email")?.value?.trim()   || "";
        const phone   = document.getElementById("c_phone")?.value?.trim()   || "";
        const subject = document.getElementById("c_subject")?.value?.trim() || "";
        const message = document.getElementById("c_message")?.value?.trim() || "";
        const consent = document.getElementById("consent")?.checked || false;

        if (!name || !email || !subject || !message) {
            resultBox.innerHTML = "<p class='text-danger'>Merci de remplir tous les champs obligatoires.</p>";
            return;
        }
        if (!isValidEmail(email)) {
            resultBox.innerHTML = "<p class='text-danger'>L’e-mail n’est pas valide.</p>";
            return;
        }
        if (!consent) {
            resultBox.innerHTML = "<p class='text-danger'>Merci d’accepter le traitement de vos données.</p>";
            return;
        }

        const params = {
            name:name,
            email:email,
            phone:phone,
            subject:subject,
            message:message,
        };

        // UI lock
        if (loadingOverlay) loadingOverlay.style.display = "flex";
        if (btnSubmit) { btnSubmit.disabled = true; btnSubmit.dataset.originalText = btnSubmit.textContent; btnSubmit.textContent = "Envoi…"; }

        try {
            const res = await emailjs.send(EMAILJS_SERVICE_ID, EMAILJS_TEMPLATE_ID, params);
            console.log("EmailJS success:", res);
            resultBox.innerHTML = "<p class='text-success'>Message envoyé avec succès ✅</p>";
            form.reset();
        } catch (err) {
            console.error("EmailJS error:", err);
            resultBox.innerHTML = "<p class='text-danger'>Erreur lors de l’envoi. Merci de réessayer.</p>";
        } finally {
            if (loadingOverlay) loadingOverlay.style.display = "none";
            if (btnSubmit) { btnSubmit.disabled = false; btnSubmit.textContent = btnSubmit.dataset.originalText || "Envoyer"; }
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const cover = document.getElementById("cover");
    const horairesPage = document.getElementById("horaires-page");
    const btnShowHoraires = document.getElementById("show-horaires-btn");

    if (!cover || !horairesPage) return;

    // Cover visible au chargement
    cover.style.display = "flex";
    horairesPage.style.display = "none";

    // Bouton pour fermer la cover
    if (btnShowHoraires) {
        btnShowHoraires.addEventListener("click", function () {
            hideCover();
        });
    }

    function hideCover() {
        cover.classList.add("fade-out");
        setTimeout(() => {
            cover.style.display = "none";
            horairesPage.style.display = "block";
        }, 500); // après la transition
    }
});

// public/js/reviews.js
document.addEventListener('DOMContentLoaded', () => {

    // === Avis réels saisis à la main ===
    const REVIEWS = [
        {
            author: "Emmanuelle et Eric BOUTOLLEAU",
            rating: 5,
            text: "Des plats copieux et délicieux, un accueil au top !",
            time: "2025-06-16",
            photo: "images/avatars/Emmanuelle et Eric BOUTOLLEAU.png"
        },
        {
            author: "Tommaso Merone",
            rating: 5,
            text: "Super snack, des produits frais et savoureux, pain burger de qualité. Super accueillant, je recommande fortement",
            time: "2025/07/03",
            photo: "images/avatars/Tommaso Merone.png"
        },
        {
            author: "Solène François",
            rating: 5,
            text: "Super accueil et service 👍🏼 le pain et la viande des burgers sont excellents, les frites maison, et les nuggets/poulet panés aussi et ça c'est rare !",
            time: "2025-04-11",
            photo: "images/avatars/Solène François.png"
        },
        {
            author: "Killian Masurier",
            rating: 5,
            text: "Excellent restaurant de quartier ! Burger ou tacos, ils savent tout faire, l’accueil et le service est irréprochable, l’héritage de l’ancien propriétaire est plus que respecté.",
            time: "2025-06-18",
            photo: "images/avatars/Killian Masurier.png"
        },
        {
            author: "Halbertinne Circée",
            rating: 5,
            text: "Nous avons pris des frites, des Burgers, dont un vege, et des tiramisus. C'était excellent. Le staff était super sympa et pro. Je recommende à 100% !!",
            time: "2025-05-01",
            photo: "images/avatars/Halbertinne Circée.png"
        },
        {
            author: "Christopher Alfano",
            rating: 5,
            text: "Un accueil chaleureux, du goût et un très bon rapport qualité prix.",
            time: "2025-07-26",
            photo: "images/avatars/Christopher Alfano.png"
        },
        {
            author: "Hacer DINCER",
            rating: 5,
            text: "Un accueil chaleureux, une carte variée et des burgers excellents ! Le service est très rapide et sympathique. Nous étions de passage et n'avons pas regretté notre arrêt ! Seul 'bémol 'j'aurai apprécié une alternative au Coca-Cola que nous devons boycotter ! #boycottcocacola",
            time: "2025-07-06",
            photo: "images/avatars/Hacer DINCER.png"
        },
        {
            author: "Magalie Chatelard",
            rating: 5,
            text: "Un super accueil chaleureux ,un serveur bienveillant ,les burger sont super bon et maison j une carte variée (salade tacos burger )e recommande a 100%",
            time: "2025-07-08",
            photo: "images/avatars/Magalie Chatelard.png"
        }
    ];

    const grid = document.getElementById('reviews-grid');
    if (!grid) return;

    // — Helpers —
    const visualStars = (rating) => {
        const rounded = Math.round(rating * 2) / 2;
        const full = Math.floor(rounded);
        const half = rounded - full === 0.5;
        return '★'.repeat(full) + (half ? '☆' : '') + '☆'.repeat(half ? 4 - full : 5 - full);
    };
    const formatDate = (iso) => {
        try {
            const d = new Date(iso);
            return d.toLocaleDateString('fr-FR', { day:'2-digit', month:'short', year:'numeric' }).replace('.', '');
        } catch { return ''; }
    };
    const safeSrc = (p) => p ? encodeURI(p) : 'images/avatars/default.jpg';

    // Option : trier du plus récent au plus ancien
    const sorted = [...REVIEWS].sort((a,b) => new Date(b.time) - new Date(a.time));

    const frag = document.createDocumentFragment();
    sorted.forEach(r => {
        const card = document.createElement('article');
        card.className = 'review-card';
        card.innerHTML = `
      <div class="review-head">
        <img src="${safeSrc(r.photo)}" alt="" class="review-avatar" loading="lazy">
        <div>
          <p class="review-author">${r.author}</p>
          <div class="review-stars" aria-label="${r.rating} sur 5">${'★'.repeat(Math.round(r.rating))}</div>
        </div>
      </div>
      <p class="review-text">${r.text}</p>
      <div class="review-footer">
        <span>${formatDate(r.time)}</span>
        <span aria-hidden="true" style="color:#aaa;">${visualStars(r.rating)}</span>
      </div>
    `;
        frag.appendChild(card);
    });

    grid.appendChild(frag);
});

<!doctype html>
<html lang="fr">
<head>
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/contact-intro.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>La Paillote Fidésienne — Accueil</title>

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

{{-- HEADER --}}
@include('layouts.header')

{{-- MENU OVERLAY --}}
@include('layouts.menu')

<main>

    {{-- HERO : image plein écran --}}
    <section class="home-hero">
        <img src="{{ asset('images/hero-salle.png') }}" alt="" class="hero-bg">
    </section>

    {{-- Titre + localisation --}}
    <section class="home-intro">
        <h2 class="intro-title">
            L’ART DU BURGER MAISON — DANS UN CADRE CHALEUREUX À<br>
            SAINTE-FOY-LÈS-LYON
        </h2>
        <p class="intro-loc">France | Sainte-Foy-Lès-Lyon</p>
    </section>

    {{-- Citation encadrée --}}
    <section class="home-quote">
        <div class="quote-card fade-in">
            <blockquote>
                Chez La Paillote Fidésienne, chaque plat est préparé avec passion, des produits frais et une
                touche de créativité. Que ce soit pour une pause déjeuner rapide ou un dîner entre amis,
                notre équipe vous accueille dans un lieu convivial, moderne et raffiné.
            </blockquote>
        </div>
    </section>

    {{-- SECTION ÉQUIPE (image à gauche, texte centré à droite) --}}
    <section class="home-team">
        <div class="team-grid fade-in">
            <figure class="team-photo">
                <img src="{{ asset('images/equipe-wrap.webp') }}" alt="Préparation en cuisine – La Paillote Fidésienne">
            </figure>

            <div class="team-content">
                <div class="team-content-inner">
                    <div class="team-pill">UNE ÉQUIPE LOCALE, PASSIONNÉE ET AUX PETITS SOINS</div>
                    <div class="team-sep" aria-hidden="true"></div>
                    <p class="team-text">
                        Nous croyons en l’authenticité et en la proximité. Derrière chaque recette, il y a
                        un visage, un sourire, une volonté de vous faire plaisir. Bilal et son équipe vous
                        réservent un accueil chaleureux, et des plats généreux qui vous feront revenir.
                    </p>
                    <a href="{{ url('/equipe') }}" class="btn-outline-gold">DÉCOUVRIR L’ÉQUIPE</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Séparateur palme (entre Équipe et Menus) --}}
    <section class="sep-wrap" aria-hidden="true">
        <svg class="sep palme" viewBox="0 0 180 46" xmlns="http://www.w3.org/2000/svg">
            <path d="M12,34 C40,10 80,10 168,34" />
            <circle cx="90" cy="34" r="2.5"/>
        </svg>
    </section>

    {{-- SECTION MENUS (même style, image à droite, texte centré) --}}
    <section class="home-menu">
        <div class="home-menu-grid fade-in">
            {{-- Colonne texte --}}
            <div class="home-menu-content">
                <div class="home-menu-content-inner">
                    <div class="team-pill home-pill-lg">DES BURGERS MAISON…<br>MAIS PAS QUE</div>
                    <div class="team-sep" aria-hidden="true"></div>
                    <p class="team-text">
                        Notre menu évolue au rythme des saisons, avec des burgers signature,
                        des suggestions végétariennes, des desserts maison et des boissons locales.
                        Tout est fait pour satisfaire vos papilles.
                    </p>
                    <a href="{{ url('/menu') }}" class="btn-outline-gold">VOIR LA CARTE</a>
                </div>
            </div>

            {{-- Colonne image --}}
            <figure class="home-menu-photo">
                <img src="{{ asset('images/home-burger.webp') }}" alt="Burger maison – La Paillote Fidésienne">
            </figure>
        </div>


    </section>
    <section class="sep-wrap" aria-hidden="true">
        <div class="sep rule">
            <span></span><i></i><span></span>
        </div>
    </section>

    {{-- SECTION GALERIE / CAROUSEL --}}
    <section class="home-carousel">
        <div class="hc-slider" id="hcSlider" aria-label="Galerie de préparations">
            <button class="hc-arrow prev" aria-label="Précédent" data-dir="-1">
                <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path d="M15 18l-6-6 6-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>

            <div class="hc-viewport" tabindex="0">
                <ul class="hc-track">
                    {{-- Remplace les sources par les tiennes --}}
                    <li class="hc-slide"><img src="{{ asset('images/slider/photo1.webp') }}" alt="Préparation 1"></li>
                    <li class="hc-slide"><img src="{{ asset('images/slider/photo2.webp') }}" alt="Préparation 2"></li>
                    <li class="hc-slide"><img src="{{ asset('images/slider/photo3.webp') }}" alt="Préparation 3"></li>
                    <li class="hc-slide"><img src="{{ asset('images/slider/photo4.webp') }}" alt="Préparation 4"></li>
                    <li class="hc-slide"><img src="{{ asset('images/slider/photo5.webp') }}" alt="Préparation 5"></li>
                    <li class="hc-slide"><img src="{{ asset('images/slider/photo6.webp') }}" alt="Préparation 6"></li>
                    <li class="hc-slide"><img src="{{ asset('images/slider/photo7.webp') }}" alt="Préparation 7"></li>
                </ul>
            </div>

            <button class="hc-arrow next" aria-label="Suivant" data-dir="1">
                <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path d="M9 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>

            <div class="hc-dots" aria-hidden="true"></div>
        </div>
    </section>



    {{-- Séparateur simple (au-dessus de la newsletter du footer) --}}
    <section class="sep-wrap" aria-hidden="true">
        <div class="sep rule">
            <span></span><i></i><span></span>
        </div>
    </section>

</main>

{{-- FOOTER --}}
@include('layouts.footer')

{{-- Scripts --}}
<script src="{{ asset('js/menu.js') }}?v={{ @filemtime(public_path('js/menu.js')) }}" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        /* Ombre header au scroll */
        const header = document.querySelector('.site-header');
        const onScroll = () => {
            const y = window.pageYOffset || document.documentElement.scrollTop;
            if (!header) return;
            if (y > 4) header.classList.add('is-scrolled'); else header.classList.remove('is-scrolled');
        };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });

        /* Fallback ouverture/fermeture du menu */
        const overlay = document.getElementById('site-menu');
        if (overlay){
            const openBtn = document.querySelector('.menu-toggle');
            const closeBtn = overlay.querySelector('.menu-close');
            const panel   = overlay.querySelector('.menu-panel');

            function openMenu(e){ if(e) e.preventDefault(); overlay.classList.add('is-open'); overlay.setAttribute('aria-hidden','false'); document.body.style.overflow='hidden'; openBtn?.classList.add('is-active'); }
            function closeMenu(e){ if(e) e.preventDefault(); overlay.classList.remove('is-open'); overlay.setAttribute('aria-hidden','true'); document.body.style.overflow=''; openBtn?.classList.remove('is-active'); }

            openBtn?.addEventListener('click', openMenu);
            closeBtn?.addEventListener('click', closeMenu);
            overlay.addEventListener('click', (e)=>{ if(!panel.contains(e.target)) closeMenu(e); });
            window.addEventListener('keydown', (e)=>{ if(e.key === 'Escape') closeMenu(e); });
        }

        /* Fade-in au scroll */
        const targets = document.querySelectorAll('.fade-in');
        if ('IntersectionObserver' in window && targets.length){
            const io = new IntersectionObserver((entries)=>{
                entries.forEach(entry=>{
                    if (entry.isIntersecting){ entry.target.classList.add('visible'); io.unobserve(entry.target); }
                });
            }, { threshold: 0.2 });
            targets.forEach(el=>io.observe(el));
        } else {
            targets.forEach(el=>el.classList.add('visible'));
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slider   = document.getElementById('hcSlider');
        if (!slider) return;

        const viewport = slider.querySelector('.hc-viewport');
        const track    = slider.querySelector('.hc-track');
        const prevBtn  = slider.querySelector('.hc-arrow.prev');
        const nextBtn  = slider.querySelector('.hc-arrow.next');
        const dotsWrap = slider.querySelector('.hc-dots');

        let slides     = Array.from(track.children);
        let perView    = getPerView();
        let clonesHead = [], clonesTail = [];
        let idx        = 0;           // position dans la liste "avec clones"
        let baseCount  = slides.length;
        let autoTimer  = null;
        const SPEED    = 3500;

        buildClones();
        goTo(perView, false);         // on commence sur le 1er “vrai” slide

        // pastilles (pages = nombre de positions “réelles”)
        const pages = Math.max(1, baseCount);
        const dots  = Array.from({length: pages}, (_,i) => {
            const d = document.createElement('span');
            d.className = 'hc-dot' + (i===0?' is-active':'');
            dotsWrap.appendChild(d);
            d.addEventListener('click', () => goTo(perView + i, true));
            return d;
        });

        function getPerView(){
            return parseInt(getComputedStyle(slider).getPropertyValue('--perView')) || 1;
        }

        function slideWidth(){
            const gap = parseFloat(getComputedStyle(slider).getPropertyValue('--gap')) || 0;
            const vw  = viewport.clientWidth;
            return (vw - gap * (perView - 1)) / perView + gap; // largeur d’un bloc + gap
        }

        function buildClones(){
            // nettoie d’anciens clones
            [...clonesHead, ...clonesTail].forEach(el => el.remove());
            clonesHead = []; clonesTail = [];

            perView = getPerView();

            // clones en tête (fin de la liste “réelle”)
            for(let i=0;i<perView;i++){
                const c = slides[slides.length - perView + i].cloneNode(true);
                c.setAttribute('aria-hidden','true');
                track.insertBefore(c, track.firstChild);
                clonesHead.push(c);
            }
            // clones en queue (début de la liste “réelle”)
            for(let i=0;i<perView;i++){
                const c = slides[i].cloneNode(true);
                c.setAttribute('aria-hidden','true');
                track.appendChild(c);
                clonesTail.push(c);
            }
            // maj collection “avec clones”
            slides = Array.from(track.children);
            idx = perView;
            track.style.transition = 'none';
            transformToIndex(idx);
            track.offsetHeight; // force reflow
            track.style.transition = '';
        }

        function transformToIndex(i){
            const x = -i * slideWidth();
            track.style.transform = `translate3d(${x}px,0,0)`;
        }

        function goTo(i, smooth=true){
            track.style.transition = smooth ? '' : 'none';
            idx = i;
            transformToIndex(idx);
        }

        function normalize(){
            // si on dépasse côté fin -> on repart au début “réel”
            if (idx >= baseCount + perView){
                goTo(perView, false);
            }
            // si on dépasse côté début -> on repart au dernier “réel”
            if (idx < perView){
                goTo(baseCount + perView - 1, false);
            }
            updateDots();
        }

        function updateDots(){
            const realIndex = (idx - perView + baseCount) % baseCount;
            dots.forEach((d,i)=> d.classList.toggle('is-active', i===realIndex));
        }

        track.addEventListener('transitionend', normalize);

        // flèches
        prevBtn.addEventListener('click', () => { idx--; goTo(idx); });
        nextBtn.addEventListener('click', () => { idx++; goTo(idx); });

        // autoplay
        function startAuto(){ stopAuto(); autoTimer = setInterval(()=>{ idx++; goTo(idx); }, SPEED); }
        function stopAuto(){ if (autoTimer){ clearInterval(autoTimer); autoTimer = null; } }

        startAuto();
        ['mouseenter','focusin','touchstart'].forEach(ev => slider.addEventListener(ev, stopAuto, {passive:true}));
        ['mouseleave','focusout','touchend'].forEach(ev => slider.addEventListener(ev, startAuto, {passive:true}));

        // clavier dans le viewport
        viewport.addEventListener('keydown', e => {
            if (e.key === 'ArrowRight'){ e.preventDefault(); idx++; goTo(idx); }
            if (e.key === 'ArrowLeft') { e.preventDefault(); idx--; goTo(idx); }
        });

        // resize : si perView change, on reconstruit
        let lastPer = perView;
        window.addEventListener('resize', () => {
            const pv = getPerView();
            if (pv !== lastPer){ lastPer = pv; buildClones(); }
            else { transformToIndex(idx); }
        });
    });
</script>

</script>

</body>
</html>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>L’équipe — La Paillote Fidésienne</title>

    {{-- Feuilles de style --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/equipe.css') }}">
</head>
<body>

{{-- INTRO (voile optionnel) --}}
<div class="team-veil" id="teamVeil">
    <div class="veil-inner">
        <h1>Rencontrez l’équipe</h1>
        <button class="veil-cta" id="veilGo">Entrer</button>
    </div>
</div>

@include('layouts.header')
@include('layouts.menu')

<main>
    {{-- STRIP PHOTOS (marquee) --}}
    <section class="strip">
        <div class="strip-inner">
            <div class="shot"><img src="{{ asset('images/equipe/prepa1.webp') }}" alt=""></div>
            <div class="shot"><img src="{{ asset('images/equipe/prepa2.webp') }}" alt=""></div>
            <div class="shot"><img src="{{ asset('images/equipe/prepa3.webp') }}" alt=""></div>
            <div class="shot"><img src="{{ asset('images/equipe/prepa4.webp') }}" alt=""></div>
            {{-- Dupliquer les shots pour boucle fluide --}}
            <div class="shot"><img src="{{ asset('images/equipe/prepa1.webp') }}" alt=""></div>
            <div class="shot"><img src="{{ asset('images/equipe/prepa2.webp') }}" alt=""></div>
            <div class="shot"><img src="{{ asset('images/equipe/prepa3.webp') }}" alt=""></div>
            <div class="shot"><img src="{{ asset('images/equipe/prepa4.webp') }}" alt=""></div>
        </div>
    </section>

    {{-- SPOTLIGHT (texte + photo) --}}
    <section class="spotlight">
        <article class="card-glass reveal">
            <h3>
                <span>Une équipe, une passion</span>
                <i aria-hidden="true"></i>
            </h3>
            <p>
                Derrière chaque burger servi avec passion se cache une équipe soudée, dynamique et souriante.
            </p>
            <p>
                À La Paillote Fidésienne, nous partageons un engagement commun : une cuisine maison de qualité,
                un accueil chaleureux et une ambiance conviviale. Chacun a sa place, chacun met du cœur —
                et cela se ressent autant dans l’assiette que dans l’atmosphère du lieu.
            </p>
        </article>
        <figure class="spot-photo reveal">
            <img src="{{ asset('images/equipe/tiramisu.webp') }}" alt="Préparation burger">
        </figure>
    </section>

    {{-- STATS --}}
    <section class="stats reveal">
        <div class="stat">
            <b>15+</b>
            <span>Recettes uniques</span>
        </div>
        <div class="stat">
            <b>100%</b>
            <span>Produits frais</span>
        </div>
        <div class="stat">
            <b>400+</b>
            <span>clients satisfaits</span>
        </div>
    </section>

    {{-- ===== Talents / Savoir-faire ===== --}}
    <section class="skills-wrap">
        <header class="skills-head">
            <h3 class="skills-title">Nos talents en cuisine</h3>
            <i class="skills-rule" aria-hidden="true"></i>
        </header>
        <br>
        <div class="skills-grid">
            {{-- 1. Art du grill --}}
            <article class="skill-card reveal lift">
                <figure class="skill-photo">
                    <img src="{{ asset('images/equipe/prepa5.webp') }}" alt="Saisie précise de la viande">
                    <span class="skill-badge">Art du grill</span>
                </figure>
                <div class="skill-body">
                    <h4>Cuisson & Saisie</h4>
                    <p>Maîtrise des températures et des temps de repos pour un résultat fondant à cœur et croustillant à l’extérieur.</p>
                </div>
            </article>

            {{-- 2. Sélection des produits --}}
            <article class="skill-card reveal lift">
                <figure class="skill-photo">
                    <img src="{{ asset('images/equipe/prepa6.webp') }}" alt="Assemblage avec sauces maison">
                    <span class="skill-badge">Sélection des produits</span>
                </figure>
                <div class="skill-body">
                    <h4>Sauces & Assaisonnement</h4>
                    <p>Produits frais, locaux et de saison : une exigence quotidienne qui garantit authenticité et goût à chaque bouchée.</p>
                </div>
            </article>

            {{-- 3. Dressage & Montage --}}
            <article class="skill-card reveal lift">
                <figure class="skill-photo">
                    <img src="{{ asset('images/equipe/prepa7.webp') }}" alt="Dressage soigné">
                    <span class="skill-badge">Dressage</span>
                </figure>
                <div class="skill-body">
                    <h4>Dressage & Montage</h4>
                    <p>Gestes précis, superpositions nettes et régularité pour des burgers aussi beaux que bons.</p>
                </div>
            </article>

            {{-- 4. Produits & Saisonnalité --}}
            <article class="skill-card reveal lift">
                <figure class="skill-photo">
                    <img src="{{ asset('images/equipe/salade.webp') }}" alt="Sélection produits">
                    <span class="skill-badge">fraicheur</span>
                </figure>
                <div class="skill-body">
                    <h4>Produits & Saisonnalité</h4>
                    <p>Sourcing local, légumes de saison et buns de qualité pour une base irréprochable.</p>
                </div>
            </article>

            {{-- 5. Friture maîtrisée --}}
            <article class="skill-card reveal lift">
                <figure class="skill-photo">
                    <img src="{{ asset('images/equipe/frite.webp') }}" alt="Friture maîtrisée">
                    <span class="skill-badge">Friture</span>
                </figure>
                <div class="skill-body">
                    <h4>Friture & Texture</h4>
                    <p>Huile propre, courbes de cuisson et égouttage pour des frites dorées, légères et croustillantes.</p>
                </div>
            </article>

            {{-- 6. Hygiène & Rigueur --}}
            <article class="skill-card reveal lift">
                <figure class="skill-photo">
                    <img src="{{ asset('images/equipe/propre.webp') }}" alt="Hygiène et rigueur">
                    <span class="skill-badge">Hygiène</span>
                </figure>
                <div class="skill-body">
                    <h4>Hygiène & Rigueur</h4>
                    <p>Plan de nettoyage, traçabilité et DLC suivies : des standards pro appliqués au quotidien.</p>
                </div>
            </article>
        </div>
    </section>
</main>

@include('layouts.footer')

{{-- JS --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Intro veil
        const veil = document.getElementById('teamVeil');
        const go = document.getElementById('veilGo');
        if(veil && go){
            go.addEventListener('click', () => veil.classList.add('is-off'));
            setTimeout(() => veil.classList.add('is-off'), 1800);
        }

        // Reveal on scroll
        const els = document.querySelectorAll('.reveal');
        if (!('IntersectionObserver' in window)) {
            els.forEach(e => e.classList.add('in'));
            return;
        }
        const io = new IntersectionObserver((entries) => {
            entries.forEach(en => {
                if (en.isIntersecting){
                    en.target.classList.add('in');
                    io.unobserve(en.target);
                }
            });
        }, { threshold: .18 });
        els.forEach(e => io.observe(e));
    });
</script>
</body>
</html>

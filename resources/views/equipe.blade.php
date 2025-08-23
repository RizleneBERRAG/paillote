{{-- resources/views/equipe.blade.php --}}
    <!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>L’équipe — La Paillote Fidésienne</title>

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/equipe.css') }}">
</head>
<body>

{{-- ===== Voile d’intro (optionnel) ===== --}}
<div class="team-veil" id="teamVeil" aria-hidden="false">
    <div class="veil-inner">
        <h1>Rencontrez l’équipe</h1>
        <button class="veil-cta" id="veilEnter" type="button" aria-controls="team-page">Entrer</button>
    </div>
</div>

{{-- ===== Contenu page (scopé) ===== --}}
<div id="team-page">
    @include('layouts.header')
    @include('layouts.menu')

    <main>

        {{-- STRIP PHOTOS (marquee) --}}
        <section class="strip" aria-label="Aperçu des préparations">
            <div class="strip-inner">
                <div class="shot"><img src="{{ asset('images/equipe/prepa1.webp') }}" alt="Saisie de la viande" loading="lazy"></div>
                <div class="shot"><img src="{{ asset('images/equipe/prepa2.webp') }}" alt="Préparation des buns" loading="lazy"></div>
                <div class="shot"><img src="{{ asset('images/equipe/prepa3.webp') }}" alt="Dressage soigné" loading="lazy"></div>
                <div class="shot"><img src="{{ asset('images/equipe/prepa4.webp') }}" alt="Sauces maison" loading="lazy"></div>
            </div>
        </section>

        {{-- SPOTLIGHT (texte + photo) --}}
        <section class="spotlight" aria-label="Notre esprit d’équipe">
            <article class="card-glass reveal">
                <h3>
                    <span>Une équipe, une passion</span>
                    <i aria-hidden="true"></i>
                </h3>
                <p>Derrière chaque burger servi avec passion se cache une équipe soudée, dynamique et souriante.</p>
                <p>À La Paillote Fidésienne, nous partageons un engagement commun : une cuisine maison de qualité,
                    un accueil chaleureux et une ambiance conviviale. Chacun a sa place, chacun met du cœur — et cela
                    se ressent autant dans l’assiette que dans l’atmosphère du lieu.</p>
            </article>
            <figure class="spot-photo reveal">
                <img src="{{ asset('images/equipe/tiramisu.webp') }}" alt="Dressage d’un burger par notre brigade" loading="lazy">
            </figure>
        </section>

        {{-- STATS --}}
        <section class="stats reveal" aria-label="Quelques chiffres">
            <div class="stat"><b>15+</b><span>Recettes uniques</span></div>
            <div class="stat"><b>100%</b><span>Produits frais</span></div>
            <div class="stat"><b>400+</b><span>Clients satisfaits</span></div>
        </section>

        {{-- Talents / Savoir-faire --}}
        <section class="skills-wrap" aria-label="Nos talents en cuisine">
            <header class="skills-head">
                <h3 class="skills-title">Nos talents en cuisine</h3>
                <i class="skills-rule" aria-hidden="true"></i>
            </header>

            <div class="skills-grid">
                <article class="skill-card reveal lift">
                    <figure class="skill-photo">
                        <img src="{{ asset('images/equipe/prepa5.webp') }}" alt="Saisie précise de la viande" loading="lazy">
                        <span class="skill-badge">Art du grill</span>
                    </figure>
                    <div class="skill-body">
                        <h4>Cuisson & Saisie</h4>
                        <p>Maîtrise des températures et des temps de repos pour un résultat fondant à cœur et croustillant à l’extérieur.</p>
                    </div>
                </article>

                <article class="skill-card reveal lift">
                    <figure class="skill-photo">
                        <img src="{{ asset('images/equipe/prepa6.webp') }}" alt="Sélection des produits et assaisonnement" loading="lazy">
                        <span class="skill-badge">Sélection des produits</span>
                    </figure>
                    <div class="skill-body">
                        <h4>Sauces & Assaisonnement</h4>
                        <p>Produits frais, locaux et de saison : une exigence quotidienne qui garantit authenticité et goût.</p>
                    </div>
                </article>

                <article class="skill-card reveal lift">
                    <figure class="skill-photo">
                        <img src="{{ asset('images/equipe/prepa7.webp') }}" alt="Dressage soigné d’un burger" loading="lazy">
                        <span class="skill-badge">Dressage</span>
                    </figure>
                    <div class="skill-body">
                        <h4>Dressage & Montage</h4>
                        <p>Gestes précis, superpositions nettes et régularité pour des burgers aussi beaux que bons.</p>
                    </div>
                </article>

                <article class="skill-card reveal lift">
                    <figure class="skill-photo">
                        <img src="{{ asset('images/equipe/salade.webp') }}" alt="Préparation de légumes frais" loading="lazy">
                        <span class="skill-badge">Fraîcheur</span>
                    </figure>
                    <div class="skill-body">
                        <h4>Produits & Saisonnalité</h4>
                        <p>Sourcing local, légumes de saison et buns de qualité pour une base irréprochable.</p>
                    </div>
                </article>

                <article class="skill-card reveal lift">
                    <figure class="skill-photo">
                        <img src="{{ asset('images/equipe/frite.webp') }}" alt="Friture maîtrisée" loading="lazy">
                        <span class="skill-badge">Friture</span>
                    </figure>
                    <div class="skill-body">
                        <h4>Friture & Texture</h4>
                        <p>Huile propre, courbes de cuisson et égouttage pour des frites dorées, légères et croustillantes.</p>
                    </div>
                </article>

                <article class="skill-card reveal lift">
                    <figure class="skill-photo">
                        <img src="{{ asset('images/equipe/propre.webp') }}" alt="Hygiène et rigueur en cuisine" loading="lazy">
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
</div>

{{-- Scripts --}}
<script src="{{ asset('js/menu.js') }}" defer></script>
<script src="{{ asset('js/equipe.js') }}" defer></script>
</body>
</html>

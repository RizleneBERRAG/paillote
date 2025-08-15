<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>La Paillote Fidésienne — Accueil</title>

    {{-- Styles du header, menu overlay et footer --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>
<body>

{{-- HEADER --}}
@include('layouts.header')

{{-- MENU OVERLAY --}}
@include('layouts.menu')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var header = document.querySelector('.site-header');
        if (!header) return;

        var last = 0;
        function onScroll(){
            var y = window.pageYOffset || document.documentElement.scrollTop;
            if (y > 4 && !header.classList.contains('is-scrolled')) {
                header.classList.add('is-scrolled');
            } else if (y <= 4 && header.classList.contains('is-scrolled')) {
                header.classList.remove('is-scrolled');
            }
            last = y;
        }
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    });
</script>

{{-- CONTENU DE LA PAGE --}}
<main>
    <main>

        {{-- HERO plein écran largeur, image de fond --}}
        <section class="home-hero"></section>

        {{-- Titre + localisation --}}
        <section class="home-intro">
            <h2 class="intro-title">
                L’ART DU BURGER MAISON — DANS UN CADRE CHALEUREUX À<br>
                SAINTE-FOY-LÈS-LYON
            </h2>
            <p class="intro-loc">France | Sainte-Foy-Lès-Lyon</p>
        </section>

        {{-- Citation encadrée noire avec guillemets dorés --}}
        <section class="home-quote">
            <figure class="quote-card">
                <blockquote>
                    Chez La Paillote Fidésienne, chaque plat est préparé avec passion, des produits frais et une touche de créativité.
                    Que ce soit pour une pause déjeuner rapide ou un dîner entre amis, notre équipe vous accueille dans un lieu convivial,
                    moderne et raffiné.
                </blockquote>
            </figure>
        </section>

    </main>

</main>

{{-- FOOTER --}}
@include('layouts.footer')

{{-- Script du menu (fichier) --}}
<script src="{{ asset('js/menu.js') }}?v={{ @filemtime(public_path('js/menu.js')) }}" defer></script>

{{-- Filet de sécurité inline (ouvre/ferme le menu) --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var overlay = document.getElementById('site-menu');
        if (!overlay) return;

        var openBtn = document.querySelector('.menu-toggle');   // bouton burger dans le header
        var closeBtn = overlay.querySelector('.menu-close');    // bouton croix dans l'overlay
        var panel   = overlay.querySelector('.menu-panel');     // panneau blanc interne

        function openMenu(e){
            if(e) e.preventDefault();
            overlay.classList.add('is-open');
            overlay.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            if (openBtn) openBtn.classList.add('is-active');
        }
        function closeMenu(e){
            if(e) e.preventDefault();
            overlay.classList.remove('is-open');
            overlay.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            if (openBtn) openBtn.classList.remove('is-active');
        }

        if (openBtn) openBtn.addEventListener('click', openMenu);
        if (closeBtn) closeBtn.addEventListener('click', closeMenu);

        // Fermer au clic en dehors du panneau
        overlay.addEventListener('click', function (e) {
            if (!panel.contains(e.target)) closeMenu(e);
        });

        // Fermer avec Echap
        window.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeMenu(e);
        });
    });
</script>

<link rel="stylesheet" href="{{ asset('css/home.css') }}">


</body>
</html>

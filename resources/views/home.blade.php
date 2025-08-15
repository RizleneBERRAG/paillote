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

{{-- CONTENU DE LA PAGE --}}
<main>
    <section class="hero" style="padding:48px 24px; max-width:1180px; margin:0 auto;">
        <h1 style="margin:0 0 8px;">Bienvenue à La Paillote Fidésienne</h1>
        <p style="margin:0;color:#444">Restaurant de burgers maison à Sainte-Foy-Lès-Lyon.</p>
    </section>
    {{-- Ajoute ici tes autres sections d’accueil --}}
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

</body>
</html>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Horaires — La Paillote Fidésienne</title>

    {{-- Styles globaux --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    {{-- Styles de la page Horaires (cover + tableau horaires) --}}
    <link rel="stylesheet" href="{{ asset('css/hours.css') }}">
</head>
<body>

{{-- COVER noir plein écran (sans image) --}}
<div id="cover" class="cover" aria-hidden="false">
    <h1 class="cover-title">Horaires</h1>
    <button id="show-horaires-btn" class="cover-cta">Voir les horaires</button>
</div>

{{-- CONTENU COMPLET DE LA PAGE (caché tant que la cover est visible) --}}
<div id="horaires-page" style="display:none;">

    {{-- Header fixe + menu overlay --}}
    @include('layouts.header')
    @include('layouts.menu')

    <main>
        {{-- HERO image plein écran --}}
        <section class="hours-hero">
            <img src="{{ asset('images/horaire/hero1.png') }}" alt="" class="hero-bg">
        </section>

        {{-- Bloc horaires --}}
        <section class="hours-wrap">
            <div class="hours-card">
                <h1 class="hours-title">HEURES D’OUVERTURE</h1>

                <div class="hours-table">
                    <div class="row">
                        <div class="day">LUNDI</div>
                        <div class="time">11H30 – 14H30 / 18H00 – 23H00</div>
                    </div>
                    <div class="row">
                        <div class="day">MARDI</div>
                        <div class="time">11H30 – 14H30 / 18H00 – 23H00</div>
                    </div>
                    <div class="row">
                        <div class="day">MERCREDI</div>
                        <div class="time">11H30 – 14H30 / 18H00 – 23H00</div>
                    </div>
                    <div class="row">
                        <div class="day">JEUDI</div>
                        <div class="time">11H30 – 14H30 / 18H00 – 23H00</div>
                    </div>
                    <div class="row">
                        <div class="day">VENDREDI</div>
                        <div class="time">18H00 – 23H30</div>
                    </div>
                    <div class="row">
                        <div class="day">SAMEDI</div>
                        <div class="time off">18H00 – 23H00</div>
                    </div>
                    <div class="row">
                        <div class="day">DIMANCHE</div>
                        <div class="time off">18H00 – 23H00</div>
                    </div>
                </div>

                <div class="cutlery" aria-hidden="true">
                    <svg viewBox="0 0 64 64" width="52" height="52" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round">
                        <path d="M14 10v16M22 10v16M18 10v44"/>
                        <path d="M46 10c-7 8-10 16-10 22 0 6 5 9 10 2V54"/>
                    </svg>
                </div>
            </div>
        </section>


        {{-- ====== AVIS GOOGLE ====== --}}
        <section class="reviews-wrap">
            <div class="reviews-head">
                <h2 class="reviews-title">Les témoignages qui font notre fierté</h2>
                <br>

                <a class="btn-outline-gold reviews-cta"
                   href="https://www.google.com/search?sa=X&sca_esv=bbd057e915ef1d8e&rlz=1C1CHZN_frFR983FR983&hl=fr-FR&biw=1920&bih=1065&tbm=lcl&q=avis%20sur%20la%20paillote%20fid%C3%A9sienne&rflfq=1&num=20&stick=H4sIAAAAAAAAAONgkxK2NLQwMLE0NzE1tzQzNTA3MzY02sDI-IpRIbEss1ihuLRIISdRoSAxMycnvyRVIS0z5fDK4szUvLzURawElQAAN59iO2AAAAA&rldimm=9180497457965076312&ved=0CCEQ5foLahcKEwjwg9ft5o-PAxUAAAAAHQAAAAAQCw#lkt=LocalPoiReviews&arid=ChZDSUhNMG9nS0VJQ0FnTUNJaEtlcEJ3EAE"
                   target="_blank" rel="noopener">
                    Découvrir plus d’avis sur Google !
                </a>
            </div>

            <div id="reviews-grid" class="reviews-grid" aria-live="polite"></div>
        </section>

        {{-- tu pourras ajouter d’autres sections ici (info, contact, carte, etc.) --}}
    </main>

    {{-- Footer --}}
    @include('layouts.footer')
</div>

{{-- Scripts --}}
<script src="{{ asset('js/menu.js') }}" defer></script>
<script src="{{ asset('js/horaires.js') }}" defer></script>
<script src="{{ asset('js/reviews.js') }}" defer></script>

</body>
</html>

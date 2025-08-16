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
                        <div class="time off">FERMÉ</div>
                    </div>
                    <div class="row">
                        <div class="day">MARDI</div>
                        <div class="time">11H30 – 14H / 18H – 22H</div>
                    </div>
                    <div class="row">
                        <div class="day">MERCREDI</div>
                        <div class="time">11H30 – 14H / 18H – 22H</div>
                    </div>
                    <div class="row">
                        <div class="day">JEUDI</div>
                        <div class="time">11H30 – 14H / 18H – 22H</div>
                    </div>
                    <div class="row">
                        <div class="day">VENDREDI</div>
                        <div class="time">11H30 – 14H / 18H – 23H</div>
                    </div>
                    <div class="row">
                        <div class="day">SAMEDI</div>
                        <div class="time">18H – 23H</div>
                    </div>
                    <div class="row">
                        <div class="day">DIMANCHE</div>
                        <div class="time off">FERMÉ</div>
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

        {{-- tu pourras ajouter d’autres sections ici (info, contact, carte, etc.) --}}
    </main>

    {{-- Footer --}}
    @include('layouts.footer')
</div>

{{-- Scripts --}}
<script src="{{ asset('js/menu.js') }}" defer></script>
<script src="{{ asset('js/horaires.js') }}" defer></script>
</body>
</html>

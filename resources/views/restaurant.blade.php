{{-- resources/views/restaurant.blade.php --}}
    <!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Le Restaurant — La Paillote Fidésienne</title>

    {{-- Styles globaux --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    {{-- Style galerie noir luxe --}}
    <link rel="stylesheet" href="{{ asset('css/restaurant.css') }}">
</head>
<body>

{{-- Header + Menu (toujours visibles) --}}
@include('layouts.header')
@include('layouts.menu')

<main id="rest-page" class="rest-page">

    {{-- ===== HERO compact luxe ===== --}}
    <section class="rest-hero" aria-label="Le Restaurant">
        <div class="rest-hero-inner">
            <div class="hero-band">
                <i class="rule"></i>
                <h1 class="hero-title">Le Restaurant</h1>
                <i class="rule"></i>
            </div>
            <p class="hero-sub">Cuisine maison, produits frais & ambiance chaleureuse</p>

            {{-- Filtres sous le titre (pills) --}}
            <nav class="gallery-filters" aria-label="Filtres de galerie">
                <button class="gf-btn is-active" data-filter="all">Tout</button>
                <button class="gf-btn" data-filter="cuisine">Cuisine</button>
                <button class="gf-btn" data-filter="menu">Menu</button>
                <button class="gf-btn" data-filter="préparations">Préparations</button>
            </nav>
        </div>
    </section>

    {{-- ===== Titre de section ===== --}}
    <header class="section-head">
        <br>
        <span class="section-kicker">Notre univers</span>
        <h3 class="section-title">Galerie</h3>
        <br>
        <br>
        <br>


    </header>

    {{-- ===== Galerie ===== --}}
    @php
        $galerie = [
            'cuisine' => [
                'DSC00629-scaled.webp','DSC00638-scaled.webp','DSC00644-scaled.webp',
                'DSC00646-scaled.webp','DSC00652-scaled.webp','DSC00665-scaled.webp',
                'DSC00675-scaled.webp','DSC00689-scaled.webp','DSC00690-scaled.webp',
                'DSC00693-scaled.webp','DSC00694-scaled.webp','DSC00698-scaled.webp',
                'DSC00700-scaled.webp','DSC00702-scaled.webp','DSC00716-scaled.webp',
                'DSC00717-scaled.webp','DSC00722-scaled.webp','DSC00728-scaled.webp',
                'DSC00738-scaled.webp','DSC00743-scaled.webp','DSC00752-scaled.webp',
                'DSC00758-scaled.webp','DSC00761-scaled.webp','DSC00766-scaled.webp',
                'DSC00776-scaled.webp','DSC00803-scaled.webp','DSC00804-scaled.webp',
                'DSC00817-scaled.webp','DSC00818-scaled.webp','DSC00836-scaled.webp',
            ],
            'menu' => [
                'DSC00788-scaled.webp','DSC00793-scaled.webp','DSC00796-scaled.webp',
                'DSC00800-scaled.webp','DSC00841-scaled.webp','DSC00842-scaled.webp',
                'DSC00846-scaled.webp','DSC00848-scaled.webp','DSC00854-scaled.webp',
                'DSC00856-scaled.webp','DSC00858-scaled.webp','DSC00863-scaled.webp',
            ],
            'préparations' => [
                'DSC00187-scaled.webp','DSC00189-scaled.webp','DSC00197-scaled.webp',
                'DSC00218-scaled.webp','DSC00230-scaled.webp','DSC00290-scaled.webp',
                'DSC00304-scaled.webp','DSC00340-scaled.webp','DSC00352-scaled.webp',
                'DSC00355-scaled.webp','DSC00379-scaled.webp','DSC00392-scaled.webp',
                'DSC00455-scaled.webp','DSC00465-scaled.webp','DSC00469-scaled.webp',
                'DSC00482-scaled.webp','DSC00494-scaled.webp','DSC00512-scaled.webp',
                'DSC00521-scaled.webp','DSC00550-scaled.webp','DSC00584-scaled.webp',
                'DSC00607-scaled.webp','DSC00619-scaled.webp',
            ],
        ];
    @endphp

    <section class="gallery-wrap">
        <div class="gallery-grid" id="galleryGrid">
            @foreach ($galerie as $categorie => $fichiers)
                @php $catSegment = rawurlencode($categorie); @endphp
                @foreach ($fichiers as $file)
                    @php
                        $fileSegment = rawurlencode($file);
                        $src = asset("images/galerie/{$catSegment}/{$fileSegment}");
                    @endphp
                    <figure class="g-item reveal" data-cat="{{ $categorie }}">
                        <img
                            src="{{ $src }}"
                            data-full="{{ $src }}"
                            alt="{{ $categorie }}"
                            loading="lazy"
                            width="800" height="600"
                        >
                    </figure>
                @endforeach
            @endforeach
        </div>
    </section>
</main>

{{-- ===== Lightbox ===== --}}
<div id="lightbox" class="lightbox" aria-hidden="true">
    <button class="lb-close" aria-label="Fermer (Échap)">&times;</button>
    <img id="lightboxImg" src="" alt="">
</div>

{{-- Footer --}}
@include('layouts.footer')

{{-- Scripts --}}
<script src="{{ asset('js/menu.js') }}" defer></script>
<script src="{{ asset('js/restaurant.js') }}" defer></script>
</body>
</html>

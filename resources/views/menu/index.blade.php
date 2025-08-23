{{-- resources/views/menu/index.blade.php --}}
    <!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>La Paillote Fidésienne — Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSS globaux --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    {{-- CSS carte (thème sombre + doré, slider tactile, lightbox) --}}
    <link rel="stylesheet" href="{{ asset('css/carte.css') }}">
</head>
<body>

{{-- HEADER & MENU OVERLAY --}}
@include('layouts.header')
@include('layouts.menu')

<main class="container">

    {{-- Filtres par catégorie --}}
    <nav class="anchors" aria-label="Catégories du menu">
        @php
            $isActive = fn ($k) => (request('cat') === $k) ? ' style=background:#eee;' : '';
            $url = fn ($k) => $k ? route('menu', ['cat' => $k]) : route('menu');
        @endphp
        <a class="pill" href="{{ $url(null) }}"      {!! $isActive(null) !!}>Toutes</a>
        <a class="pill" href="{{ $url('burgers') }}" {!! $isActive('burgers') !!}>Burgers</a>
        <a class="pill" href="{{ $url('tacos') }}"   {!! $isActive('tacos') !!}>Tacos</a>
        <a class="pill" href="{{ $url('sandwiches') }}" {!! $isActive('sandwiches') !!}>Sandwiches</a>
        <a class="pill" href="{{ $url('salades') }}" {!! $isActive('salades') !!}>Salades</a>
        <a class="pill" href="{{ $url('desserts') }}" {!! $isActive('desserts') !!}>Desserts</a>
    </nav>

    <hr class="sep">

    {{-- Helpers --}}
    @php
        $euros  = fn ($n) => number_format((float)$n, 2, ',', ' ') . ' €';
        $imgUrl = fn ($path) => $path ? asset('images/' . ltrim($path, '/')) : null;

        $sections = [
            'burgers'    => $burgers,
            'tacos'      => $tacos,
            'sandwiches' => $sandwiches,
            'salades'    => $salades,
            'desserts'   => $desserts,
        ];
    @endphp

    @foreach($sections as $slug => $items)
        <section id="{{ $slug }}" class="section" aria-labelledby="title-{{ $slug }}">
            <h2 id="title-{{ $slug }}">Nos {{ ucfirst($slug) }}</h2>

            @if(!$items->isEmpty())
                <div class="slider" aria-label="Slider des {{ $slug }}">
                    @foreach($items as $item)
                        @php
                            $src = $imgUrl($item->image_path ?? null);
                            $key = method_exists($item, 'getKey') ? $item->getKey() : ($item->id ?? null);
                        @endphp

                        <article class="card">
                            @if($src)
                                <img class="thumb" src="{{ $src }}" alt="Photo de {{ $item->nom }}" loading="lazy" decoding="async">
                            @endif

                            <div class="item-title">
                                <span>{{ $item->nom }}</span>
                                <span class="price">{{ $euros($item->prix) }}</span>
                            </div>

                            <p class="muted">{{ $item->description }}</p>

                            @if($src)
                                <button
                                    class="see-photo"
                                    type="button"
                                    data-img="{{ $src }}"
                                    data-title="{{ $item->nom }}"
                                    data-key="{{ $slug }}-{{ $key }}">
                                    Voir la photo
                                </button>
                            @endif
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    @endforeach

</main>

{{-- FOOTER --}}
@include('layouts.footer')

{{-- Lightbox globale (une seule instance) --}}
<div id="img-lightbox" class="img-lightbox" hidden aria-hidden="true" role="dialog" aria-modal="true">
    <div class="img-lightbox-backdrop"></div>
    <figure class="img-lightbox-panel">
        <button type="button" class="img-lightbox-close" aria-label="Fermer">×</button>
        <img id="img-lightbox-img" src="" alt="" loading="lazy" decoding="async">
        <figcaption id="img-lightbox-caption" class="caption"></figcaption>
    </figure>
</div>

{{-- Script lightbox (léger, sans dépendances) --}}
<script>
    document.addEventListener('click', e => {
        const btn = e.target.closest('.see-photo');
        if (btn) {
            const box     = document.getElementById('img-lightbox');
            const img     = document.getElementById('img-lightbox-img');
            const caption = document.getElementById('img-lightbox-caption');
            img.src = btn.dataset.img || '';
            caption.textContent = btn.dataset.title || '';
            box.hidden = false;
            box.setAttribute('aria-hidden', 'false');
            document.documentElement.classList.add('no-scroll');
            return;
        }
        if (e.target.closest('.img-lightbox-close') || e.target.closest('.img-lightbox-backdrop')) {
            const box = document.getElementById('img-lightbox');
            const img = document.getElementById('img-lightbox-img');
            const caption = document.getElementById('img-lightbox-caption');
            img.src = '';
            caption.textContent = '';
            box.hidden = true;
            box.setAttribute('aria-hidden', 'true');
            document.documentElement.classList.remove('no-scroll');
        }
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            document.querySelector('.img-lightbox-close')?.click();
        }
    });
</script>

</body>
</html>

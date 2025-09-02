{{-- resources/views/menu/index.blade.php --}}
    <!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>La Paillote Fidésienne — Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="images/png" sizes="32x32" href="{{ asset('images/favicon.ico.png') }}">

    {{-- CSS globaux --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    {{-- CSS carte (thème sombre + doré, slider tactile, lightbox) --}}
    <link rel="stylesheet" href="{{ asset('css/carte.css') }}">

</head>
<body class="menu-page">

{{-- HEADER & MENU OVERLAY --}}
<div class="no-fixed-header">
    @include('layouts.header')
</div>
@include('layouts.menu')

<main class="container">

    {{-- Filtres par catégorie --}}
    <nav class="anchors" aria-label="Catégories du menu">
        @php
            $url = fn ($k) => $k ? route('menu', ['cat' => $k]) : route('menu');
            $active = request('cat');
        @endphp

        <a class="pill {{ $active ? '' : 'is-active' }}" href="{{ $url(null) }}">Toutes</a>
        <a class="pill {{ $active==='burgers' ? 'is-active' : '' }}" href="{{ $url('burgers') }}">Burgers</a>
        <a class="pill {{ $active==='tacos' ? 'is-active' : '' }}" href="{{ $url('tacos') }}">Tacos</a>
        <a class="pill {{ $active==='sandwiches' ? 'is-active' : '' }}" href="{{ $url('sandwiches') }}">Sandwiches</a>
        <a class="pill {{ $active==='salades' ? 'is-active' : '' }}" href="{{ $url('salades') }}">Salades</a>
        <a class="pill {{ $active==='desserts' ? 'is-active' : '' }}" href="{{ $url('desserts') }}">Desserts</a>
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

{{-- Lightbox globale --}}
<div id="img-lightbox" class="img-lightbox" hidden aria-hidden="true" role="dialog" aria-modal="true">
    <div class="img-lightbox-backdrop"></div>
    <figure class="img-lightbox-panel">
        <button type="button" class="img-lightbox-close" aria-label="Fermer">×</button>
        <img id="img-lightbox-img" src="" alt="" loading="lazy" decoding="async">
        <figcaption id="img-lightbox-caption" class="caption"></figcaption>
    </figure>
</div>

{{-- Scripts --}}
<script>
    /**
     * Lightbox robuste (ouvre sur .see-photo ET .thumb, se ferme partout)
     * - ferme sur croix, clic hors panneau, Escape
     * - désactive le scroll uniquement quand ouverte
     * - pas d'erreurs si un élément manque
     */
    (function () {
        const qs  = (sel, root=document) => root.querySelector(sel);
        const qsa = (sel, root=document) => Array.from(root.querySelectorAll(sel));

        const box     = qs('#img-lightbox');
        const img     = qs('#img-lightbox-img');
        const caption = qs('#img-lightbox-caption');
        const closeBt = qs('.img-lightbox-close');

        if (!box || !img || !caption || !closeBt) return; // sécurité si markup absent

        let isOpen = false;

        function openLightbox(src, title) {
            if (!src) return;
            img.src = src;
            caption.textContent = title || '';
            box.hidden = false;
            box.setAttribute('aria-hidden', 'false');
            document.documentElement.classList.add('no-scroll');
            isOpen = true;
        }

        function closeLightbox() {
            if (!isOpen) return;
            img.src = '';
            caption.textContent = '';
            box.setAttribute('aria-hidden', 'true');
            box.hidden = true;
            document.documentElement.classList.remove('no-scroll');
            isOpen = false;
        }

        // Délégué : ouvre en cliquant sur .see-photo OU l’image .thumb
        document.addEventListener('click', (e) => {
            // Bouton "Voir la photo"
            const btn = e.target.closest('.see-photo');
            if (btn) {
                e.preventDefault();
                openLightbox(btn.dataset.img, btn.dataset.title);
                return;
            }

            // Image de la carte
            const pic = e.target.closest('.thumb');
            if (pic) {
                // on prend l'URL de l'image affichée + titre = alt ou texte du produit
                const src   = pic.getAttribute('src');
                const title = pic.getAttribute('alt') || pic.closest('.card')?.querySelector('.item-title span')?.textContent || '';
                openLightbox(src, title);
                return;
            }

            // Clics de fermeture (croix ou backdrop)
            if (e.target.closest('.img-lightbox-close') || e.target.closest('.img-lightbox-backdrop')) {
                e.preventDefault();
                closeLightbox();
                return;
            }
        });

        // Escape = fermer
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeLightbox();
        });

        // Défense : si une img ne charge pas, on ferme proprement
        img.addEventListener('error', closeLightbox);
    })();
</script>



<script src="{{ asset('js/menu.js') }}" defer></script>
<script src="{{ asset('js/equipe.js') }}" defer></script>

</body>
</html>

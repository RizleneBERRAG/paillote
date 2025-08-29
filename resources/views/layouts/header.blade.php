<header class="site-header">

    <div class="header-inner">

        {{-- =================== PARTIE GAUCHE ===================
             - Bouton "burger" (≡) pour ouvrir/fermer le menu sur mobile
             - Lien direct vers la plateforme Bornéo pour commander en ligne --}}
        <div class="header-left">
            {{-- Bouton menu (3 barres) accessible via aria-label --}}
            <button class="menu-toggle" aria-label="Ouvrir le menu">
                <span></span><span></span><span></span>
            </button>

            {{-- Lien externe vers Bornéo (nouvel onglet, sécurisé avec rel="noopener") --}}
            <a href="https://borneoapp.com/LaPailloteFidesienneSFLL"
               class="order" target="_blank" rel="noopener">
                <span class="order-icon">
                  <img src="{{ asset('images/borneo.png') }}" alt="Commander avec Borneō">
                </span>
                <span class="order-text">COMMANDEZ</span>
            </a>
        </div>

        {{-- =================== PARTIE CENTRALE ===================
             Logo rond du restaurant qui renvoie toujours à la page d’accueil --}}
        <div class="header-center">
            <a href="{{ url('/') }}" class="logo-box" aria-label="Accueil">
                <img src="{{ asset('images/logo-round.png') }}" alt="La Paillote Fidésienne" class="logo-img">
            </a>
        </div>

        {{-- =================== PARTIE DROITE ===================
             - Numéro de téléphone cliquable
             - Lien vers la page des horaires --}}
        <div class="header-right">
            {{-- Téléphone : lien "tel:" + icône téléphone en SVG --}}
            <a href="tel:0744271261" class="menu-phone" aria-label="Appeler La Paillote Fidésienne">
                <svg class="ico-badge" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 1 3.18 2 2 0 0 1 3.11 1h3a2 2 0 0 1 2 1.72c.12.81.3 1.6.54 2.34a2 2 0 0 1-.45 2.11L7 8.1a16 16 0 0 0 9 9l1.93-1.93a2 2 0 0 1 2.11-.45c.74.24 1.53.42 2.34.54A2 2 0 0 1 22 16.92z"/>
                </svg>
                <span class="label">07 44 27 12 61</span>
            </a>

            {{-- Horaires : lien interne (route nommée "horaires") + icône horloge --}}
            <a href="{{ route('horaires') }}" class="hours" aria-label="Voir les horaires">
                <svg class="ico-badge" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 7v5l3 2"/>
                </svg>
                <span class="label">HORAIRES</span>
            </a>
        </div>

    </div>
</header>


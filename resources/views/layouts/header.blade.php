<header class="site-header">
    <div class="header-inner">

        {{-- Gauche : burger + BORNEŌ --}}
        <div class="header-left">
            <button class="menu-toggle" aria-label="Ouvrir le menu">
                <span></span><span></span><span></span>
            </button>

            <a href="https://borneoapp.com/LaPailloteFidesienneSFLL"
               class="order" target="_blank" rel="noopener">
        <span class="order-icon">
          <img src="{{ asset('images/borneo.png') }}" alt="Commander avec Borneō">
        </span>
                <span class="order-text">COMMANDEZ</span>
            </a>
        </div>

        {{-- Centre : logo --}}
        <div class="header-center">
            <a href="{{ url('/') }}" class="logo-box" aria-label="Accueil">
                <img src="{{ asset('images/logo-round.png') }}" alt="La Paillote Fidésienne" class="logo-img">
            </a>
        </div>

        {{-- Droite : téléphone + horaires --}}
        <div class="header-right">
            <a href="tel:0744271261" class="menu-phone" aria-label="Appeler La Paillote Fidésienne">
                {{-- Icône téléphone (inline SVG, suit currentColor) --}}
                <svg class="ico-badge" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 1 3.18 2 2 0 0 1 3.11 1h3a2 2 0 0 1 2 1.72c.12.81.3 1.6.54 2.34a2 2 0 0 1-.45 2.11L7 8.1a16 16 0 0 0 9 9l1.93-1.93a2 2 0 0 1 2.11-.45c.74.24 1.53.42 2.34.54A2 2 0 0 1 22 16.92z"/>
                </svg>
                <span class="label">07 44 27 12 61</span>
            </a>

            <a href="{{ route('horaires') }}" class="hours" aria-label="Voir les horaires">
                {{-- Icône horloge (inline SVG, suit currentColor) --}}
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

<header class="site-header">
    <div class="header-inner">

        {{-- Gauche : burger + Commandez --}}
        <div class="header-left">
            <!-- Bouton menu -->
            <button class="menu-toggle" aria-label="Ouvrir le menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <a href="https://borneoapp.com/LaPailloteFidesienneSFLL"
               class="order" target="_blank" rel="noopener">
                <span class="order-icon">
                    <img src="{{ asset('images/borneo.png') }}" alt="Borneō" />
                </span>
                <span class="order-text">COMMANDEZ</span>
            </a>
        </div>

        {{-- Centre : logo arrondi --}}
        <div class="header-center">
            <a href="{{ url('/') }}" class="logo-box" aria-label="Accueil">
                <img src="{{ asset('images/logo-round.png') }}" alt="La Paillote Fidésienne" class="logo-img">
            </a>
        </div>

        {{-- Droite : téléphone + Horaires --}}
        <div class="header-right">
            <a href="tel:+33744271261" class="phone">07 44 27 12 61</a>
            <a href="#horaires" class="hours">HORAIRES</a>
        </div>

    </div>
</header>

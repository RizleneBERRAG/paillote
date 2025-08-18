{{-- Menu plein écran --}}
<div id="site-menu"
     class="menu-overlay"
     role="dialog"
     aria-modal="true"
     aria-hidden="true"
     aria-labelledby="menuTitle">
    <div class="menu-panel">

        <button class="menu-close" type="button" aria-label="Fermer le menu">
            <span></span><span></span>
        </button>

        <div class="menu-grid">
            {{-- Colonne gauche : liens + CTA + coordonnées --}}
            <nav class="menu-left" aria-label="Navigation principale">
                <h2 id="menuTitle" class="sr-only">Menu principal</h2>

                <ul class="menu-list">
                    {{-- data-image = image à afficher à droite au survol/clic --}}
                    <li><a href="{{ url('/') }}"
                           data-image="{{ asset('images/menu/hero-accueil.jpg') }}">Accueil</a></li>

                    <li><a href="{{ url('/restaurant') }}"
                           data-image="{{ asset('images/menu/restaurant.jpg') }}">Le Restaurant</a></li>

                    <li><a href="{{ url('/equipe') }}"
                           data-image="{{ asset('images/menu/equipe.jpg') }}">L’équipe</a></li>

                    <li><a href="{{ url('/menus') }}"
                           data-image="{{ asset('images/menu/menus.jpg') }}">Menus</a></li>

                    <li><a href="{{ route('contact') }}"
                           data-image="{{ asset('images/menu/contact.jpg') }}">Contact</a></li>
                </ul>

                <a href="{{ route('horaires') }}" class="menu-hours">HORAIRES</a>

                <div class="menu-socials" aria-label="Réseaux sociaux">
                    <a href="#" aria-label="Facebook" class="s s-fb">
                        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Instagram" class="s s-ig">
                        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <circle cx="17.5" cy="6.5" r="1"/>
                        </svg>
                    </a>
                    <a href="https://borneoapp.com/LaPailloteFidesienneSFLL"
                       target="_blank" rel="noopener"
                       aria-label="Commander"
                       class="s s-order">
                        <img src="{{ asset('images/borneo.png') }}"
                             alt=""
                             width="20" height="20"
                             decoding="async">
                    </a>
                </div>

                <address class="menu-address">
                    <p>1 Av. de Limburg,<br>69110 Sainte-Foy-Lès-Lyon<br>France</p>
                    <p>
                        <a href="tel:+33744271261">07 44 27 12 61</a><br>
                        <a href="mailto:lapaillote110@gmail.com">lapaillote110@gmail.com</a>
                    </p>
                </address>
            </nav>

            {{-- Colonne droite : médias (image) --}}
            <aside class="menu-right" aria-hidden="true">
                <div class="media">
                    {{-- image par défaut --}}
                    <img src="{{ asset('images/hero-salle.png') }}"
                         alt=""
                         class="media-img is-active"
                         decoding="async">
                    {{-- les autres seront remplacées à la volée par JS selon data-image --}}
                </div>
            </aside>
        </div>
    </div>
</div>

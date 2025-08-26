<footer class="site-footer">

    {{-- ===== Bande dorée (si newsletter masquée) ===== --}}
    @if(!empty($hideNewsletter))
        <section class="glb-wrap" aria-hidden="false">
            <div class="glb-band">
                <span class="glb-text">{{ $goldBandText ?? 'LA PAILLOTE FIDÉSIENNE' }}</span>
            </div>
        </section>
        <br>
    @else
        {{-- ===== Newsletter (par défaut) ===== --}}
        <section class="newsletter-wrap">
            <div class="newsletter">
                <div class="news-photo">
                    <img src="{{ asset('images/newsletter.webp') }}" alt="Plat du restaurant">
                </div>

                <div class="news-content">
                    <h3 class="news-title">NEWSLETTER</h3>

                    @if(session('status'))
                        <p class="flash ok">{{ session('status') }}</p>
                    @endif
                    @if($errors->any())
                        <p class="flash ko">{{ $errors->first() }}</p>
                    @endif

                    <form class="news-form" action="{{ route('newsletter.subscribe') }}" method="POST" novalidate>
                        @csrf
                        <label class="visually-hidden" for="newsletter-email">E-mail</label>
                        <input id="newsletter-email" name="email" type="email" inputmode="email"
                               autocomplete="email" placeholder="E-MAIL" value="{{ old('email') }}" required />
                        <button class="news-submit" aria-label="Envoyer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 width="18" height="18" fill="currentColor" aria-hidden="true">
                                <path d="M13.172 12l-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                            </svg>
                        </button>
                    </form>

                    <p class="news-text">
                        LA PAILLOTE FIDÉSIENNE À SAINTE-FOY-LÈS-LYON.
                        UNE CUISINE GÉNÉREUSE, UN ACCUEIL CHALEUREUX,
                        ET UN SAVOIR-FAIRE LOCAL AU SERVICE DE VOS PAPILLES.
                    </p>
                </div>
            </div>
        </section>
        <br>
    @endif

    {{-- ===== Footer principal ===== --}}
    <section class="footer-main">
        <div class="footer-container">
            {{-- Colonne gauche --}}
            <div class="f-left">
                <img src="{{ asset('images/logo-round.png') }}" alt="La Paillote Fidésienne" class="brand-logo">
                <br>

                <address class="addr">
                    <p>1 Av. de Limburg,<br>69110 Sainte-Foy-Lès-Lyon<br>France</p>
                    <p>
                        <a href="tel:+33744271261">07 44 27 12 61</a><br>
                        <a href="mailto:lapaillote110@gmail.com">lapaillote110@gmail.com</a>
                    </p>
                </address>

                <div class="socials">
                    <a class="social" href="#" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>
                    <a class="social" href="#" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.5" y2="6.5"/>
                        </svg>
                    </a>
                    <a class="social" href="https://borneoapp.com/LaPailloteFidesienneSFLL" target="_blank" rel="noopener" aria-label="Commander sur Bornéo">
                        <img src="{{ asset('images/borneoremove.png') }}" alt="Borneo" width="22" height="22">
                    </a>
                </div>
            </div>

            {{-- Colonne droite avec accordéons --}}
            <div class="f-right">
                <details class="links-col footer-accordion">
                    <summary>Informations Légales</summary>
                    <ul>
                        <li><a href="#">Conditions générales de vente</a></li>
                        <li><a href="#">Conditions générales d’utilisation</a></li>
                        <li><a href="#">Mentions légales</a></li>
                        <li><a href="#">Politique de confidentialité des données</a></li>
                    </ul>
                </details>

                <details class="links-col footer-accordion">
                    <summary>Navigation</summary>
                    <ul>
                        <li><a href="{{ url('/restaurant') }}">Le Restaurant</a></li>
                        <li><a href="{{ route('equipe') }}">L’équipe</a></li>
                        <li><a href="{{ route('restaurant') }}">Menu</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </details>
            </div>

        </div>

        <p class="copy">© Copyright {{ now()->year }} – La Paillote Fidésienne. Tous droits réservés.</p>
        <div class="gold-bar" aria-hidden="true"></div>
    </section>

</footer>
<script>
    document.addEventListener('click', (e) => {
        if (!window.matchMedia('(max-width: 768px)').matches) return;
        const sum = e.target.closest('.footer-accordion > summary');
        if (!sum) return;
        const current = sum.parentNode;
        if (current.open) return;
        document.querySelectorAll('.footer-accordion[open]').forEach(d => {
            if (d !== current) d.removeAttribute('open');
        });
    });

    document.addEventListener("DOMContentLoaded", () => {
        const accordions = document.querySelectorAll(".footer-accordion");

        const toggleAccordions = () => {
            if (window.innerWidth >= 769) {
                accordions.forEach(d => d.setAttribute("open", "true"));
            } else {
                accordions.forEach(d => d.removeAttribute("open"));
            }
        };

        toggleAccordions(); // au chargement
        window.addEventListener("resize", toggleAccordions);
    });

</script>

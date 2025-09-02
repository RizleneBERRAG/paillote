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
                    <br>

                    {{-- eedback SCOPÉ à la newsletter uniquement --}}
                    @if (session('newsletter.success'))
                        <p class="flash ok" aria-live="polite">{{ session('newsletter.success') }}</p>
                    @endif

                    @if ($errors->newsletter?->any())
                        <p class="flash ko" aria-live="polite">{{ $errors->newsletter->first('email') }}</p>
                    @endif

                    {{-- Pas de $errors->any() générique ici, sinon mélange avec d'autres formulaires --}}

                    <form class="news-form" action="{{ route('newsletter.subscribe') }}" method="POST" novalidate>
                        @csrf
                        <label class="visually-hidden" for="newsletter-email">E-mail</label>
                        <input
                            id="newsletter-email"
                            name="email"
                            type="email"
                            inputmode="email"
                            autocomplete="email"
                            placeholder="E-MAIL"
                            value="{{ old('email') }}"
                            required />

                        <button class="news-submit" aria-label="Envoyer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 width="18" height="18" fill="currentColor" aria-hidden="true">
                                <path d="M13.172 12l-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                            </svg>
                        </button>
                    </form>
                    <br>
                    <br>
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
                    <a class="social" href="https://www.facebook.com/profile.php?id=61553619356097&locale=fr_FR" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>

                    <a class="social" href="https://www.instagram.com/la_paillote_fidesienne_?igsh=MWd1NjE3aDJ1ejY2cg==" aria-label="Instagram">
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

            {{-- Colonne droite (accordéons) --}}
            <div class="f-right">
                <details class="links-col footer-accordion">
                    <summary>Informations Légales</summary>
                    <ul>
                        <li>
                            <a href="{{ asset('docs/cgv.pdf') }}" download="LPF-CGV.pdf" rel="noopener">
                                Conditions générales de vente (PDF)
                            </a>
                        </li>
                        <li>
                            <a href="{{ asset('docs/cgu.pdf') }}" download="LPF-CGU.pdf" rel="noopener">
                                Conditions générales d’utilisation (PDF)
                            </a>
                        </li>
                        <li>
                            <a href="{{ asset('docs/mentions-legales.pdf') }}" download="LPF-Mentions-Legales.pdf" rel="noopener">
                                Mentions légales (PDF)
                            </a>
                        </li>
                        <li>
                            <a href="{{ asset('docs/politique-confidentialite.pdf') }}" download="LPF-Politique-Confidentialite.pdf" rel="noopener">
                                Politique de confidentialité (PDF)
                            </a>
                        </li>
                    </ul>
                </details>

                <details class="links-col footer-accordion">
                    <summary>Navigation</summary>
                    <ul>
                        <li><a href="{{ url('/restaurant') }}">Le Restaurant</a></li>
                        <li><a href="{{ route('equipe') }}">L’équipe</a></li>
                        <li><a href="{{ route('menu') }}">Menus / Carte</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </details>
            </div>

        </div>

        <p class="copy">© Copyright {{ now()->year }} – La Paillote Fidésienne. Tous droits réservés.</p>
        <div class="gold-bar" aria-hidden="true"></div>
    </section>

</footer>

{{-- ===== Accordéons (mobile only) ===== --}}
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

    document.addEventListener('DOMContentLoaded', () => {
        const accordions = document.querySelectorAll('.footer-accordion');
        const toggleAccordions = () => {
            if (window.innerWidth >= 769) {
                accordions.forEach(d => d.setAttribute('open', 'true'));
            } else {
                accordions.forEach(d => d.removeAttribute('open'));
            }
        };
        toggleAccordions();
        window.addEventListener('resize', toggleAccordions);
    });
</script>

{{-- ===== EmailJS : notif admin “nouvel abonné” (non bloquant) ===== --}}
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
<script>
    (function(){
        // 🔒 Idéalement place cette clé publique dans .env et injecte-la via Blade
        const PUBLIC_KEY = '{{ env('EMAILJS_PUBLIC_KEY', '0inxyCI23tIIDpDhL') }}';
        try { emailjs.init(PUBLIC_KEY); } catch(e){}
    })();

    document.addEventListener('DOMContentLoaded', function(){
        const form = document.querySelector('.news-form');
        if (!form) return;

        form.addEventListener('submit', function(){
            if (!window.emailjs) return; // ne bloque jamais Laravel

            const email = (form.querySelector('input[name="email"]')?.value || '').trim();
            if (!email) return;

            // 🔒 Idem : externalise en .env si possible
            const SERVICE_ID  = '{{ env('EMAILJS_SERVICE_ID', 'service_j8gsazd') }}';
            const TEMPLATE_ID = '{{ env('EMAILJS_TEMPLATE_ID', 'template_newsletter_admin') }}';

            const params = {
                subscriber_email: email,
                site_name: 'La Paillote Fidésienne',
                subscribed_at: new Date().toISOString(),
                page_url: window.location.href
            };

            // “fire & forget” : on n’empêche pas la soumission Laravel
            emailjs.send(SERVICE_ID, TEMPLATE_ID, params).catch(()=>{});
        });
    });
</script>

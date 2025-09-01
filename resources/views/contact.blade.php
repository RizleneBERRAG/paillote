<!doctype html>
<html lang="fr">
<head>
    <!-- Favicon classique -->
    <link rel="icon" type="images/png" sizes="32x32" href="{{ asset('images/favicon.ico.png') }}">

    <!-- Optionnel : pour compatibilité max -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.ico.png') }}">


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact — La Paillote Fidésienne</title>

    {{-- Styles globaux --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    {{-- Styles de la page contact (inclut le rideau) --}}
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body>

{{-- ====== RIDEAU D’INTRO ====== --}}
<div class="contact-curtain" aria-hidden="false">
    <div class="curtain-panel left"></div>
    <div class="curtain-panel right"></div>
    <div class="curtain-center">
        <h1 class="curtain-title">Nous Contacter</h1>
        <button id="revealContact" class="curtain-cta">Entrer</button>
        <a href="#contact-page" class="curtain-fallback">Accéder au contenu</a>
    </div>
</div>

{{-- ====== CONTENU DE LA PAGE (caché avant ouverture du rideau) ====== --}}
<div id="contact-page" style="display:none;">

    {{-- HEADER + MENU OVERLAY --}}
    @include('layouts.header')
    @include('layouts.menu')

    <main class="contact-main">

        {{-- HERO avec l’image demandée --}}
        <section class="contact-hero" aria-label="Nous contacter">
            <img class="contact-hero-bg" src="{{ asset('images/contact/salade.jpg') }}" alt="">
        </section>

        {{-- FLASH messages --}}
        <section class="contact-wrap">
            @if (session('status'))
                <p class="flash flash-ok">{{ session('status') }}</p>
            @endif
            @if ($errors->any())
                <p class="flash flash-ko">{{ $errors->first() }}</p>
            @endif
        </section>

        {{-- FORMULAIRE + INFOS / CARTE --}}
        <section class="contact-wrap">
            <div class="contact-grid">

                {{-- ===== FORMULAIRE ===== --}}
                <div class="contact-card">
                    <h2 class="contact-h2">Écrivez-nous</h2>
                    <br>

                    {{-- Zone feedback (succès/erreur EmailJS) --}}
                    <div id="result" aria-live="polite"></div>

                    {{-- Overlay de chargement (spinner) --}}
                    <div id="loadingOverlay" class="loading-overlay" style="display:none;">
                        <div class="spinner"></div>
                    </div>

                    <form id="contact-form" class="contact-form" action="{{ route('contact.send') }}" method="POST" novalidate>
                        @csrf

                        <div class="form-row">
                            <div class="form-field">
                                <label for="c_name">Nom*</label>
                                <input id="c_name" name="name" type="text" autocomplete="name" required value="{{ old('name') }}">
                            </div>
                            <div class="form-field">
                                <label for="c_email">E-mail*</label>
                                <input id="c_email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="c_phone">Téléphone (optionnel)</label>
                                <input id="c_phone" name="phone" type="tel" inputmode="tel" autocomplete="tel" value="{{ old('phone') }}">
                            </div>
                            <div class="form-field">
                                <label for="c_subject">Sujet*</label>
                                <select id="c_subject" name="subject" required>
                                    <option value="" disabled selected>Choisir un sujet*</option>
                                    <option value="reservation" @selected(old('subject')==='reservation')>Réservation</option>
                                    <option value="devis" @selected(old('subject')==='devis')>Devis / groupe</option>
                                    <option value="evenement" @selected(old('subject')==='evenement')>Événement</option>
                                    <option value="autre" @selected(old('subject')==='autre')>Autre</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-field">
                            <label for="c_message">Message*</label>
                            <textarea id="c_message" name="message" rows="5" required placeholder="Dites-nous tout…">{{ old('message') }}</textarea>
                        </div>
                        <br>
                        <label class="check">
                            <input type="checkbox" id="consent" name="consent" required>
                            <span>J’accepte que mes données soient utilisées pour traiter ma demande.*</span>
                        </label>

                        {{-- Honeypot anti-spam --}}
                        <input type="text" name="website" tabindex="-1" autocomplete="off" class="hp" aria-hidden="true">
                        <br>

                        <button class="btn-solid-gold" id="contact-submit" type="submit">Envoyer</button>
                    </form>
                </div>

                {{-- ===== INFOS + ACTIONS + CARTE ===== --}}
                <aside class="contact-side">
                    <div class="info-card">
                        <h2 class="contact-h2">Nos coordonnées</h2>

                        <ul class="contact-infos">
                            <li>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M21 10c0 7-9 12-9 12S3 17 3 10a9 9 0 1 1 18 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                1 Av. de Limburg, 69110 Sainte-Foy-Lès-Lyon
                            </li>
                            <li>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 16.92V21a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4 3h4.09a2 2 0 0 1 2 1.72l.57 3.24a2 2 0 0 1-.5 1.73l-1.27 1.27a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 1.73-.5l3.24.57A2 2 0 0 1 22 16.92Z"/></svg>
                                <a href="tel:+33744271261">07 44 27 12 61</a>
                            </li>
                            <li>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 4h16v16H4z"/><path d="m22 6-10 7L2 6"/></svg>
                                <a href="mailto:lapaillote110@gmail.com">lapaillote110@gmail.com</a>
                            </li>
                        </ul>

                        <div class="contact-actions">
                            <a class="btn-outline-gold" href="https://borneoapp.com/LaPailloteFidesienneSFLL" target="_blank" rel="noopener">Commander</a>
                            <a class="btn-outline" href="https://maps.google.com/?q=1+Av.+de+Limburg,+69110+Sainte-Foy-L%C3%A8s-Lyon" target="_blank" rel="noopener">Google Maps</a>
                        </div>
                    </div>

                    <div class="map-card" aria-label="Localisation">
                        <iframe
                            title="Carte — La Paillote Fidésienne"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps?q=1%20Av.%20de%20Limburg,%2069110%20Sainte-Foy-L%C3%A8s-Lyon&output=embed">
                        </iframe>
                    </div>
                </aside>

            </div>
        </section>
    </main>

    {{-- FOOTER --}}
    @include('layouts.footer')
</div>

{{-- ===== SCRIPTS ===== --}}
<script src="{{ asset('js/menu.js') }}" defer></script>

{{-- SDK EmailJS (doit être chargé AVANT ton script de page) --}}
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

{{-- Ton script : rideau + envoi EmailJS (utilise les IDs ci-dessus) --}}
<script src="{{ asset('js/contact-intro.js') }}"></script>

{{-- Auto-resize du textarea (confort) --}}
<script>
    document.addEventListener('input', (e) => {
        const ta = e.target.matches('#c_message') ? e.target : null;
        if (!ta) return;
        ta.style.height = 'auto';
        ta.style.height = ta.scrollHeight + 'px';
    }, { passive: true });
</script>

</body>
</html>

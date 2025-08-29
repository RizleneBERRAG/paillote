<?php

namespace App\Http\Controllers;

// On importe les classes dont on a besoin.
// - Request : représente la requête HTTP (données du formulaire, headers, etc.)
// - Validator : permet de valider nous-mêmes un tableau de données avec des règles
// - ContactMessage : le modèle Eloquent relié à la table qui stocke les messages
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactMessage;

/**
 * Contrôleur responsable du formulaire de contact.
 * Son rôle :
 * 1) Récupérer les champs envoyés par l’utilisateur (POST)
 * 2) Les valider (formats, longueurs, champs obligatoires)
 * 3) Enregistrer le message en base de données
 * 4) Renvoyer l’utilisateur sur la page précédente avec un message de succès
 */
class ContactController extends Controller
{
    /**
     * Méthode appelée quand le formulaire est soumis (route POST).
     *
     * @param  \Illuminate\Http\Request  $request  La requête courante (données, IP, user-agent…)
     * @return \Illuminate\Http\RedirectResponse   Une redirection (retour sur la même page)
     */
    public function send(Request $request)
    {
        // ===============================
        // 1) NORMALISATION DES DONNÉES
        // ===============================
        // Le front peut envoyer les champs avec différents noms (ex. "nom" au lieu de "name").
        // On centralise tout dans $payload avec nos clés "officielles".
        // - input('champ', 'fallback') lit "champ" et, si absent, prend "fallback".
        // - boolean('consent') convertit automatiquement en true/false (case à cocher).
        $payload = [
            'name'    => $request->input('name',    $request->input('nom')),
            'email'   => $request->input('email',   $request->input('mail')),
            'phone'   => $request->input('phone',   $request->input('telephone')),
            'subject' => $request->input('subject', $request->input('sujet')),
            'message' => $request->input('message'),
            'consent' => $request->boolean('consent'),
        ];

        // ===============================
        // 2) VALIDATION
        // ===============================
        // On définit des règles : "required" = obligatoire, "email" = format email, etc.
        // On fournit aussi des messages d’erreur personnalisés (en français)
        // et des "noms lisibles" pour les champs (pour de jolies erreurs).
        $validator = Validator::make(
            $payload,
            [
                'name'    => ['required', 'string', 'max:120'],
                'email'   => ['required', 'email',  'max:190'],
                'phone'   => ['nullable', 'string', 'max:40'],
                'subject' => ['nullable', 'string', 'max:190'],
                'message' => ['required', 'string', 'min:5'],
                'consent' => ['accepted'], // la case “j’accepte” doit être cochée
            ],
            [
                // Messages d’erreur génériques
                'required' => 'Ce champ est obligatoire.',
                'email'    => 'Veuillez saisir un e-mail valide.',
                'accepted' => 'Veuillez accepter le traitement de vos données.',
                'min'      => 'Le message doit contenir au moins :min caractères.',
            ],
            [
                // Libellés plus jolis pour les messages d’erreur
                'name'    => 'nom',
                'email'   => 'e-mail',
                'phone'   => 'téléphone',
                'subject' => 'sujet',
                'message' => 'message',
                'consent' => 'consentement',
            ]
        );

        // Si la validation échoue :
        // - back() : on renvoie l’utilisateur sur la page d’où il vient
        // - withErrors($validator) : on met les erreurs en session (Blade peut les afficher)
        // - withInput() : on remet automatiquement les anciennes valeurs dans le formulaire (old('...'))
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // ===============================
        // 3) ENREGISTREMENT EN BASE
        // ===============================
        // On crée une ligne en base avec Eloquent :
        // - la propriété $fillable contient ces champs (name, email, phone, subject, message, consent, ip, user_agent, status)
        // Ici on ajoute aussi des métadonnées :
        // - ip()         : IP du client
        // - userAgent()  : chaîne agent (navigateur)
        // - status       : “new” par défaut
        ContactMessage::create([
            'name'       => $payload['name'],
            'email'      => $payload['email'],
            'phone'      => $payload['phone'],
            'subject'    => $payload['subject'],
            'message'    => $payload['message'],
            'consent'    => $payload['consent'],
            'ip'         => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status'     => 'new',
        ]);

        // ===============================
        // 4) FEEDBACK UTILISATEUR
        // ===============================
        // with('status', ...) place un message flash en session.
        // Dans la vue, je l’affiches avec :  @if(session('status')) ... @endif
        // back() renvoie l’utilisateur sur la page du formulaire.
        return back()->with('status', 'Merci, votre message a bien été envoyé !');
    }
}

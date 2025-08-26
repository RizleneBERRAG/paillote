<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactMessage;

/**
 * Contrôleur responsable du formulaire de contact.
 * - Valide les données envoyées par l'utilisateur
 * - Enregistre le message en base
 * - Retourne l'utilisateur sur la page précédente avec un feedback
 */
class ContactController extends Controller
{
    /**
     * Traite l'envoi du formulaire de contact.
     *
     * @param  \Illuminate\Http\Request  $request  Requête HTTP contenant les champs du formulaire
     * @return \Illuminate\Http\RedirectResponse   Redirection vers la page précédente avec erreurs ou succès
     */
    public function send(Request $request)
    {
        // 🔹 Normalisation du payload
        // On accepte des alias de champs (ex: "nom" au lieu de "name") pour rester tolérant
        // aux variations possibles du front. On fournit aussi des valeurs par défaut nulles.
        $payload = [
            'name'    => $request->input('name',    $request->input('nom')),
            'email'   => $request->input('email',   $request->input('mail')),
            'phone'   => $request->input('phone',   $request->input('telephone')),
            'subject' => $request->input('subject', $request->input('sujet')),
            'message' => $request->input('message'),
            'consent' => $request->boolean('consent'), // convertit en booléen (true/false)
        ];

        // 🔹 Validation des données
        // - Règles strictes mais raisonnables (longueurs max, message min 5 chars, email valide, consentement requis)
        // - Messages d'erreurs personnalisés et humanisés (en français)
        // - "Attribute names" mappés pour afficher de jolis libellés dans les erreurs
        $validator = Validator::make($payload, [
            'name'    => ['required', 'string', 'max:120'],
            'email'   => ['required', 'email',  'max:190'],
            'phone'   => ['nullable', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:190'],
            'message' => ['required', 'string', 'min:5'],
            'consent' => ['accepted'], // doit être coché
        ], [
            // Messages communs
            'required' => 'Ce champ est obligatoire.',
            'email'    => 'Veuillez saisir un e-mail valide.',
            'accepted' => 'Veuillez accepter le traitement de vos données.',
            'min'      => 'Le message doit contenir au moins :min caractères.',
        ], [
            // Libellés "propres" affichés dans les erreurs
            'name'    => 'nom',
            'email'   => 'e-mail',
            'phone'   => 'téléphone',
            'subject' => 'sujet',
            'message' => 'message',
            'consent' => 'consentement',
        ]);

        // 🔹 Si la validation échoue : redirection vers la page précédente
        // avec les erreurs et les anciennes valeurs de formulaire (old input)
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // 🔹 Création en base du message de contact
        // On stocke aussi quelques métadonnées utiles (IP, user-agent, statut initial)
        ContactMessage::create([
            'name'       => $payload['name'],
            'email'      => $payload['email'],
            'phone'      => $payload['phone'],
            'subject'    => $payload['subject'],
            'message'    => $payload['message'],
            'consent'    => $payload['consent'],
            'ip'         => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status'     => 'new', // statut initial (peut évoluer: "read", "archived", etc.)
        ]);

        // 🔹 Feedback utilisateur : message flash de succès puis redirection back
        return back()->with('status', 'Merci, votre message a bien été envoyé !');
    }
}

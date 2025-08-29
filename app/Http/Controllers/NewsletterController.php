<?php

namespace App\Http\Controllers;

// J’importe les classes dont j’ai besoin :
// - Request : pour récupérer et valider les données du formulaire
// - DB : pour exécuter des requêtes directes sur la base de données
// - Rule : pour appliquer des règles de validation avancées (ici l’unicité de l’email)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        // ===============================
        // 1) Validation des données reçues
        // ===============================
        // Je vérifie que l’email est :
        // - requis (obligatoire)
        // - valide au format RFC/DNS
        // - unique dans la table newsletter_subscribers (colonne "email")
        //
        // Si une règle échoue → Laravel redirige automatiquement vers la page précédente
        // avec les messages d’erreurs correspondants.
        $data = $request->validate([
            'email' => [
                'required',
                'email:rfc,dns',
                Rule::unique('newsletter_subscribers', 'email'),
            ],
        ], [
            // Messages personnalisés affichés à l’utilisateur
            'email.required' => 'Veuillez saisir votre e-mail.',
            'email.email'    => 'Adresse e-mail invalide.',
            'email.unique'   => 'Cet e-mail est déjà abonné.',
        ]);

        // ===============================
        // 2) Normalisation de l’email
        // ===============================
        // Je mets l’email en minuscule et je retire les espaces éventuels
        // → ça évite d’avoir deux entrées identiques avec juste des majuscules ou espaces.
        $email = strtolower(trim($data['email']));

        // ===============================
        // 3) Insertion dans la base
        // ===============================
        // J’insère une nouvelle ligne dans la table "newsletter_subscribers".
        // Je stocke :
        // - l’email normalisé
        // - le statut "active" (l’utilisateur est bien abonné)
        // - la date d’inscription
        DB::table('newsletter_subscribers')->insert([
            'email'      => $email,
            'status'     => 'active',
            'created_at' => now(),
        ]);

        // ===============================
        // 4) Feedback utilisateur
        // ===============================
        // Après succès, je redirige l’utilisateur sur la même page (back())
        // et j’ajoute un message flash dans la session → "Merci ! Votre inscription est prise en compte."
        return back()->with('status', 'Merci ! Votre inscription à la newsletter est prise en compte.');
    }
}

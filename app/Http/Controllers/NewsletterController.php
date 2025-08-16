<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => [
                'required',
                'email:rfc,dns',
                Rule::unique('newsletter_subscribers', 'email'),
            ],
        ], [
            'email.required' => 'Veuillez saisir votre e-mail.',
            'email.email'    => 'Adresse e-mail invalide.',
            'email.unique'   => 'Cet e-mail est déjà abonné.',
        ]);

        DB::table('newsletter_subscribers')->insert([
            'email'      => $data['email'],
            'status'     => 'active',
            'created_at' => now(),
        ]);

        return back()->with('status', 'Merci ! Votre inscription à la
newsletter est prise en compte.');
    }
}

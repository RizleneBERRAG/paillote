<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        // 1) Validation basique
        $validator = \Validator::make($request->all(), [
            'email' => ['required','email','max:190'],
        ], [
            'required' => 'Veuillez entrer votre e-mail.',
            'email'    => 'Format e-mail invalide.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator, 'newsletter')->withInput();
        }

        // 2) Normalisation e-mail
        $email = mb_strtolower(trim($request->input('email')));

        // 3) Doublon ?
        $exists = DB::table('newsletter_subscribers')->where('email', $email)->exists();
        if ($exists) {
            return back()
                ->withErrors(['email' => 'Cet e-mail est déjà inscrit à la newsletter.'], 'newsletter')
                ->withInput();
        }

        // 4) Insertion (timestamps standard Laravel)
        DB::table('newsletter_subscribers')->insert([
            'email'      => $email,
            'status'     => 'active',
            'created_at' => now(),
        ]);

        // 5) Message flash SCOPÉ newsletter
        return back()->with('newsletter.success', 'Merci ! Votre inscription à la newsletter est prise en compte.');
    }
}

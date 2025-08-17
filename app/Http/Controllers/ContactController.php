<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $payload = [
            'name' => $request->input('name', $request->input('nom')),
            'email' => $request->input('email', $request->input('mail')),
            'phone' => $request->input('phone', $request->input('telephone')),
            'subject' => $request->input('subject', $request->input('sujet')),
            'message' => $request->input('message'),
            'consent' => $request->boolean('consent'),
        ];

        $validator = Validator::make($payload, [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:190'],
            'message' => ['required', 'string', 'min:5'],
            'consent' => ['accepted'],
        ], [
            'required' => 'Ce champ est obligatoire.',
            'email' => 'Veuillez saisir un e-mail valide.',
            'accepted' => 'Veuillez accepter le traitement de vos données.',
            'min' => 'Le message doit contenir au moins :min caractères.',
        ], [
            'name' => 'nom',
            'email' => 'e-mail',
            'phone' => 'téléphone',
            'subject' => 'sujet',
            'message' => 'message',
            'consent' => 'consentement',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        ContactMessage::create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'phone' => $payload['phone'],
            'subject' => $payload['subject'],
            'message' => $payload['message'],
            'consent' => $payload['consent'],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'new',
        ]);

        return back()->with('status', 'Merci, votre message a bien été envoyé !');
    }
}


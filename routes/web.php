<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Response;


Route::view('/', 'home')->name('home');
Route::view('/horaires', 'horaires')->name('horaires');
Route::view('/contact', 'contact')->name('contact');
Route::view('/equipe', 'equipe')->name('equipe');
Route::view('/restaurant', 'restaurant')->name('restaurant');

Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/docs/{slug}', function (string $slug) {
    // Slugs autorisés → fichiers réels
    $map = [
        'cgv'   => 'docs/cgv.pdf',
        'cgu'   => 'docs/cgu.pdf',
        'ml'    => 'docs/mentions-legales.pdf',
        'privacy' => 'docs/politique-confidentialite.pdf',
    ];

    abort_unless(isset($map[$slug]), 404);

    $path = public_path($map[$slug]);

    // Option 1 : forcer le download
    return response()->download($path, 'LPF-'.strtoupper($slug).'.pdf', [
        'Cache-Control' => 'public, max-age=604800', // 7 jours
        'Content-Type'  => 'application/pdf',
    ]);

    // Option 2 : afficher dans le navigateur (stream)
    // return response()->file($path, ['Cache-Control' => 'public, max-age=604800']);
});

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'send'])
    ->name('contact.send');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');

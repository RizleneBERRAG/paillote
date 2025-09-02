<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Response;


// Pages
Route::view('/', 'home')->name('home');
Route::view('/horaires', 'horaires')->name('horaires');
Route::view('/contact', 'contact')->name('contact');
Route::view('/equipe', 'equipe')->name('equipe');
Route::view('/restaurant', 'restaurant')->name('restaurant');

// Actions
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// Docs
Route::get('/docs/{slug}', function (string $slug) {
    $map = [
        'cgv'     => 'docs/cgv.pdf',
        'cgu'     => 'docs/cgu.pdf',
        'ml'      => 'docs/mentions-legales.pdf',
        'privacy' => 'docs/politique-confidentialite.pdf',
    ];
    abort_unless(isset($map[$slug]), 404);
    $path = public_path($map[$slug]);
    return response()->download($path, 'LPF-'.strtoupper($slug).'.pdf', [
        'Cache-Control' => 'public, max-age=604800',
        'Content-Type'  => 'application/pdf',
    ]);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;


Route::get('/', function () {
    return view('home');
});

Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

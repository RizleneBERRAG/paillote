<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuController;


Route::view('/', 'home')->name('home');
Route::view('/horaires', 'horaires')->name('horaires');
Route::view('/contact', 'contact')->name('contact');
Route::view('/equipe', 'equipe')->name('equipe');
Route::view('/restaurant', 'restaurant')->name('restaurant');

Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/services', 'pages.services')->name('services');
Route::view('/portfolio', 'pages.portfolio')->name('portfolio');
Route::view('/graphics', 'pages.graphics')->name('graphics');
Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact', ContactController::class)->name('contact.submit');

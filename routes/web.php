<?php

/*
 *
 *   Created by Techibytes Media Development Team
 *   Copyright Ⓒ 2026. All rights reserved, https://techibytesmedia.com/
 *   Project: techibytesmedia
 *   Last modified: 7/13/26, 8:06 PM
 *   Modified or Created by: erigb
 *
 *   Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file
 *   except in compliance with the License. You may obtain a copy of the License at
 *   https://www.apache.org/licenses/LICENSE-2.0. Unless required by applicable law or agreed to in writing, software
 *    distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
 *    either express or implied. See the License for the specific language governing permissions and
 *    limitations under the License.
 * /
 */

declare(strict_types = 1);

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Middleware\ProtectContactForm;

Route::view('/', 'pages.home')->name('home');
Route::view('/services', 'pages.services')->name('services');
Route::view('/portfolio', 'pages.portfolio')->name('portfolio');
Route::view('/graphics', 'pages.graphics')->name('graphics');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware(['throttle:contact-form', ProtectContactForm::class])
    ->name('contact.submit');

Route::get('/sitemap.xml', function (): Response {
    $site_url = mb_rtrim((string) config('app.url'), '/');
    $urls = collect(['home', 'services', 'portfolio', 'graphics', 'contact'])
        ->map(function (string $routeName) use ($site_url): string {
            $uri = Route::getRoutes()->getByName($routeName)->uri();

            return $site_url . ('/' === $uri ? '/' : '/' . $uri);
        });

    return response()
        ->view('sitemap', ['urls' => $urls])
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

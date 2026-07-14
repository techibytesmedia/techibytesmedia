<?php

/*
 *
 *   Created by Techibytes Media Development Team
 *   Copyright Ⓒ 2026. All rights reserved, https://techibytesmedia.com/
 *   Project: techibytesmedia
 *   Last modified: 7/13/26, 8:12 PM
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

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Support\ContactFormSpamLogger;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(ContactFormSpamLogger $spam_logger): void
    {
        RateLimiter::for('contact-form', function (Request $request) use ($spam_logger): Limit {
            return Limit::perMinutes(10, 5)
                ->by($request->ip() ?? 'unknown')
                ->response(function (Request $request, array $headers) use ($spam_logger): RedirectResponse {
                    $spam_logger->log($request, 'rate_limit_exceeded');

                    return redirect()
                        ->route('contact')
                        ->with('error', 'Too many messages were submitted from your connection. Please wait 10 minutes and try again.')
                        ->withHeaders($headers);
                });
        });
    }
}

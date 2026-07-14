<?php

/*
 *
 *   Created by Techibytes Media Development Team
 *   Copyright Ⓒ 2026. All rights reserved, https://techibytesmedia.com/
 *   Project: techibytesmedia
 *   Last modified: 7/13/26, 8:15 PM
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

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Support\ContactFormSpamLogger;
use App\Http\Controllers\ContactController;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Encryption\DecryptException;

class ProtectContactForm
{
    private const int MINIMUM_COMPLETION_SECONDS = 3;

    private const int MAXIMUM_FORM_AGE_SECONDS = 7200;

    public function __construct(private readonly ContactFormSpamLogger $spamLogger) {}

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $reason = $this->suspicionReason($request);

        if (null !== $reason) {
            $this->spamLogger->log($request, $reason);

            return redirect()
                ->route('contact')
                ->with('status', ContactController::SUCCESS_MESSAGE);
        }

        return $next($request);
    }

    private function suspicionReason(Request $request): ?string
    {
        if ($request->filled('company_website')) {
            return 'honeypot_filled';
        }

        $encrypted_timestamp = $request->string('_contact_form')->toString();

        if ('' === $encrypted_timestamp) {
            return 'missing_form_token';
        }

        try {
            $timestamp = Crypt::decryptString($encrypted_timestamp);
        } catch (DecryptException) {
            return 'invalid_form_token';
        }

        if ( ! Str::of($timestamp)->isMatch('/^\d+$/')) {
            return 'invalid_form_token';
        }

        $form_age_seconds = now()->timestamp - (int) $timestamp;

        if ($form_age_seconds < 0 || $form_age_seconds > self::MAXIMUM_FORM_AGE_SECONDS) {
            return 'invalid_form_age';
        }

        if ($form_age_seconds < self::MINIMUM_COMPLETION_SECONDS) {
            return 'submitted_too_quickly';
        }

        return null;
    }
}

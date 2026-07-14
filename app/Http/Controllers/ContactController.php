<?php

/*
 *
 *   Created by Techibytes Media Development Team
 *   Copyright Ⓒ 2026. All rights reserved, https://techibytesmedia.com/
 *   Project: techibytesmedia
 *   Last modified: 7/13/26, 8:10 PM
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

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;

class ContactController extends Controller
{
    public const string SUCCESS_MESSAGE = 'Thanks — we got your message and will reply within one business day.';

    public function show(): View
    {
        return view('pages.contact', [
            'contactFormToken' => Crypt::encryptString((string) now()->timestamp),
        ]);
    }

    /**
     * Handle a contact form submission.
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        $validated = $request->safe()->except('cf-turnstile-response');

        Log::channel('single')->info('Contact inquiry received', $validated);

        return redirect()
            ->route('contact')
            ->with('status', self::SUCCESS_MESSAGE);
    }
}

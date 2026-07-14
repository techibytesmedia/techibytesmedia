<?php

/*
 *
 *   Created by Techibytes Media Development Team
 *   Copyright Ⓒ 2026. All rights reserved, https://techibytesmedia.com/
 *   Project: techibytesmedia
 *   Last modified: 7/13/26, 8:13 PM
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

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\ContactController;

beforeEach(function (): void {
    config()->set([
        'services.turnstile.site_key' => 'test-site-key',
        'services.turnstile.secret_key' => 'test-secret-key',
        'services.turnstile.action' => 'contact',
        'services.turnstile.verify_url' => 'https://challenges.cloudflare.com/turnstile/v0/siteverify',
    ]);

    Http::preventStrayRequests();
});

test('the contact form displays the responsive Turnstile widget', function (): void {
    $this->get(route('contact'))
        ->assertSuccessful()
        ->assertSee('https://challenges.cloudflare.com/turnstile/v0/api.js', false)
        ->assertSee('data-sitekey="test-site-key"', false)
        ->assertSee('data-action="contact"', false)
        ->assertSee('data-size="flexible"', false)
        ->assertSee('name="company_website"', false)
        ->assertSee('tabindex="-1"', false)
        ->assertSee('name="_contact_form"', false);
});

test('a valid contact submission redirects back with a status message', function (): void {
    fake_successful_turnstile();

    $this->post(route('contact.submit'), contact_form_payload())
        ->assertRedirect(route('contact'))
        ->assertSessionHas('status', ContactController::SUCCESS_MESSAGE);

    Http::assertSent(fn (Request $request): bool => 'https://challenges.cloudflare.com/turnstile/v0/siteverify' === $request->url()
        && 'test-secret-key' === $request['secret']
        && 'valid-token' === $request['response']);
});

test('a contact submission requires the mandatory fields', function (array $payload, string $invalidField): void {
    fake_successful_turnstile();

    $this->from(route('contact'))
        ->post(route('contact.submit'), [
            ...$payload,
            'cf-turnstile-response' => 'valid-token',
            '_contact_form' => valid_contact_form_token(),
        ])
        ->assertRedirect(route('contact'))
        ->assertSessionHasErrors($invalidField);
})->with([
    'missing name' => [['email' => 'ada@example.com', 'message' => 'Hello'], 'name'],
    'missing email' => [['name' => 'Ada', 'message' => 'Hello'], 'email'],
    'invalid email' => [['name' => 'Ada', 'email' => 'not-an-email', 'message' => 'Hello'], 'email'],
    'missing message' => [['name' => 'Ada', 'email' => 'ada@example.com'], 'message'],
]);

test('a contact submission requires a Turnstile token', function (): void {
    $payload = contact_form_payload();
    unset($payload['cf-turnstile-response']);

    $this->from(route('contact'))
        ->post(route('contact.submit'), $payload)
        ->assertRedirect(route('contact'))
        ->assertSessionHasErrors('cf-turnstile-response');

    Http::assertNothingSent();
});

test('a contact submission rejects an invalid Turnstile token', function (): void {
    Http::fake([
        'challenges.cloudflare.com/turnstile/v0/siteverify' => Http::response([
            'success' => false,
            'error-codes' => ['invalid-input-response'],
        ]),
    ]);

    $this->from(route('contact'))
        ->post(route('contact.submit'), contact_form_payload([
            'cf-turnstile-response' => 'invalid-token',
        ]))
        ->assertRedirect(route('contact'))
        ->assertSessionHasErrors('cf-turnstile-response')
        ->assertSessionMissing('status');
});

test('a contact submission fails safely when Turnstile is unavailable', function (): void {
    Http::fake([
        'challenges.cloudflare.com/turnstile/v0/siteverify' => Http::failedConnection(),
    ]);

    $this->from(route('contact'))
        ->post(route('contact.submit'), contact_form_payload([
            'cf-turnstile-response' => 'unverified-token',
        ]))
        ->assertRedirect(route('contact'))
        ->assertSessionHasErrors('cf-turnstile-response')
        ->assertSessionMissing('status');
});

test('a honeypot submission is discarded and logged without contact details', function (): void {
    Log::spy();

    $this->post(route('contact.submit'), contact_form_payload([
        'company_website' => 'https://spam.example',
    ]))
        ->assertRedirect(route('contact'))
        ->assertSessionHas('status', ContactController::SUCCESS_MESSAGE)
        ->assertSessionMissing('errors');

    Http::assertNothingSent();

    Log::shouldHaveReceived('warning')
        ->once()
        ->withArgs(fn (string $message, array $context): bool => 'Suspicious contact form submission blocked' === $message
                && 'honeypot_filled' === $context['reason']
                && [] === array_intersect(['name', 'email', 'message', 'company_website'], array_keys($context)));
});

test('a form submitted too quickly is discarded before Turnstile verification', function (): void {
    $this->post(route('contact.submit'), contact_form_payload([
        '_contact_form' => Crypt::encryptString((string) now()->timestamp),
    ]))
        ->assertRedirect(route('contact'))
        ->assertSessionHas('status', ContactController::SUCCESS_MESSAGE)
        ->assertSessionMissing('errors');

    Http::assertNothingSent();
});

test('a tampered form timing token is discarded before Turnstile verification', function (): void {
    $this->post(route('contact.submit'), contact_form_payload([
        '_contact_form' => 'tampered-token',
    ]))
        ->assertRedirect(route('contact'))
        ->assertSessionHas('status', ContactController::SUCCESS_MESSAGE)
        ->assertSessionMissing('errors');

    Http::assertNothingSent();
});

test('contact submissions are limited to five attempts every ten minutes per IP address', function (): void {
    fake_successful_turnstile();

    foreach (range(1, 5) as $attempt) {
        $this->post(route('contact.submit'), contact_form_payload([
            'cf-turnstile-response' => "valid-token-{$attempt}",
        ]))->assertSessionHas('status', ContactController::SUCCESS_MESSAGE);
    }

    $this->post(route('contact.submit'), contact_form_payload([
        'cf-turnstile-response' => 'rate-limited-token',
    ]))
        ->assertRedirect(route('contact'))
        ->assertSessionHas('error', 'Too many messages were submitted from your connection. Please wait 10 minutes and try again.')
        ->assertHeader('Retry-After');

    Http::assertSentCount(5);
});

/**
 * @param  array<string, string>  $overrides
 * @return array<string, string>
 */
function contact_form_payload(array $overrides = []): array
{
    return array_replace([
        'name' => 'Ada Obi',
        'email' => 'ada@example.com',
        'service' => 'Web Development',
        'budget' => '$1,000 – $5,000',
        'message' => 'We need a new e-commerce website for our retail brand.',
        'cf-turnstile-response' => 'valid-token',
        '_contact_form' => valid_contact_form_token(),
    ], $overrides);
}

function valid_contact_form_token(): string
{
    return Crypt::encryptString((string) now()->subSeconds(5)->timestamp);
}

function fake_successful_turnstile(): void
{
    Http::fake([
        'challenges.cloudflare.com/turnstile/v0/siteverify' => Http::response([
            'success' => true,
            'hostname' => parse_url((string) config('app.url'), PHP_URL_HOST),
            'action' => 'contact',
        ]),
    ]);
}

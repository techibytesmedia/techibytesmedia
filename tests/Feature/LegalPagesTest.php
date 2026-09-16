<?php

/*
 *
 *   Created by Techibytes Media Development Team
 *   Copyright Ⓒ 2026. All rights reserved, https://techibytesmedia.com/
 *   Project: techibytesmedia
 *   Last modified: 8/12/26, 2:17 PM
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

test('legal pages render with the shared legal layout', function (string $route_name, string $heading): void {
    $this->get(route($route_name))
        ->assertSuccessful()
        ->assertSee($heading)
        ->assertSee('data-testid="legal-content"', false)
        ->assertSee('Effective date: July 30, 2026');
})->with([
    'terms' => ['terms', 'Terms and Conditions'],
    'privacy' => ['privacy', 'Privacy Policy'],
    'payment disclosure' => ['payment-services-disclosure', 'Payment Services Disclosure'],
]);

test('terms plainly describe Techibytes and its payment providers', function (): void {
    $this->get(route('terms'))
        ->assertSuccessful()
        ->assertSee('full-service software development and digital marketing agency')
        ->assertSee('design, engineer and grow')
        ->assertSee('not a bank')
        ->assertSee('Flutterwave')
        ->assertSee('Stripe')
        ->assertSee('does not take custody of, hold, control or redistribute customer funds')
        ->assertSee('does not represent money deposited with Techibytes')
        ->assertSee('signed agreement controls for that project')
        ->assertSee('Pay')
        ->assertSee('Continue')
        ->assertSee('Confirm')
        ->assertSee('consumer rights that the law requires')
        ->assertDontSee('aggregate liability')
        ->assertDontSee('indemnify')
        ->assertDontSee('exclusive jurisdiction');
});

test('privacy policy covers the agency, digital products, payments and applicable jurisdictions', function (): void {
    $this->get(route('privacy'))
        ->assertSuccessful()
        ->assertSee('software development, design, digital marketing and related agency services')
        ->assertSee('Nigeria Data Protection Act 2023')
        ->assertSee('United States federal and state privacy laws')
        ->assertSee('hosting, cloud, software-development, collaboration')
        ->assertSee('When a digital product includes payment features')
        ->assertSee('Flutterwave')
        ->assertSee('Stripe')
        ->assertSee('does not intentionally store full card numbers or CVC security codes')
        ->assertSee('Your privacy rights')
        ->assertSee('please contact us first so we can review and address it')
        ->assertSee('applicable privacy laws may also give you the right to make a complaint')
        ->assertDontSee('Nigeria Data Protection Commission')
        ->assertDontSee('state attorney general')
        ->assertSee('support@techibytesmedia.com');
});

test('payment disclosure clearly identifies independent payment processing', function (): void {
    $this->get(route('payment-services-disclosure'))
        ->assertSuccessful()
        ->assertSee('software development and digital marketing company that also operates digital products')
        ->assertSee('Techibytes is not a bank')
        ->assertSee('Flutterwave')
        ->assertSee('Stripe')
        ->assertSee('does not take custody of, hold, control or redistribute customer funds')
        ->assertSee('It is not a deposit held by Techibytes')
        ->assertSee('Only the applicable provider or financial institution can release')
        ->assertSee('A successful checkout message does not always mean that final settlement is complete.')
        ->assertSee('support@techibytesmedia.com');
});

test('legal pages avoid naming individual Techibytes products', function (string $route_name): void {
    $this->get(route($route_name))
        ->assertSuccessful()
        ->assertDontSee('BillsWaka')
        ->assertDontSee('Sendbit')
        ->assertDontSee('Scholarly');
})->with(['terms', 'privacy', 'payment-services-disclosure']);

test('the shared footer links to every legal page without displaying the fintech disclosure', function (string $route_name): void {
    $this->get(route($route_name))
        ->assertSuccessful()
        ->assertSee('href="' . route('terms') . '"', false)
        ->assertSee('href="' . route('privacy') . '"', false)
        ->assertSee('href="' . route('payment-services-disclosure') . '"', false)
        ->assertDontSee('Some of our digital products include payment features.')
        ->assertDontSee('We do not hold or control customer funds.');
})->with(['home', 'services', 'portfolio', 'graphics', 'contact', 'terms', 'privacy', 'payment-services-disclosure']);

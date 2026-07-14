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

test('public pages include canonical and social metadata', function (string $routeName, string $path): void {
    config()->set('app.url', 'https://techibytesmedia.test');

    $canonical_url = 'https://techibytesmedia.test' . $path;
    $social_image_url = 'https://techibytesmedia.test/images/logo/logo-background.png';

    $this->get(route($routeName))
        ->assertSuccessful()
        ->assertSee('<link rel="canonical" href="' . $canonical_url . '">', false)
        ->assertSee('<meta property="og:url" content="' . $canonical_url . '">', false)
        ->assertSee('<meta property="og:image" content="' . $social_image_url . '">', false)
        ->assertSee('<meta name="twitter:card" content="summary">', false)
        ->assertSee('<meta name="twitter:image" content="' . $social_image_url . '">', false);
})->with([
    'home' => ['home', '/'],
    'services' => ['services', '/services'],
    'portfolio' => ['portfolio', '/portfolio'],
    'graphics' => ['graphics', '/graphics'],
    'contact' => ['contact', '/contact'],
]);

test('home page includes organization and website structured data', function (): void {
    config()->set('app.url', 'https://techibytesmedia.test');

    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('<script type="application/ld+json">', false)
        ->assertSee('"@type":"Organization"', false)
        ->assertSee('"@type":"WebSite"', false)
        ->assertSee('"legalName":"Techibytes Media LLC"', false)
        ->assertSee('"addressLocality":"Abuja"', false)
        ->assertSee('"addressLocality":"Seattle"', false)
        ->assertSee('"telephone":"+12065786373"', false);
});

test('sitemap lists every indexable public page', function (): void {
    config()->set('app.url', 'https://techibytesmedia.test');

    $response = $this->get(route('sitemap'))
        ->assertSuccessful()
        ->assertHeader('Content-Type', 'application/xml');

    foreach (['/', '/services', '/portfolio', '/graphics', '/contact'] as $path) {
        $response->assertSee('<loc>https://techibytesmedia.test' . $path . '</loc>', false);
    }

    expect(mb_substr_count($response->getContent(), '<url>'))->toBe(5);
});

test('robots file advertises the sitemap', function (): void {
    expect(file_get_contents(public_path('robots.txt')))
        ->toContain('User-agent: *')
        ->toContain('Sitemap: https://techibytesmedia.com/sitemap.xml');
});

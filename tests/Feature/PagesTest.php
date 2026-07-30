<?php

/*
 *
 *   Created by Techibytes Media Development Team
 *   Copyright Ⓒ 2026. All rights reserved, https://techibytesmedia.com/
 *   Project: techibytesmedia
 *   Last modified: 7/30/26, 2:46 PM
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

test('public pages render successfully', function (string $routeName, string $expectedText): void {
    $this->get(route($routeName))
        ->assertSuccessful()
        ->assertSee($expectedText);
})->with([
    'home' => ['home', 'We build digital products'],
    'services' => ['services', 'Everything your brand needs'],
    'portfolio' => ['portfolio', 'Work that'],
    'graphics' => ['graphics', 'Design that makes brands'],
    'contact' => ['contact', 'your project.'],
    'terms' => ['terms', 'Terms and Conditions'],
    'privacy' => ['privacy', 'Privacy Policy'],
    'payment disclosure' => ['payment-services-disclosure', 'Payment Services Disclosure'],
]);

test('every page includes the shared navigation and footer', function (): void {
    $this->get(route('home'))
        ->assertSee('techibytes')
        ->assertSee('Suite 303, 3rd Floor,', false)
        ->assertSee('600 1st Ave, Ste 102 #1105,', false)
        ->assertSee('data-testid="footer-wordmark"', false)
        ->assertSee('text-[clamp(1.5rem,8vw,8rem)]', false)
        ->assertSee('aria-hidden="true"', false);
});

test('the Seattle phone number appears in the footer and contact page', function (): void {
    foreach (['home', 'contact'] as $route_name) {
        $this->get(route($route_name))
            ->assertSuccessful()
            ->assertSee('href="tel:+12065786373"', false)
            ->assertSee('+1 206 578 6373');
    }
});

test('the shared layout loads the brand fonts', function (): void {
    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('font-family: "Instrument Sans"', false)
        ->assertSee('font-family: "Outfit"', false)
        ->assertDontSee('fonts.googleapis.com', false);
});

test('every page hero uses the grid-box background instead of gradient glows', function (string $routeName): void {
    $this->get(route($routeName))
        ->assertSuccessful()
        ->assertSee('bg-top-right bg-[size:56px_56px]', false)
        ->assertSee('linear-gradient(to_right,var(--color-line)_1px,transparent_1px)', false)
        ->assertSee('top-14 right-28 h-14 w-14 bg-accent/10', false)
        ->assertDontSee('bg-accent/8 blur-[90px]', false)
        ->assertDontSee('sm:bg-accent/10 sm:blur-[120px]', false)
        ->assertDontSee('blur-[100px] sm:block', false)
        ->assertDontSee('data-testid="mobile-hero-decoration"', false)
        ->assertDontSee('data-testid="mobile-hero-marker"', false);

    expect(file_get_contents(resource_path('css/app.css')))
        ->not->toContain('--animate-hero-marker:')
        ->not->toContain('@keyframes hero-marker');
})->with(['home', 'services', 'portfolio', 'graphics', 'contact']);

test('the home hero eyebrow shortens to two words on mobile', function (): void {
    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('<span class="sm:hidden">Digital Agency</span>', false)
        ->assertSee('<span class="hidden sm:inline">Software &middot; Design &middot; Marketing &mdash; Abuja &times; Seattle</span>', false);
});

test('the mobile menu carries the grid-box background when expanded', function (): void {
    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('id="mobile-menu" class="relative hidden overflow-hidden border-t border-line bg-ink/95 backdrop-blur-xl lg:hidden"', false)
        ->assertSee('relative flex flex-col gap-1 px-5 py-6', false);
});

test('the dark mode toggle is hidden for now and the site always renders light', function (): void {
    $this->get(route('home'))
        ->assertSuccessful()
        ->assertDontSee('id="theme-toggle"', false)
        ->assertDontSee("localStorage.getItem('theme')", false)
        ->assertDontSee('<html lang="en" class="scroll-smooth dark">', false);

    // Dark theme infrastructure stays in place for when the toggle returns
    expect(file_get_contents(resource_path('css/app.css')))
        ->toContain('@custom-variant dark')
        ->toContain('.dark {');
});

test('the home CTA uses the dark grid-box background instead of a blurred glow', function (): void {
    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('linear-gradient(to_right,rgb(255_255_255/0.07)_1px,transparent_1px)', false)
        ->assertSee('border border-accent-soft/25', false)
        ->assertDontSee('bg-accent-soft/15 blur-[120px]', false);
});

test('the trusted clients section displays real logos responsively', function (): void {
    $response = $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('data-testid="trusted-client-logos"', false)
        ->assertSee('grid w-full grid-cols-2 gap-3 sm:hidden', false)
        ->assertSee('hidden w-full overflow-hidden sm:block', false)
        ->assertSee('Trusted by teams across fintech, education, healthcare, fashion &amp; lifestyle', false)
        ->assertDontSee('images/work-done-logos/techibytes-logo.png', false);

    foreach (['bills-waka-logo.png', 'scholarly_logo.png', 'sendbit-logo.png', 'topfreshcuts-logo.png', 'st-michaels-logo.png', 'hofashionhub-logo.png', 'ibuildinitiative-logo.png'] as $logo) {
        $response->assertSee("images/work-done-logos/{$logo}", false);
        expect(public_path("images/work-done-logos/{$logo}"))->toBeFile();
    }

    expect(mb_substr_count($response->getContent(), 'images/work-done-logos/'))->toBe(21);
});

test('the home page presents realistic project and client totals', function (): void {
    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('data-count="20"', false)
        ->assertSee('Projects delivered')
        ->assertSee('data-count="15"', false)
        ->assertSee('Happy clients')
        ->assertDontSee('data-count="200"', false)
        ->assertDontSee('data-count="150"', false);
});

test('the team section presents the two real co-founders', function (): void {
    $response = $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('data-testid="founders-grid"', false)
        ->assertSee('mx-auto grid max-w-4xl gap-8 sm:grid-cols-2', false)
        ->assertSee('Meet the co-founders guiding the strategy')
        ->assertDontSee('Emmanuel O.')
        ->assertDontSee('Tola A.')
        ->assertDontSee('Maya S.')
        ->assertDontSee('Ibrahim K.');

    foreach (['Elijah Erigbemi.jpeg', 'Jude Obiejesi.jpg'] as $photo) {
        $response
            ->assertSee("images/founders/{$photo}", false)
            ->assertSee(pathinfo($photo, PATHINFO_FILENAME));

        expect(public_path("images/founders/{$photo}"))->toBeFile();
    }

    expect(mb_substr_count($response->getContent(), 'data-testid="founder-card"'))->toBe(2)
        ->and(mb_substr_count($response->getContent(), 'images/founders/'))->toBe(2)
        ->and(mb_substr_count($response->getContent(), 'Co-founder'))->toBeGreaterThanOrEqual(2);
});

test('project pages use automatically captured website screenshots', function (): void {
    $projects = collect(config('projects.items'));
    $recent_projects = $projects
        ->filter(fn (array $project): bool => $project['recent'] ?? false)
        ->take((int) config('projects.recent_limit', 4));
    $topfreshcuts = config('projects.items.topfreshcuts');

    $home = $this->get(route('home'))
        ->assertSuccessful();

    foreach ($recent_projects as $project) {
        $home
            ->assertSee($project['url'], false)
            ->assertSee($project['screenshot'], false)
            ->assertSee($project['name']);
    }

    $portfolio = $this->get(route('portfolio'))
        ->assertSuccessful()
        ->assertSee($topfreshcuts['title'])
        ->assertSee($topfreshcuts['tags'])
        ->assertDontSee('TopFreshCuts — grooming platform');

    foreach ($projects as $project) {
        $portfolio
            ->assertSee($project['url'], false)
            ->assertSee($project['screenshot'], false)
            ->assertSee($project['name']);
    }
});

test('the homepage shows at most four projects explicitly marked as recent', function (): void {
    $recent_limit = (int) config('projects.recent_limit', 4);
    $projects = collect(config('projects.items'))
        ->map(fn (array $project): array => [...$project, 'recent' => false])
        ->all();
    $recent_project_keys = array_slice(array_keys($projects), 0, $recent_limit);

    foreach ($recent_project_keys as $project_key) {
        $projects[$project_key]['recent'] = true;
    }

    $projects['future-project'] = [
        'recent' => true,
        'name' => 'Future Project',
        'title' => 'Future Project — Digital Platform',
        'url' => 'https://future-project.example/',
        'screenshot' => 'images/projects/future-project.jpg',
        'sector' => 'Technology',
        'tags' => 'Web development',
        'result' => 'A future portfolio project.',
    ];

    config(['projects.items' => $projects]);

    $home = $this->get(route('home'))
        ->assertSuccessful()
        ->assertDontSee('Future Project — Digital Platform');

    expect(mb_substr_count($home->getContent(), 'images/projects/'))->toBe($recent_limit);

    $excluded_project_key = $recent_project_keys[0];
    $projects[$excluded_project_key]['recent'] = false;
    config(['projects.items' => $projects]);

    $home = $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('Future Project — Digital Platform')
        ->assertDontSee($projects[$excluded_project_key]['title']);

    expect(mb_substr_count($home->getContent(), 'images/projects/'))->toBe($recent_limit);

    $this->get(route('portfolio'))
        ->assertSuccessful()
        ->assertSee('Future Project — Digital Platform')
        ->assertSee($projects[$excluded_project_key]['title']);
});

test('project screenshot hover motion stays restrained', function (): void {
    foreach (['home', 'portfolio'] as $route_name) {
        $this->get(route($route_name))
            ->assertSuccessful()
            ->assertSee('duration-500 ease-out group-hover:scale-[1.02]', false)
            ->assertSee('motion-reduce:transform-none motion-reduce:transition-none', false)
            ->assertDontSee('group-hover:scale-105', false);
    }
});

test('portfolio sector tags sit below project screenshots', function (): void {
    $response = $this->get(route('portfolio'))
        ->assertSuccessful()
        ->assertSee('data-testid="project-sector"', false)
        ->assertSee('mt-5', false)
        ->assertSee('flex flex-wrap items-center justify-between gap-3', false)
        ->assertSee('border-primary/20 bg-primary/8', false)
        ->assertSee('font-semibold uppercase tracking-[0.14em] text-primary', false)
        ->assertDontSee('data-testid="project-sector" class="absolute', false)
        ->assertDontSee('shadow-lg shadow-primary/25', false);

    expect(mb_substr_count($response->getContent(), 'data-testid="project-sector"'))->toBe(count(config('projects.items')));
});

test('services present representative technologies without implying an exhaustive list', function (): void {
    $response = $this->get(route('services'))
        ->assertSuccessful()
        ->assertSee('Laravel')
        ->assertSee('PHP')
        ->assertSee('Adobe Illustrator')
        ->assertSee('And many more');

    expect(mb_substr_count($response->getContent(), 'And many more'))->toBe(7);
});

test('graphics page presents professional design services instead of a self-service product', function (): void {
    $this->get(route('graphics'))
        ->assertSuccessful()
        ->assertSee('Graphic design &amp; branding services', false)
        ->assertSee('Logo &amp; Brand Identity', false)
        ->assertSee('A collaborative design process')
        ->assertSee('Brief our design team')
        ->assertDontSee('No credit card required')
        ->assertDontSee('free forever')
        ->assertDontSee('Choose from hundreds of professionally designed templates');
});

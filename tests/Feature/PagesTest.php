<?php

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
]);

test('every page includes the shared navigation and footer', function (): void {
    $this->get(route('home'))
        ->assertSee('techibytes')
        ->assertSee('Suite 303, 3rd Floor,', false)
        ->assertSee('600 1st Ave, Ste 102 #1105,', false);
});

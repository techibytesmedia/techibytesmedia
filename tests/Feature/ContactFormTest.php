<?php

declare(strict_types = 1);

test('a valid contact submission redirects back with a status message', function (): void {
    $this->post(route('contact.submit'), [
        'name' => 'Ada Obi',
        'email' => 'ada@example.com',
        'service' => 'Web Development',
        'budget' => '$1,000 – $5,000',
        'message' => 'We need a new e-commerce website for our retail brand.',
    ])
        ->assertRedirect(route('contact'))
        ->assertSessionHas('status');
});

test('a contact submission requires the mandatory fields', function (array $payload, string $invalidField): void {
    $this->from(route('contact'))
        ->post(route('contact.submit'), $payload)
        ->assertRedirect(route('contact'))
        ->assertSessionHasErrors($invalidField);
})->with([
    'missing name' => [['email' => 'ada@example.com', 'message' => 'Hello'], 'name'],
    'missing email' => [['name' => 'Ada', 'message' => 'Hello'], 'email'],
    'invalid email' => [['name' => 'Ada', 'email' => 'not-an-email', 'message' => 'Hello'], 'email'],
    'missing message' => [['name' => 'Ada', 'email' => 'ada@example.com'], 'message'],
]);

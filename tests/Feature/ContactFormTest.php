<?php

/*
 *
 *   Created by Techibytes Media Development Team
 *   Copyright Ⓒ 2026. All rights reserved, https://techibytesmedia.com/
 *   Project: techibytesmedia
 *   Last modified: 7/11/26, 11:52 AM
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

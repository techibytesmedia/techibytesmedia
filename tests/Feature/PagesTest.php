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

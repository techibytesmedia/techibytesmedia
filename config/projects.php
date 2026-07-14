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

return [
    'recent_limit' => 4,

    'capture' => [
        'viewport_width' => 1440,
        'viewport_height' => 1080,
        'timeout' => 120,
    ],

    'items' => [
        'billswaka' => [
            'recent' => true,
            'name' => 'BillsWaka',
            'title' => 'Bills Waka — Bills Platform',
            'url' => 'https://billswaka.com/',
            'screenshot' => 'images/projects/billswaka.jpg',
            'sector' => 'Fintech',
            'tags' => 'Mobile app · Web development',
            'result' => 'Create virtual dollar cards and make payments with ease.',
        ],
        'scholarly' => [
            'recent' => true,
            'name' => 'Scholarly',
            'title' => 'Scholarly — Education Platform',
            'url' => 'https://scholarly.africa/',
            'screenshot' => 'images/projects/scholarly.jpg',
            'sector' => 'Education',
            'tags' => 'Web development',
            'result' => 'A leading educational technology company based in Nigeria with over 3m users.',
        ],
        'sendbit' => [
            'recent' => true,
            'name' => 'Sendbit',
            'title' => 'Sendbit — Fintech Platform',
            'url' => 'https://mysendbit.com/',
            'screenshot' => 'images/projects/sendbit.jpg',
            'sector' => 'Payments',
            'tags' => 'App · Web development',
            'result' => 'Accept payments globally through invoices, international accounts and digital assets.',
        ],
        'topfreshcuts' => [
            'recent' => true,
            'name' => 'TopFreshCuts',
            'title' => 'TopFreshCuts — Barbershop',
            'url' => 'https://topfreshcuts.com/',
            'screenshot' => 'images/projects/topfreshcuts.jpg',
            'sector' => 'Beauty & Grooming',
            'tags' => 'Web development · booking',
            'result' => 'A modern barbershop website that showcases services, pricing and makes it easy for clients to book appointments.',
        ],
    ],
];

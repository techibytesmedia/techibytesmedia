<?php

/*
 *
 *   Created by Techibytes Media Development Team
 *   Copyright Ⓒ 2026. All rights reserved, https://techibytesmedia.com/
 *   Project: techibytesmedia
 *   Last modified: 7/30/26, 4:30 PM
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

use App\Mail\ContactInquiry;

uses(Tests\TestCase::class);

test('the contact inquiry email contains the submitted details and reply address', function (): void {
    $mail = new ContactInquiry(
        name: 'Ada Obi',
        email: 'ada@example.com',
        service: 'Web Development',
        budget: '$1,000 – $5,000',
        message: 'We need a responsive e-commerce website.',
    );

    $mail
        ->assertHasSubject('New project inquiry from Ada Obi [' . now()->format('M j, Y g:i A T') . ']')
        ->assertHasReplyTo('ada@example.com', 'Ada Obi')
        ->assertSeeInHtml('images/logo/logo-2.png')
        ->assertSeeInHtml('New project inquiry')
        ->assertSeeInHtml('Hi Techibytes Media team')
        ->assertSeeInHtml('Inquiry details')
        ->assertSeeInHtml('border-collapse: separate')
        ->assertSeeInHtml('overflow-wrap: anywhere')
        ->assertSeeInHtml('Project brief')
        ->assertSeeInHtml('Reply directly to this email')
        ->assertSeeInHtml('support@techibytesmedia.com')
        ->assertSeeInHtml('Ada Obi')
        ->assertSeeInHtml('ada@example.com')
        ->assertSeeInHtml('Web Development')
        ->assertSeeInHtml('$1,000 – $5,000')
        ->assertSeeInHtml('We need a responsive e-commerce website.')
        ->assertSeeInText('Ada Obi')
        ->assertSeeInText('We need a responsive e-commerce website.')
        ->assertDontSeeInHtml('Reply to Ada Obi')
        ->assertDontSeeInHtml('A new project opportunity');

    expect($mail->theme)->toBe('techibytes');
});

test('the contact inquiry email displays fallbacks for optional details', function (): void {
    $mail = new ContactInquiry(
        name: 'Ada Obi',
        email: 'ada@example.com',
        service: null,
        budget: null,
        message: 'Please contact me.',
    );

    $mail->assertSeeInHtml('Not specified');
});

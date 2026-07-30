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

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ContactInquiry extends Mailable
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $service,
        public readonly ?string $budget,
        public readonly string $message,
    ) {
        $this->theme = 'techibytes';
    }

    public function envelope(): Envelope
    {
        $submitted_at = now()->format('M j, Y g:i A T');

        return new Envelope(
            replyTo: [
                new Address($this->email, $this->name),
            ],
            subject: "New project inquiry from {$this->name} [{$submitted_at}]",
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.contact-inquiry',
        );
    }
}

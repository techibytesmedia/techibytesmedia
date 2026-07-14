<?php

/*
 *
 *   Created by Techibytes Media Development Team
 *   Copyright Ⓒ 2026. All rights reserved, https://techibytesmedia.com/
 *   Project: techibytesmedia
 *   Last modified: 7/13/26, 8:16 PM
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

use Illuminate\Process\PendingProcess;
use Illuminate\Support\Facades\Process;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;

test('the capture command refreshes every configured project screenshot', function (): void {
    Process::fake();

    $this->artisan('projects:capture')
        ->expectsOutputToContain('All requested project screenshots are up to date.')
        ->assertSuccessful();

    foreach (config('projects.items') as $project) {
        Process::assertRan(function (PendingProcess $process) use ($project): bool {
            $command = is_array($process->command) ? implode(' ', $process->command) : $process->command;

            return str_contains($command, $project['url'])
                && str_contains($command, public_path($project['screenshot']));
        });
    }
});

test('an unknown project cannot be captured', function (): void {
    Process::fake();

    $this->artisan('projects:capture missing-project')
        ->expectsOutputToContain('Unknown project [missing-project].')
        ->assertFailed();

    Process::assertNothingRan();
});

test('a failed capture preserves the previous screenshot and reports the failure', function (): void {
    $project_name = config('projects.items.billswaka.name');

    Process::fake([
        '*billswaka*' => Process::result(errorOutput: 'Website unavailable', exitCode: 1),
    ]);

    $this->artisan('projects:capture billswaka')
        ->expectsOutputToContain("Could not capture {$project_name}: Website unavailable")
        ->expectsOutputToContain('Existing screenshots were kept')
        ->assertFailed();
});

test('project screenshots are refreshed automatically each week', function (): void {
    $event = collect(app(Schedule::class)->events())
        ->first(fn (Event $event): bool => str_contains($event->command, 'projects:capture'));

    expect($event)->toBeInstanceOf(Event::class);
    assert($event instanceof Event);

    expect($event->expression)->toBe('0 3 * * 1')
        ->and($event->withoutOverlapping)->toBeTrue();
});

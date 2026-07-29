<?php

/*
 *
 *   Created by Techibytes Media Development Team
 *   Copyright Ⓒ 2026. All rights reserved, https://techibytesmedia.com/
 *   Project: techibytesmedia
 *   Last modified: 7/29/26, 12:22 AM
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

use function Pest\Laravel\mock;

use Illuminate\Process\PendingProcess;
use Illuminate\Support\Facades\Process;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use App\Contracts\ProjectScreenshotManagerContract;

test('the capture command refreshes every configured project screenshot', function (): void {
    $projects = config('projects.items');
    $first_project = collect($projects)->first();
    $screenshots = mock(ProjectScreenshotManagerContract::class);
    $screenshots->shouldReceive('nextScreenshotPath')
        ->times(count($projects))
        ->andReturnUsing(fn (string $current_screenshot): string => rotated_screenshot_path($current_screenshot));
    $screenshots->shouldReceive('activateScreenshot')
        ->times(count($projects))
        ->andReturnUsing(function (string $project_key, string $current_screenshot, string $new_screenshot) use ($projects): bool {
            expect($projects[$project_key]['screenshot'])->toBe($current_screenshot)
                ->and($new_screenshot)->toBe(rotated_screenshot_path($current_screenshot));

            return true;
        });
    $screenshots->shouldNotReceive('discardScreenshot');

    Process::fake();

    $this->artisan('projects:capture')
        ->expectsOutputToContain("Capturing {$first_project['name']} ({$first_project['url']})...")
        ->expectsOutputToContain('All requested project screenshots are up to date.')
        ->assertSuccessful();

    foreach ($projects as $project) {
        Process::assertRan(function (PendingProcess $process) use ($project): bool {
            $command = is_array($process->command) ? implode(' ', $process->command) : $process->command;

            return str_contains($command, $project['url'])
                && str_contains($command, public_path(rotated_screenshot_path($project['screenshot'])));
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
    $project = config('projects.items.billswaka');
    $new_screenshot = rotated_screenshot_path($project['screenshot']);
    $screenshots = mock(ProjectScreenshotManagerContract::class);
    $screenshots->shouldReceive('nextScreenshotPath')
        ->once()
        ->with($project['screenshot'])
        ->andReturn($new_screenshot);
    $screenshots->shouldReceive('discardScreenshot')
        ->once()
        ->with($new_screenshot)
        ->andReturnTrue();
    $screenshots->shouldNotReceive('activateScreenshot');

    Process::fake([
        '*billswaka*' => Process::result(errorOutput: 'Website unavailable', exitCode: 1),
    ]);

    $this->artisan('projects:capture billswaka')
        ->expectsOutputToContain("Could not capture {$project['name']}: Website unavailable")
        ->expectsOutputToContain('Existing screenshots were kept')
        ->assertFailed();
});

test('security challenge pages are rejected before replacing project screenshots', function (): void {
    $script = <<<'JS'
    import { capturePageFailure } from './resources/js/capture-project-page-guard.js';

    console.log(JSON.stringify({
        challenge: capturePageFailure({
            status: 200,
            title: 'topfreshcuts.com',
            bodyText: 'Performing security verification. Verify you are human. Ray ID: example',
            hasChallengeElement: true,
        }),
        unavailable: capturePageFailure({
            status: 503,
            title: 'Service unavailable',
            bodyText: '',
            hasChallengeElement: false,
        }),
        website: capturePageFailure({
            status: 200,
            title: 'TopFreshCuts',
            bodyText: 'Sharp cuts, clean service, fresh every time.',
            hasChallengeElement: false,
        }),
    }));
    JS;

    $result = Process::path(base_path())->run(['node', '--input-type=module', '--eval', $script]);

    try {
        expect($result->successful())->toBeTrue()
            ->and(json_decode($result->output(), true, flags: JSON_THROW_ON_ERROR))->toBe([
                'challenge' => 'The target website returned an anti-bot verification page.',
                'unavailable' => 'The target website returned HTTP 503.',
                'website' => null,
            ])
            ->and(file_get_contents(resource_path('js/capture-project-screenshot.js')))
            ->toContain("await page.waitForLoadState('networkidle', { timeout: 15_000 }).catch(() => undefined);\n    await page.waitForTimeout(15_000);")
            ->toContain("reducedMotion: 'no-preference'")
            ->not->toContain("reducedMotion: 'reduce'")
            ->toContain('video.readyState < HTMLMediaElement.HAVE_CURRENT_DATA')
            ->toContain("video.addEventListener('loadeddata'")
            ->toContain('await video.play().catch(() => undefined);')
            ->toContain('capturePageFailure({')
            ->toContain('throw new Error(pageFailure)');
    } catch (JsonException $e) {
        $this->fail($e->getMessage());
    }
});

test('project screenshots are refreshed automatically each week', function (): void {
    $event = collect(app(Schedule::class)->events())
        ->first(fn (Event $event): bool => str_contains($event->command, 'projects:capture'));

    expect($event)->toBeInstanceOf(Event::class);
    assert($event instanceof Event);

    expect($event->expression)->toBe('0 3 * * 1')
        ->and($event->withoutOverlapping)->toBeTrue();
});

function rotated_screenshot_path(string $current_screenshot): string
{
    $directory = pathinfo($current_screenshot, PATHINFO_DIRNAME);
    $extension = pathinfo($current_screenshot, PATHINFO_EXTENSION);
    $filename = pathinfo($current_screenshot, PATHINFO_FILENAME);
    $base_filename = preg_replace('/-\d{6}$/', '', $filename) ?? $filename;
    $new_filename = "{$base_filename}-123456.{$extension}";

    return '.' === $directory ? $new_filename : "{$directory}/{$new_filename}";
}

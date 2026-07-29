<?php

/*
 *
 *   Created by Techibytes Media Development Team
 *   Copyright Ⓒ 2026. All rights reserved, https://techibytesmedia.com/
 *   Project: techibytesmedia
 *   Last modified: 7/29/26, 12:13 AM
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

namespace App\Console\Commands;

use Throwable;
use Random\RandomException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Attributes\Description;
use App\Contracts\ProjectScreenshotManagerContract;

#[Signature('projects:capture {project? : Capture only the project with this slug}')]
#[Description('Capture fresh website screenshots for the project portfolio')]
class CaptureProjectScreenshots extends Command
{
    public function __construct(private readonly ProjectScreenshotManagerContract $screenshots)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @throws RandomException
     */
    public function handle(): int
    {
        /** @var array<string, array{name: string, url: string, screenshot: string}> $projects */
        $projects = config('projects.items', []);
        $requested_project = $this->argument('project');

        if (is_string($requested_project)) {
            if ( ! array_key_exists($requested_project, $projects)) {
                $this->error("Unknown project [{$requested_project}].");

                return self::FAILURE;
            }

            $projects = [$requested_project => $projects[$requested_project]];
        }

        $failures = 0;

        foreach ($projects as $project_key => $project) {
            $new_screenshot = $this->screenshots->nextScreenshotPath($project['screenshot']);
            $this->line("Capturing {$project['name']} ({$project['url']})...");

            $result = Process::path(base_path())
                ->timeout((int) config('projects.capture.timeout', 120))
                ->run([
                    'node',
                    'resources/js/capture-project-screenshot.js',
                    '--url',
                    $project['url'],
                    '--output',
                    public_path($new_screenshot),
                    '--width',
                    (string) config('projects.capture.viewport_width', 1440),
                    '--height',
                    (string) config('projects.capture.viewport_height', 1080),
                ]);

            if ( ! $result->successful()) {
                $this->screenshots->discardScreenshot($new_screenshot);
                $failures++;
                $message = mb_trim($result->errorOutput()) ?: 'The capture process exited unexpectedly.';
                $this->error("Could not capture {$project['name']}: {$message}");

                continue;
            }

            try {
                $old_screenshot_removed = $this->screenshots->activateScreenshot(
                    $project_key,
                    $project['screenshot'],
                    $new_screenshot,
                );
            } catch (Throwable $exception) {
                $this->screenshots->discardScreenshot($new_screenshot);
                $failures++;
                $this->error("Could not activate {$project['name']} screenshot: {$exception->getMessage()}");

                continue;
            }

            if ( ! $old_screenshot_removed) {
                $this->warn("Captured {$project['name']}, but its previous screenshot could not be removed.");
            }

            $this->info("Captured {$project['name']} as {$new_screenshot}.");
        }

        if ($failures > 0) {
            $this->warn('Existing screenshots were kept for projects that could not be refreshed.');

            return self::FAILURE;
        }

        $this->newLine();
        $this->info('All requested project screenshots are up to date.');

        return self::SUCCESS;
    }
}

<?php

/*
 *
 *   Created by Techibytes Media Development Team
 *   Copyright Ⓒ 2026. All rights reserved, https://techibytesmedia.com/
 *   Project: techibytesmedia
 *   Last modified: 7/29/26, 12:12 AM
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

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Services\ProjectScreenshotManager;
use App\Contracts\ProjectScreenshotManagerContract;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

test('the screenshot manager contract resolves to the readonly implementation', function (): void {
    expect(app(ProjectScreenshotManagerContract::class))
        ->toBeInstanceOf(ProjectScreenshotManager::class)
        ->and((new ReflectionClass(ProjectScreenshotManager::class))->isReadOnly())->toBeTrue();
});
test('it rotates a screenshot path and persists the new path in project config', function (): void {
    $fixture = project_screenshot_fixture();

    try {
        $screenshots = app(ProjectScreenshotManager::class);

        try {
            $new_screenshot = $screenshots->nextScreenshotPath($fixture['old_screenshot']);
            expect($new_screenshot)
                ->toMatch('/^images\/projects\/billswaka-\d{6}\.jpg$/')
                ->not->toBe($fixture['old_screenshot']);

            File::put(public_fixture_path($fixture, $new_screenshot), 'new screenshot');

            expect($screenshots->activateScreenshot('billswaka', $fixture['old_screenshot'], $new_screenshot))->toBeTrue()
                ->and(File::exists(public_fixture_path($fixture, $fixture['old_screenshot'])))->toBeFalse()
                ->and(File::get(public_fixture_path($fixture, $new_screenshot)))->toBe('new screenshot')
                ->and(File::get($fixture['config_path']))->toContain("'screenshot' => '{$new_screenshot}'")
                ->and(config('projects.items.billswaka.screenshot'))->toBe($new_screenshot);
        } catch (Throwable $e) {
            $this->fail($e->getMessage());
        }
    } finally {
        File::deleteDirectory($fixture['root']);
    }
});

test('it preserves the current screenshot and config when the new capture is missing', function (): void {
    $fixture = project_screenshot_fixture();
    $missing_screenshot = 'images/projects/billswaka-222222.jpg';

    try {
        $screenshots = app(ProjectScreenshotManager::class);

        try {
            expect(fn () => $screenshots->activateScreenshot('billswaka', $fixture['old_screenshot'], $missing_screenshot))
                ->toThrow(RuntimeException::class, "The captured screenshot [{$missing_screenshot}] does not exist.")
                ->and(File::exists(public_fixture_path($fixture, $fixture['old_screenshot'])))->toBeTrue()
                ->and(File::get($fixture['config_path']))->toContain("'screenshot' => '{$fixture['old_screenshot']}'")
                ->and(config('projects.items.billswaka.screenshot'))->toBe($fixture['old_screenshot']);
        } catch (FileNotFoundException $e) {
            $this->fail($e->getMessage());
        }
    } finally {
        File::deleteDirectory($fixture['root']);
    }
});

/**
 * @return array{root: string, public_path: string, config_path: string, old_screenshot: string}
 */
function project_screenshot_fixture(): array
{
    $root = storage_path('framework/testing/project-screenshot-' . Str::uuid());
    $public_path = $root . DIRECTORY_SEPARATOR . 'public';
    $config_path = $root . DIRECTORY_SEPARATOR . 'projects.php';
    $old_screenshot = 'images/projects/billswaka-111111.jpg';

    File::ensureDirectoryExists($public_path . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'projects');
    File::put(public_fixture_path(['public_path' => $public_path], $old_screenshot), 'old screenshot');
    File::put($config_path, <<<PHP
    <?php

    return [
        'items' => [
            'billswaka' => [
                'screenshot' => '{$old_screenshot}',
            ],
        ],
    ];
    PHP);

    config()->set([
        'projects.paths.config' => $config_path,
        'projects.paths.public' => $public_path,
        'projects.items.billswaka.screenshot' => $old_screenshot,
    ]);

    return [
        'root' => $root,
        'public_path' => $public_path,
        'config_path' => $config_path,
        'old_screenshot' => $old_screenshot,
    ];
}

/**
 * @param  array{public_path: string}  $fixture
 */
function public_fixture_path(array $fixture, string $screenshot): string
{
    return $fixture['public_path'] . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $screenshot);
}

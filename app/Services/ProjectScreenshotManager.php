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

namespace App\Services;

use RuntimeException;
use Illuminate\Support\Str;
use Random\RandomException;
use InvalidArgumentException;
use Illuminate\Filesystem\Filesystem;
use App\Contracts\ProjectScreenshotManagerContract;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

readonly class ProjectScreenshotManager implements ProjectScreenshotManagerContract
{
    public function __construct(private Filesystem $files) {}

    /**
     * @throws RandomException
     */
    public function nextScreenshotPath(string $current_screenshot): string
    {
        $current_screenshot = $this->normalizedRelativePath($current_screenshot);
        $directory = pathinfo($current_screenshot, PATHINFO_DIRNAME);
        $extension = pathinfo($current_screenshot, PATHINFO_EXTENSION);
        $filename = pathinfo($current_screenshot, PATHINFO_FILENAME);
        $base_filename = preg_replace('/-\d{6}$/', '', $filename) ?? $filename;

        if ('' === $extension) {
            throw new InvalidArgumentException('Project screenshot paths must include a file extension.');
        }

        do {
            $random_number = random_int(100000, 999999);
            $new_filename = "{$base_filename}-{$random_number}.{$extension}";
            $new_screenshot = '.' === $directory ? $new_filename : "{$directory}/{$new_filename}";
        } while ($this->files->exists($this->absolutePublicPath($new_screenshot)));

        return $new_screenshot;
    }

    /**
     * @throws FileNotFoundException
     */
    public function activateScreenshot(
        string $projectKey,
        string $current_screenshot,
        string $new_screenshot,
    ): bool {
        $current_screenshot = $this->normalizedRelativePath($current_screenshot);
        $new_screenshot = $this->normalizedRelativePath($new_screenshot);
        $new_screenshot_path = $this->absolutePublicPath($new_screenshot);

        if ( ! $this->files->isFile($new_screenshot_path)) {
            throw new RuntimeException("The captured screenshot [{$new_screenshot}] does not exist.");
        }

        $projects_config_path = $this->projectsConfigPath();
        $config_contents = $this->files->get($projects_config_path);
        $project_key_literal = preg_quote(var_export($projectKey, true), '/');
        $project_pattern = "/(?<project>^        {$project_key_literal} => \[\R.*?^        \],)/ms";

        if (1 !== preg_match($project_pattern, $config_contents, $matches)) {
            throw new RuntimeException("Project [{$projectKey}] could not be located in the projects config file.");
        }

        $current_line = "            'screenshot' => " . var_export($current_screenshot, true) . ',';
        $new_line = "            'screenshot' => " . var_export($new_screenshot, true) . ',';
        $updated_project = Str::replaceFirst($current_line, $new_line, $matches['project']);

        if ($updated_project === $matches['project']) {
            throw new RuntimeException("Screenshot [{$current_screenshot}] could not be located for project [{$projectKey}].");
        }

        $this->clearConfigurationCache();
        $this->files->replace(
            $projects_config_path,
            Str::replaceFirst($matches['project'], $updated_project, $config_contents),
        );

        config(["projects.items.{$projectKey}.screenshot" => $new_screenshot]);

        return $this->discardScreenshot($current_screenshot);
    }

    public function discardScreenshot(string $screenshot): bool
    {
        $screenshot_path = $this->absolutePublicPath($this->normalizedRelativePath($screenshot));

        return ! $this->files->exists($screenshot_path) || $this->files->delete($screenshot_path);
    }

    private function clearConfigurationCache(): void
    {
        if ( ! app()->configurationIsCached()) {
            return;
        }

        $cached_config_path = app()->getCachedConfigPath();

        if ( ! $this->files->delete($cached_config_path)) {
            throw new RuntimeException('The cached configuration could not be cleared.');
        }
    }

    private function projectsConfigPath(): string
    {
        return (string) config('projects.paths.config', config_path('projects.php'));
    }

    private function absolutePublicPath(string $screenshot): string
    {
        $public_directory = (string) config('projects.paths.public', public_path());

        return mb_rtrim($public_directory, '/\\') . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $screenshot);
    }

    private function normalizedRelativePath(string $path): string
    {
        $path = str_replace('\\', '/', $path);

        if (
            Str::startsWith($path, '/')
            || 1 === preg_match('/^[A-Za-z]:\//', $path)
            || in_array('..', explode('/', $path), true)
        ) {
            throw new InvalidArgumentException('Project screenshot paths must remain inside the public directory.');
        }

        return $path;
    }
}

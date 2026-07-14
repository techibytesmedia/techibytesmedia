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

import { mkdir, rename, rm } from 'node:fs/promises';
import { dirname } from 'node:path';
import { chromium } from 'playwright';

function argumentsFrom(commandLine) {
    const argumentsMap = new Map();

    for (let index = 0; index < commandLine.length; index += 2) {
        argumentsMap.set(commandLine[index], commandLine[index + 1]);
    }

    return argumentsMap;
}

const argumentsMap = argumentsFrom(process.argv.slice(2));
const url = argumentsMap.get('--url');
const output = argumentsMap.get('--output');
const width = Number(argumentsMap.get('--width') ?? 1440);
const height = Number(argumentsMap.get('--height') ?? 1080);
let parsedUrl;

try {
    parsedUrl = new URL(url);
} catch {
    throw new Error('A valid HTTP URL and output path are required.');
}

if (! output || ! ['http:', 'https:'].includes(parsedUrl.protocol)) {
    throw new Error('A valid HTTP URL and output path are required.');
}

if (! Number.isInteger(width) || ! Number.isInteger(height) || width < 320 || height < 320) {
    throw new Error('The screenshot viewport must use valid integer dimensions.');
}

await mkdir(dirname(output), { recursive: true });

const temporaryOutput = `${output}.${process.pid}.tmp`;
const browser = await chromium.launch({ headless: true });

try {
    const page = await browser.newPage({
        viewport: { width, height },
        deviceScaleFactor: 1,
        reducedMotion: 'reduce',
    });

    await page.goto(url, {
        waitUntil: 'domcontentloaded',
        timeout: 45_000,
    });

    await page.waitForLoadState('networkidle', { timeout: 15_000 }).catch(() => undefined);
    await page.addStyleTag({
        content: `
            *, *::before, *::after {
                animation-delay: 0s !important;
                animation-duration: 0s !important;
                caret-color: transparent !important;
                scroll-behavior: auto !important;
                transition-delay: 0s !important;
                transition-duration: 0s !important;
            }
        `,
    });
    await page.evaluate(async () => {
        await document.fonts?.ready;
        window.scrollTo(0, 0);
    });
    await page.waitForTimeout(1_000);

    await page.screenshot({
        path: temporaryOutput,
        type: 'jpeg',
        quality: 82,
        fullPage: false,
    });

    await rename(temporaryOutput, output);
} finally {
    await rm(temporaryOutput, { force: true });
    await browser.close();
}

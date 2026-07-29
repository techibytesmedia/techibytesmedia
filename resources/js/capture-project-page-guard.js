/*
 *
 *   Created by Techibytes Media Development Team
 *   Copyright Ⓒ 2026. All rights reserved, https://techibytesmedia.com/
 *   Project: techibytesmedia
 *   Last modified: 7/14/26, 12:39 AM
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

export function capturePageFailure({ status, title, bodyText, hasChallengeElement }) {
    if (status >= 400) {
        return `The target website returned HTTP ${status}.`;
    }

    const pageText = `${title}\n${bodyText}`.toLowerCase();
    const displaysSecurityChallenge = hasChallengeElement
        || pageText.includes('performing security verification')
        || pageText.includes('checking your browser before accessing')
        || (pageText.includes('verify you are human') && pageText.includes('ray id'))
        || (pageText.includes('just a moment') && pageText.includes('enable javascript and cookies to continue'));

    if (displaysSecurityChallenge) {
        return 'The target website returned an anti-bot verification page.';
    }

    return null;
}

<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Handle a contact form submission.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'service' => ['nullable', 'string', 'max:120'],
            'budget' => ['nullable', 'string', 'max:60'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Log::channel('single')->info('Contact inquiry received', $validated);

        return redirect()
            ->route('contact')
            ->with('status', "Thanks {$validated['name']} — we got your message and will reply within one business day.");
    }
}

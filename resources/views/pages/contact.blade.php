<x-layout
    title="Contact Us — Abuja & Seattle | Techibytes Media"
    description="Talk to Techibytes Media about your next website, app, brand or campaign. Offices in Abuja, Nigeria and Seattle, USA."
>
    @push('head')
        <link rel="preconnect" href="https://challenges.cloudflare.com">
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endpush

    {{-- Page hero --}}
    <section class="relative overflow-hidden pt-36 pb-16 sm:pt-44 sm:pb-20">
        <x-hero-grid />

        <div class="relative mx-auto max-w-7xl px-5 sm:px-8">
            <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-accent">Contact</p>
            <h1 class="reveal mt-5 max-w-4xl font-display text-[clamp(2.5rem,7vw,5.5rem)] font-extrabold leading-[1.02]" style="--reveal-delay: .1s">
                Let's talk about <span class="text-accent">your project.</span>
            </h1>
            <p class="reveal mt-8 max-w-xl text-lg leading-relaxed text-muted" style="--reveal-delay: .2s">
                Tell us what you're building and we'll come back within 1 to 4 business days with honest
                advice and clear next steps — no pressure, no jargon.
            </p>
        </div>
    </section>

    <section class="border-t border-line">
        <div class="mx-auto grid max-w-7xl gap-16 px-5 py-20 sm:px-8 sm:py-28 lg:grid-cols-12">

            {{-- Form --}}
            <div class="reveal lg:col-span-7">
                @if (session('error'))
                    <div class="mb-8 rounded-2xl border border-red-600/40 bg-red-600/10 p-6 text-red-600" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('status'))
                    <div class="mb-8 rounded-2xl border border-accent/40 bg-accent/10 p-6 text-accent" role="status">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="_contact_form" value="{{ $contactFormToken }}">

                    <div class="pointer-events-none absolute -left-[10000px] top-auto h-px w-px overflow-hidden" aria-hidden="true">
                        <label for="_contact_reference">Leave this field empty</label>
                        <input
                            type="text"
                            id="_contact_reference"
                            name="_contact_reference"
                            tabindex="-1"
                            autocomplete="off"
                            data-1p-ignore
                            data-lpignore="true"
                            data-bwignore="true"
                        >
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label for="name" class="mb-2 block text-sm font-medium">Your name <span class="text-accent">*</span></label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                placeholder="Ada Obi"
                                class="w-full rounded-xl border border-line bg-panel px-5 py-4 text-bone placeholder:text-muted/60 focus:border-primary focus:outline-none"
                            >
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium">Email <span class="text-accent">*</span></label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                placeholder="you@company.com"
                                class="w-full rounded-xl border border-line bg-panel px-5 py-4 text-bone placeholder:text-muted/60 focus:border-primary focus:outline-none"
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label for="service" class="mb-2 block text-sm font-medium">What do you need?</label>
                            <select
                                id="service"
                                name="service"
                                class="w-full appearance-none rounded-xl border border-line bg-panel px-5 py-4 text-bone focus:border-primary focus:outline-none"
                            >
                                <option value="">Select a service&hellip;</option>
                                @foreach (['Web Development', 'Mobile App Development', 'UI/UX Design', 'Digital Marketing', 'SEO', 'Branding & Graphics', 'Not sure yet'] as $option)
                                    <option value="{{ $option }}" @selected(old('service') === $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="budget" class="mb-2 block text-sm font-medium">Budget range</label>
                            <select
                                id="budget"
                                name="budget"
                                class="w-full appearance-none rounded-xl border border-line bg-panel px-5 py-4 text-bone focus:border-primary focus:outline-none"
                            >
                                <option value="">Select a range&hellip;</option>
                                @foreach (['Under $1,000', '$1,000 – $5,000', '$5,000 – $15,000', '$15,000+', 'Let\'s discuss'] as $option)
                                    <option value="{{ $option }}" @selected(old('budget') === $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="message" class="mb-2 block text-sm font-medium">Tell us about the project <span class="text-accent">*</span></label>
                        <textarea
                            id="message"
                            name="message"
                            rows="6"
                            required
                            placeholder="What are you building, who is it for, and when do you need it?"
                            class="w-full rounded-xl border border-line bg-panel px-5 py-4 text-bone placeholder:text-muted/60 focus:border-primary focus:outline-none"
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div
                            class="cf-turnstile w-full"
                            data-sitekey="{{ config('services.turnstile.site_key') }}"
                            data-action="{{ config('services.turnstile.action') }}"
                            data-theme="dark"
                            data-size="flexible"
                        ></div>
                        @error('cf-turnstile-response')
                            <p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="group inline-flex items-center gap-3 rounded-full bg-primary px-8 py-4 font-semibold text-white transition-transform hover:scale-105"
                    >
                        Send message
                        <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
                    </button>
                </form>
            </div>

            {{-- Contact details --}}
            <aside class="reveal space-y-10 lg:col-span-5" style="--reveal-delay: .15s">
                <div class="rounded-2xl border border-line bg-panel p-8">
                    <h2 class="text-xs font-semibold uppercase tracking-[0.2em] text-muted">Abuja office</h2>
                    <p class="mt-4 leading-relaxed text-bone/85">
                        Suite 303, 3rd Floor, Ammah Plaza,<br>
                        Near NAF Conference Center,<br>
                        Abuja, Nigeria
                    </p>
                    <a href="tel:+2349031807262" class="link-draw mt-4 inline-block font-semibold text-accent">+234 903 180 7262</a>
                </div>

                <div class="rounded-2xl border border-line bg-panel p-8">
                    <h2 class="text-xs font-semibold uppercase tracking-[0.2em] text-muted">Seattle office</h2>
                    <p class="mt-4 leading-relaxed text-bone/85">
                        600 1st Ave, Ste 102 #1105,<br>
                        Seattle, WA 98104,<br>
                        United States
                    </p>
                </div>

                <div class="rounded-2xl border border-line bg-panel p-8">
                    <h2 class="text-xs font-semibold uppercase tracking-[0.2em] text-muted">Email</h2>
                    <a href="mailto:info@techibytesmedia.com" class="link-draw mt-4 inline-block font-semibold text-bone">info@techibytesmedia.com</a>
                    <p class="mt-4 text-sm text-muted">Mon &ndash; Fri, 9:00 &ndash; 18:00 (WAT / PT)</p>
                </div>
            </aside>
        </div>
    </section>

</x-layout>

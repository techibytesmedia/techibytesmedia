<x-layout
    title="Graphic Design & Branding Services | Techibytes Media"
    description="Professional graphic design and branding services from Techibytes Media, including logos, social media creative, campaigns, print, packaging, presentations and motion graphics."
>

    {{-- Page hero --}}
    <section class="relative overflow-hidden pt-36 pb-16 sm:pt-44 sm:pb-20">
        <x-hero-grid />

        <div class="relative mx-auto max-w-7xl px-5 sm:px-8">
            <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-accent">
                Graphic design &amp; branding services
            </p>
            <h1 class="reveal mt-5 max-w-4xl font-display text-[clamp(2.5rem,7vw,5.5rem)] font-extrabold leading-[1.02]" style="--reveal-delay: .1s">
                Design that makes brands <span class="text-accent">unmistakable.</span>
            </h1>
            <p class="reveal mt-8 max-w-2xl text-lg leading-relaxed text-muted" style="--reveal-delay: .2s">
                Our design team creates purposeful visual identities and campaign assets that help businesses
                communicate clearly, look credible and stay consistent across every touchpoint.
            </p>
            <div class="reveal mt-8" style="--reveal-delay: .3s">
                <a href="{{ route('contact') }}" class="group inline-flex items-center gap-3 rounded-full bg-primary px-7 py-4 font-semibold text-white transition-transform hover:scale-105">
                    Start a design project
                    <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
                </a>
            </div>
        </div>
    </section>

    {{-- Services marquee --}}
    <div class="overflow-hidden border-y border-primary/40 bg-primary py-3 text-white">
        <div class="flex w-max animate-marquee-slow gap-8 whitespace-nowrap font-display text-lg font-bold uppercase tracking-wide">
            @for ($i = 0; $i < 2; $i++)
                @foreach (['Brand Identity', 'Social Creative', 'Campaign Design', 'Print & Packaging', 'Presentations', 'Motion Graphics'] as $item)
                    <span>{{ $item }}</span><span aria-hidden="true">&#10022;</span>
                @endforeach
            @endfor
        </div>
    </div>

    {{-- Design services --}}
    <section class="mx-auto max-w-7xl px-5 py-24 sm:px-8 sm:py-32">
        <div class="max-w-2xl">
            <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-muted">What we design</p>
            <h2 class="reveal mt-4 font-display text-[clamp(2rem,5vw,4rem)] font-extrabold">
                Creative support for every stage of your brand
            </h2>
            <p class="reveal mt-5 leading-relaxed text-muted" style="--reveal-delay: .05s">
                From a new identity to an ongoing campaign, we shape the visuals your audience sees and remembers.
            </p>
        </div>

        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                ['title' => 'Logo & Brand Identity', 'desc' => 'Distinctive logos, colour systems, typography and practical brand guidelines that keep your identity consistent.'],
                ['title' => 'Social Media Creative', 'desc' => 'On-brand social posts, covers, carousels and advertising assets designed for the platforms you use.'],
                ['title' => 'Campaign Design', 'desc' => 'A unified visual direction for launches, events, promotions and marketing campaigns across every channel.'],
                ['title' => 'Print & Packaging', 'desc' => 'Business cards, brochures, flyers, signage, merchandise and packaging prepared for professional production.'],
                ['title' => 'Presentations & Reports', 'desc' => 'Clear, polished pitch decks, company profiles, proposals and reports that make complex ideas easier to understand.'],
                ['title' => 'Motion Graphics', 'desc' => 'Animated logos, promotional graphics and short-form motion assets that bring your brand to life.'],
            ] as $service)
                <article class="reveal rounded-2xl border border-line bg-panel p-8 transition-colors hover:border-accent/50" style="--reveal-delay: {{ ($loop->index % 3) * 0.08 }}s">
                    <p class="font-display text-4xl font-extrabold text-stroke">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</p>
                    <h3 class="mt-6 font-display text-xl font-bold">{{ $service['title'] }}</h3>
                    <p class="mt-3 text-sm leading-relaxed text-muted">{{ $service['desc'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    {{-- Process --}}
    <section class="border-t border-line bg-panel">
        <div class="mx-auto max-w-7xl px-5 py-24 sm:px-8 sm:py-32">
            <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">
                <div class="lg:col-span-5">
                    <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-muted">How we work</p>
                    <h2 class="reveal mt-4 font-display text-[clamp(2rem,5vw,4rem)] font-extrabold">
                        A collaborative design process
                    </h2>
                    <p class="reveal mt-5 max-w-md leading-relaxed text-muted" style="--reveal-delay: .05s">
                        You bring the goal and context. We guide the creative direction, develop the work with you and deliver assets ready to use.
                    </p>
                </div>

                <ol class="grid gap-px overflow-hidden rounded-2xl border border-line bg-line sm:grid-cols-2 lg:col-span-7">
                    @foreach ([
                        ['title' => 'Brief & discovery', 'desc' => 'We learn about your brand, audience, goals, deliverables and timeline.'],
                        ['title' => 'Creative direction', 'desc' => 'We establish the visual direction and align on the strongest concept.'],
                        ['title' => 'Design & refinement', 'desc' => 'We develop the chosen direction and refine it through structured feedback.'],
                        ['title' => 'Final delivery', 'desc' => 'You receive organized, production-ready files in the formats your team needs.'],
                    ] as $step)
                        <li class="reveal bg-ink p-7 sm:p-8" style="--reveal-delay: {{ ($loop->index % 2) * 0.08 }}s">
                            <span class="text-xs font-semibold uppercase tracking-[0.25em] text-accent">Step {{ $loop->iteration }}</span>
                            <h3 class="mt-4 font-display text-xl font-bold">{{ $step['title'] }}</h3>
                            <p class="mt-3 text-sm leading-relaxed text-muted">{{ $step['desc'] }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="border-t border-line">
        <div class="mx-auto max-w-7xl px-5 py-24 text-center sm:px-8 sm:py-32">
            <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-muted">Have a project in mind?</p>
            <h2 class="reveal mt-5 font-display text-[clamp(2rem,5vw,4rem)] font-extrabold">
                Tell us what you need <span class="text-accent">designed.</span>
            </h2>
            <p class="reveal mx-auto mt-5 max-w-xl leading-relaxed text-muted" style="--reveal-delay: .05s">
                Share your goals, required deliverables and timeline. Our team will review the brief and recommend the right next step.
            </p>
            <div class="reveal mt-8" style="--reveal-delay: .1s">
                <a href="{{ route('contact') }}" class="group inline-flex items-center gap-3 rounded-full bg-primary px-8 py-4 font-semibold text-white transition-transform hover:scale-105">
                    Brief our design team
                    <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
                </a>
            </div>
        </div>
    </section>

</x-layout>

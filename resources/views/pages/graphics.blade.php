<x-layout
    title="Create Beautiful Graphics in Seconds | Techibytes Media"
    description="Design stunning promotional graphics for your events, campaigns and business without any design experience. 100+ templates, one-click sharing, free forever."
>

    {{-- Page hero --}}
    <section class="mx-auto max-w-7xl px-5 pt-36 pb-16 sm:px-8 sm:pt-44 sm:pb-20">
        <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-accent">
            A better way to promote your events, campaigns &amp; business
        </p>
        <h1 class="reveal mt-5 max-w-4xl font-display text-[clamp(2.5rem,7vw,5.5rem)] font-extrabold leading-[1.02]" style="--reveal-delay: .1s">
            Create beautiful graphics <span class="text-accent">in seconds.</span>
        </h1>
        <p class="reveal mt-8 max-w-xl text-lg leading-relaxed text-muted" style="--reveal-delay: .2s">
            Design stunning promotional graphics for your events, campaigns, and business
            without any design experience. No credit card required.
        </p>
    </section>

    {{-- Marquee --}}
    <div class="overflow-hidden border-y border-primary/40 bg-primary py-3 text-white">
        <div class="flex w-max animate-marquee-slow gap-8 whitespace-nowrap font-display text-lg font-bold uppercase tracking-wide">
            @for ($i = 0; $i < 2; $i++)
                @foreach (['Event Flyers', 'Campaign Banners', 'Social Posts', 'Ticket Designs', 'Business Cards', 'Posters'] as $item)
                    <span>{{ $item }}</span><span aria-hidden="true">&#10022;</span>
                @endforeach
            @endfor
        </div>
    </div>

    {{-- Templates --}}
    <section class="mx-auto max-w-7xl px-5 py-24 sm:px-8 sm:py-32">
        <h2 class="reveal font-display text-[clamp(2rem,5vw,4rem)] font-extrabold">Beautiful templates for everything</h2>
        <p class="reveal mt-4 max-w-xl text-muted" style="--reveal-delay: .05s">
            Choose from hundreds of professionally designed templates.
        </p>

        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                ['icon' => '🎉', 'title' => 'Event Flyer', 'desc' => 'Professional event announcements.'],
                ['icon' => '📢', 'title' => 'Campaign Banner', 'desc' => 'Marketing campaign visuals.'],
                ['icon' => '📱', 'title' => 'Social Post', 'desc' => 'Instagram & Facebook ready.'],
                ['icon' => '🎫', 'title' => 'Ticket Design', 'desc' => 'Professional event tickets.'],
                ['icon' => '💼', 'title' => 'Business Card', 'desc' => 'Print-ready cards.'],
                ['icon' => '📄', 'title' => 'Poster', 'desc' => 'Large format promotions.'],
            ] as $template)
                <div class="reveal rounded-2xl border border-line bg-panel p-8 transition-colors hover:border-accent/50" style="--reveal-delay: {{ ($loop->index % 3) * 0.1 }}s">
                    <span class="flex h-12 w-12 items-center justify-center rounded-full bg-accent/10 text-2xl" aria-hidden="true">{{ $template['icon'] }}</span>
                    <h3 class="mt-6 font-display text-xl font-bold">{{ $template['title'] }}</h3>
                    <p class="mt-3 text-sm leading-relaxed text-muted">{{ $template['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Why choose --}}
    <section class="border-t border-line bg-panel">
        <div class="mx-auto max-w-7xl px-5 py-24 sm:px-8 sm:py-32">
            <h2 class="reveal max-w-2xl font-display text-[clamp(2rem,5vw,4rem)] font-extrabold">
                Why choose our graphics studio?
            </h2>

            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['title' => 'Create in seconds', 'desc' => 'No design experience needed. Start with beautiful templates and customize in minutes.'],
                    ['title' => 'Share instantly', 'desc' => 'Share your designs on social media, email, or download as high-quality images.'],
                    ['title' => 'Track performance', 'desc' => 'Monitor views, shares, and engagement across all your promotional materials.'],
                    ['title' => 'Collaborate', 'desc' => 'Invite team members to create and manage campaigns together in one place.'],
                ] as $feature)
                    <div class="reveal rounded-2xl border border-line bg-ink p-7 transition-colors hover:border-accent/50" style="--reveal-delay: {{ ($loop->index) * 0.1 }}s">
                        <p class="font-display text-5xl font-extrabold text-stroke">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</p>
                        <h3 class="mt-6 font-display text-xl font-bold">{{ $feature['title'] }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-muted">{{ $feature['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="border-t border-line">
        <div class="mx-auto max-w-7xl px-5 py-24 text-center sm:px-8 sm:py-32">
            <h2 class="reveal font-display text-[clamp(2rem,5vw,4rem)] font-extrabold">
                Ready to start <span class="text-accent">creating?</span>
            </h2>
            <div class="reveal mt-8" style="--reveal-delay: .1s">
                <a href="{{ route('contact') }}" class="group inline-flex items-center gap-3 rounded-full bg-primary px-8 py-4 font-semibold text-white transition-transform hover:scale-105">
                    Get in touch
                    <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
                </a>
            </div>
        </div>
    </section>

</x-layout>

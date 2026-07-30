<x-layout
    title="Best Software Development Company in Abuja, Nigeria & Seattle | Techibytes Media"
    description="Techibytes Media is the best software development company in Abuja, Nigeria, and Seattle. Expert web development, mobile app development, and digital marketing services."
>

    {{-- Hero --}}
    <section class="relative overflow-hidden pt-36 pb-20 sm:pt-44 sm:pb-28">
        <x-hero-grid />

        <div class="relative mx-auto max-w-7xl px-5 sm:px-8">
            <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-accent">
                <span class="sm:hidden">Digital Agency</span>
                <span class="hidden sm:inline">Software &middot; Design &middot; Marketing &mdash; Abuja &times; Seattle</span>
            </p>

            <h1 class="reveal mt-6 max-w-5xl font-display text-[clamp(2.75rem,8vw,6.5rem)] font-extrabold leading-[0.98] tracking-tight" style="--reveal-delay: .1s">
                We build digital products that
                <span class="text-accent">move business</span>
                forward<span class="text-accent">.</span>
            </h1>

            <div class="reveal mt-10 flex flex-col gap-10 lg:flex-row lg:items-end lg:justify-between" style="--reveal-delay: .2s">
                <p class="max-w-md text-lg leading-relaxed text-muted">
                    Techibytes Media is a full-service software development and digital marketing agency.
                    We design, engineer and grow the products behind ambitious brands across two continents.
                </p>

                <div class="flex flex-wrap items-center gap-4">
                    <a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 rounded-full bg-primary px-7 py-4 font-semibold text-white transition-transform hover:scale-105">
                        Start a project
                        <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
                    </a>
                    <a href="{{ route('portfolio') }}" class="link-draw inline-flex items-center gap-2 py-4 font-semibold text-bone">
                        See our work
                    </a>
                </div>
            </div>

            {{-- Stats --}}
            <div class="reveal mt-20 grid grid-cols-2 gap-px overflow-hidden rounded-2xl border border-line bg-line md:grid-cols-4" style="--reveal-delay: .3s">
                @foreach ([
                    ['count' => '20', 'suffix' => '+', 'label' => 'Projects delivered'],
                    ['count' => '15', 'suffix' => '+', 'label' => 'Happy clients'],
                    ['count' => '98', 'suffix' => '%', 'label' => 'Client satisfaction'],
                    ['count' => '24', 'suffix' => '/7', 'label' => 'Support available'],
                ] as $stat)
                    <div class="bg-panel p-6 sm:p-8">
                        <p class="font-display text-4xl font-extrabold text-accent sm:text-5xl">
                            <span data-count="{{ $stat['count'] }}">0</span>{{ $stat['suffix'] }}
                        </p>
                        <p class="mt-2 text-sm text-muted">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Scroll indicator --}}
        <div class="reveal mt-16 flex justify-center" style="--reveal-delay: .4s" aria-hidden="true">
            <div class="flex flex-col items-center gap-2 text-muted">
                <span class="text-[0.65rem] font-semibold uppercase tracking-[0.3em]">Scroll</span>
                <span class="h-10 w-px animate-pulse bg-gradient-to-b from-accent to-transparent"></span>
            </div>
        </div>
    </section>

    @php
        $trustedClients = [
            ['name' => 'Bills Waka', 'logo' => 'images/work-done-logos/bills-waka-logo.png', 'width' => 192, 'height' => 192],
            ['name' => 'Scholarly', 'logo' => 'images/work-done-logos/scholarly_logo.png', 'width' => 250, 'height' => 48],
            ['name' => 'Sendbit', 'logo' => 'images/work-done-logos/sendbit-logo.png', 'width' => 300, 'height' => 300],
            ['name' => 'TopFreshCuts', 'logo' => 'images/work-done-logos/topfreshcuts-logo.png', 'width' => 500, 'height' => 500],
            ['name' => "St. Michael's AFH", 'logo' => 'images/work-done-logos/st-michaels-logo.png', 'width' => 1254, 'height' => 1254],
            ['name' => 'HO Fashion Hub', 'logo' => 'images/work-done-logos/hofashionhub-logo.png', 'width' => 1058, 'height' => 562],
            ['name' => 'Build Nigeria Initiative', 'logo' => 'images/work-done-logos/ibuildinitiative-logo.png', 'width' => 264, 'height' => 302],
        ];
    @endphp

    {{-- Trusted by --}}
    <section class="border-t border-line py-10">
        <div class="mx-auto flex max-w-7xl flex-col items-center gap-6 px-5 sm:px-8">
            <p class="text-center text-[0.65rem] font-semibold uppercase tracking-[0.3em] text-muted">Trusted by teams across fintech, education, healthcare, fashion &amp; lifestyle</p>

            <div data-testid="trusted-client-logos" class="grid w-full grid-cols-2 gap-3 sm:hidden">
                @foreach ($trustedClients as $client)
                    <div class="flex h-24 items-center justify-center rounded-xl border border-line bg-panel px-4 py-3">
                        <img
                            src="{{ asset($client['logo']) }}"
                            alt="{{ $client['name'] }} logo"
                            width="{{ $client['width'] }}"
                            height="{{ $client['height'] }}"
                            loading="lazy"
                            decoding="async"
                            class="max-h-16 max-w-full object-contain opacity-80"
                        >
                    </div>
                @endforeach
            </div>

            <div class="hidden w-full overflow-hidden sm:block [mask-image:linear-gradient(to_right,transparent,black_15%,black_85%,transparent)]">
                <div class="flex w-max animate-marquee-slow items-center">
                    @for ($i = 0; $i < 2; $i++)
                        <div class="flex shrink-0 items-center gap-5 pr-5">
                            @foreach ($trustedClients as $client)
                                <div class="flex h-24 w-52 shrink-0 items-center justify-center rounded-xl border border-line bg-panel px-6 py-4">
                                    <img
                                        src="{{ asset($client['logo']) }}"
                                        alt="{{ $i === 0 ? $client['name'].' logo' : '' }}"
                                        width="{{ $client['width'] }}"
                                        height="{{ $client['height'] }}"
                                        loading="lazy"
                                        decoding="async"
                                        class="max-h-16 max-w-full object-contain opacity-70 transition-opacity hover:opacity-100"
                                    >
                                </div>
                            @endforeach
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>

    {{-- Marquee ticker --}}
    <div class="overflow-hidden border-y border-primary/40 bg-primary py-3 text-white">
        <div class="flex w-max animate-marquee gap-8 whitespace-nowrap font-display text-lg font-bold uppercase tracking-wide">
            @for ($i = 0; $i < 2; $i++)
                @foreach (['Web Development', 'Mobile Apps', 'UI/UX Design', 'Digital Marketing', 'SEO', 'Branding & Graphics'] as $item)
                    <span>{{ $item }}</span><span aria-hidden="true">&#10022;</span>
                @endforeach
            @endfor
        </div>
    </div>

    {{-- About statement --}}
    <section class="mx-auto max-w-7xl px-5 py-24 sm:px-8 sm:py-32">
        <div class="grid gap-12 lg:grid-cols-12">
            <div class="lg:col-span-3">
                <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-muted">
                    <span class="text-accent">01</span> &mdash; The agency
                </p>
            </div>
            <div class="lg:col-span-9">
                <h2 class="reveal font-display text-[clamp(1.75rem,4vw,3.25rem)] font-bold leading-tight">
                    We handle digital challenges our own way &mdash; with strategy first, obsessive craft,
                    and engineering that holds up in the real world.
                </h2>
                <div class="reveal mt-10 grid gap-8 sm:grid-cols-2" style="--reveal-delay: .15s">
                    <p class="leading-relaxed text-muted">
                        Founded in Abuja in 2020, Techibytes Media has grown into a two-continent team
                        serving startups, SMEs and public organisations. From first sketch to launch day,
                        one team owns the whole journey.
                    </p>
                    <p class="leading-relaxed text-muted">
                        Whether it's a marketing site that converts, a mobile app your customers love, or a
                        search strategy that puts you on page one &mdash; we measure our work by the growth
                        it creates for yours.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Services list --}}
    <section class="border-t border-line">
        <div class="mx-auto max-w-7xl px-5 py-24 sm:px-8 sm:py-32">
            <div class="mb-14 flex flex-wrap items-end justify-between gap-6">
                <div>
                    <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-muted">
                        <span class="text-accent">02</span> &mdash; What we do
                    </p>
                    <h2 class="reveal mt-4 font-display text-[clamp(2rem,5vw,4rem)] font-extrabold">Services</h2>
                </div>
                <a href="{{ route('services') }}" class="reveal link-draw pb-1 font-semibold text-bone">All services &rarr;</a>
            </div>

            <div class="divide-y divide-line border-y border-line">
                @foreach ([
                    ['no' => '01', 'title' => 'Web Development', 'desc' => 'Fast, secure, search-friendly websites and web apps built on modern stacks.', 'tags' => 'Laravel · React · TypeScript'],
                    ['no' => '02', 'title' => 'Mobile App Development', 'desc' => 'Native-quality iOS and Android apps that users keep coming back to.', 'tags' => 'iOS · Android · Cross-platform'],
                    ['no' => '03', 'title' => 'UI/UX Design', 'desc' => 'Research-driven interfaces designed to convert, delight and retain.', 'tags' => 'Product design · Prototyping'],
                    ['no' => '04', 'title' => 'Digital Marketing', 'desc' => 'Campaigns across search and social that turn attention into revenue.', 'tags' => 'PPC · Social · Content'],
                    ['no' => '05', 'title' => 'SEO', 'desc' => 'Technical and content SEO that puts your brand on page one and keeps it there.', 'tags' => 'Technical SEO · Local SEO'],
                    ['no' => '06', 'title' => 'Branding & Graphics', 'desc' => 'Identities, graphics and campaign visuals that make brands unmistakable.', 'tags' => 'Identity · Print · Motion'],
                    ['no' => '07', 'title' => 'Strategy & Publications', 'desc' => 'Data-driven strategy and publications across top blogs and media that drive sustainable growth.', 'tags' => 'Strategy · PR · Media'],
                ] as $service)
                    <a href="{{ route('services') }}" class="group reveal grid gap-3 py-8 transition-colors sm:grid-cols-12 sm:items-center sm:gap-6">
                        <span class="font-display text-sm font-bold text-muted sm:col-span-1">{{ $service['no'] }}</span>
                        <h3 class="font-display text-2xl font-bold transition-colors group-hover:text-accent sm:col-span-4 sm:text-3xl">
                            {{ $service['title'] }}
                        </h3>
                        <p class="text-sm leading-relaxed text-muted sm:col-span-4">{{ $service['desc'] }}</p>
                        <p class="text-xs uppercase tracking-widest text-muted/70 sm:col-span-2">{{ $service['tags'] }}</p>
                        <span class="hidden text-2xl text-muted transition-all group-hover:translate-x-2 group-hover:text-accent sm:col-span-1 sm:block sm:text-right" aria-hidden="true">&rarr;</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Selected work --}}
    <section class="border-t border-line">
        @php
            $recentProjects = collect(config('projects.items'))
                ->filter(fn (array $project): bool => $project['recent'] ?? false)
                ->take((int) config('projects.recent_limit', 4));
        @endphp

        <div class="mx-auto max-w-7xl px-5 py-24 sm:px-8 sm:py-32">
            <div class="mb-14 flex flex-wrap items-end justify-between gap-6">
                <div>
                    <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-muted">
                        <span class="text-accent">03</span> &mdash; Selected work
                    </p>
                    <h2 class="reveal mt-4 font-display text-[clamp(2rem,5vw,4rem)] font-extrabold">Recent projects</h2>
                </div>
                <a href="{{ route('portfolio') }}" class="reveal link-draw pb-1 font-semibold text-bone">View all work &rarr;</a>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($recentProjects as $project)
                    <a href="{{ $project['url'] }}" target="_blank" rel="noopener noreferrer" @class(['group reveal block', 'md:mt-16' => $loop->index % 2 === 1])>
                        <div class="relative aspect-[4/3] overflow-hidden rounded-2xl border border-line bg-panel">
                            <img
                                src="{{ asset($project['screenshot']) }}"
                                alt="{{ $project['name'] }} website homepage"
                                width="1440"
                                height="1080"
                                loading="lazy"
                                decoding="async"
                                class="absolute inset-0 h-full w-full object-cover object-top transition-transform duration-500 ease-out group-hover:scale-[1.02] motion-reduce:transform-none motion-reduce:transition-none"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-ink/35 via-transparent to-transparent"></div>
                            <span class="absolute right-5 top-5 flex h-11 w-11 items-center justify-center rounded-full bg-bone/10 text-lg opacity-0 backdrop-blur transition-opacity group-hover:opacity-100" aria-hidden="true">&nearr;</span>
                            <span class="absolute bottom-5 left-5 font-display text-6xl font-extrabold text-stroke opacity-60">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                        <div class="mt-5 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between sm:gap-4">
                            <h3 class="font-display text-xl font-bold transition-colors group-hover:text-accent sm:text-2xl">{{ $project['title'] }}</h3>
                            <p class="text-xs uppercase tracking-widest text-muted sm:shrink-0">{{ $project['tags'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Process --}}
    <section class="border-t border-line bg-panel">
        <div class="mx-auto max-w-7xl px-5 py-24 sm:px-8 sm:py-32">
            <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-muted">
                <span class="text-accent">04</span> &mdash; How we work
            </p>
            <h2 class="reveal mt-4 max-w-2xl font-display text-[clamp(2rem,5vw,4rem)] font-extrabold">
                A process built for momentum
            </h2>

            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['step' => '01', 'title' => 'Discover', 'desc' => 'We dig into your goals, market and users, then agree on what success looks like.'],
                    ['step' => '02', 'title' => 'Design', 'desc' => 'Wireframes become polished, tested interfaces your customers actually understand.'],
                    ['step' => '03', 'title' => 'Develop', 'desc' => 'Clean, scalable engineering with weekly demos — no black boxes, no surprises.'],
                    ['step' => '04', 'title' => 'Launch & grow', 'desc' => 'We ship, measure and iterate — SEO, campaigns and support that compound results.'],
                ] as $phase)
                    <div class="reveal rounded-2xl border border-line bg-ink p-7 transition-colors hover:border-accent/50" style="--reveal-delay: {{ ($loop->index) * 0.1 }}s">
                        <p class="font-display text-5xl font-extrabold text-stroke">{{ $phase['step'] }}</p>
                        <h3 class="mt-6 font-display text-xl font-bold">{{ $phase['title'] }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-muted">{{ $phase['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Founders --}}
    <section class="border-t border-line">
        <div class="mx-auto max-w-7xl px-5 py-24 sm:px-8 sm:py-32">
            <div class="mb-14 flex flex-wrap items-end justify-between gap-6">
                <div>
                    <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-muted">
                        <span class="text-accent">05</span> &mdash; The team
                    </p>
                    <h2 class="reveal mt-4 font-display text-[clamp(2rem,5vw,4rem)] font-extrabold">The people behind the work</h2>
                </div>
                <p class="reveal max-w-sm text-sm leading-relaxed text-muted">
                    Meet the co-founders guiding the strategy, technology and creative direction behind Techibytes Media.
                </p>
            </div>

            <div data-testid="founders-grid" class="mx-auto grid max-w-4xl gap-8 sm:grid-cols-2">
                @foreach ([
                    ['name' => 'Elijah Erigbemi', 'role' => 'Co-founder', 'photo' => 'images/founders/Elijah Erigbemi.jpeg', 'width' => 2345, 'height' => 3518],
                    ['name' => 'Jude Obiejesi', 'role' => 'Co-founder', 'photo' => 'images/founders/Jude Obiejesi.jpg', 'width' => 958, 'height' => 960],
                ] as $founder)
                    <article data-testid="founder-card" class="group reveal" style="--reveal-delay: {{ ($loop->index) * 0.08 }}s">
                        <div class="relative aspect-[4/5] overflow-hidden rounded-2xl border border-line bg-panel">
                            <img
                                src="{{ asset($founder['photo']) }}"
                                alt="Portrait of {{ $founder['name'] }}, {{ $founder['role'] }} of Techibytes Media"
                                width="{{ $founder['width'] }}"
                                height="{{ $founder['height'] }}"
                                loading="lazy"
                                decoding="async"
                                class="h-full w-full object-cover object-top transition-transform duration-500 ease-out group-hover:scale-[1.02] motion-reduce:transform-none motion-reduce:transition-none"
                            >
                        </div>
                        <div class="mt-5 flex items-start justify-between gap-4 border-t border-line pt-4">
                            <h3 class="font-display text-xl font-bold transition-colors group-hover:text-accent">{{ $founder['name'] }}</h3>
                            <p class="shrink-0 text-xs font-semibold uppercase tracking-[0.16em] text-muted">{{ $founder['role'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="border-t border-line">
        <div class="mx-auto max-w-7xl px-5 py-24 sm:px-8 sm:py-32">
            <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-muted">
                <span class="text-accent">06</span> &mdash; Kind words
            </p>
            <h2 class="reveal mt-4 font-display text-[clamp(2rem,5vw,4rem)] font-extrabold">Clients talk</h2>

            <div class="mt-14 grid gap-6 lg:grid-cols-3">
                @foreach ([
                    ['quote' => 'Techibytes Media transformed our online presence completely. Their attention to detail and understanding of our business goals resulted in a website that truly represents our brand.', 'name' => 'Uche Umeh', 'role' => 'CEO, Scholarly Africa'],
                    ['quote' => 'Working with this team was an absolute pleasure. They delivered beyond our expectations and provided valuable insights that helped us achieve a 200% increase in conversions.', 'name' => 'Oge Destiny', 'role' => 'CEO, Billswaka App'],
                    ['quote' => 'The level of professionalism and creativity is unmatched. Our new e-commerce platform is not only beautiful but also incredibly functional. Sales have increased by 150% since launch.', 'name' => 'Justice Kay', 'role' => 'Founder, Value Lead Africa'],
                ] as $testimonial)
                    <figure class="reveal flex flex-col justify-between rounded-2xl border border-line bg-panel p-8" style="--reveal-delay: {{ ($loop->index) * 0.1 }}s">
                        <div>
                            <div class="flex items-center justify-between">
                                <span class="font-display text-5xl font-extrabold leading-none text-accent" aria-hidden="true">&ldquo;</span>
                                <span class="text-sm tracking-[0.2em] text-accent" role="img" aria-label="Rated 5 out of 5 stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                            </div>
                            <blockquote class="mt-2 leading-relaxed text-bone/90">{{ $testimonial['quote'] }}</blockquote>
                        </div>
                        <figcaption class="mt-8 border-t border-line pt-5">
                            <p class="font-semibold">{{ $testimonial['name'] }}</p>
                            <p class="text-sm text-muted">{{ $testimonial['role'] }}</p>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Big CTA --}}
    <section class="relative overflow-hidden bg-primary text-white">
        {{-- Grid-box background graphic, dark variant: grid at the edges, clear behind the copy --}}
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 bg-top-right bg-[size:56px_56px] bg-[image:linear-gradient(to_right,rgb(255_255_255/0.07)_1px,transparent_1px),linear-gradient(to_bottom,rgb(255_255_255/0.07)_1px,transparent_1px)] [mask-image:radial-gradient(ellipse_65%_65%_at_50%_50%,transparent_30%,black_80%)]"></div>
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 hidden sm:block">
            <span class="absolute top-14 left-28 h-14 w-14 bg-accent-soft/15"></span>
            <span class="absolute top-28 left-14 h-14 w-14 bg-white/5"></span>
            <span class="absolute top-42 right-14 h-14 w-14 border border-accent-soft/25"></span>
            <span class="absolute bottom-28 right-28 h-14 w-14 bg-accent-soft/15"></span>
            <span class="absolute bottom-14 left-42 h-14 w-14 bg-white/5"></span>
        </div>

        <div class="relative mx-auto max-w-7xl px-5 py-28 text-center sm:px-8 sm:py-40">
            <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-accent-soft">Got an idea?</p>
            <h2 class="reveal mt-6 font-display text-[clamp(2.5rem,7vw,5.5rem)] font-extrabold leading-[1.02]" style="--reveal-delay: .1s">
                Let's make something<br>
                <span class="text-accent-soft">great together.</span>
            </h2>
            <div class="reveal mt-10" style="--reveal-delay: .2s">
                <a href="{{ route('contact') }}" class="group inline-flex items-center gap-3 rounded-full bg-white px-9 py-5 text-lg font-semibold text-primary transition-transform hover:scale-105">
                    Book a free consultation
                    <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
                </a>
            </div>
        </div>
    </section>

</x-layout>

<x-layout
    title="Our Services — Web, Mobile, Design & Marketing | Techibytes Media"
    description="Web development, mobile app development, UI/UX design, digital marketing, SEO and branding services from Techibytes Media in Abuja, Nigeria and Seattle, USA."
>

    {{-- Page hero --}}
    <section class="relative overflow-hidden pt-36 pb-16 sm:pt-44 sm:pb-20">
        <x-hero-grid />

        <div class="relative mx-auto max-w-7xl px-5 sm:px-8">
            <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-accent">Services</p>
            <h1 class="reveal mt-5 max-w-4xl font-display text-[clamp(2.5rem,7vw,5.5rem)] font-extrabold leading-[1.02]" style="--reveal-delay: .1s">
                Everything your brand needs to win <span class="text-accent">online.</span>
            </h1>
            <p class="reveal mt-8 max-w-xl text-lg leading-relaxed text-muted" style="--reveal-delay: .2s">
                One team, seven disciplines. Mix and match — or hand us the whole journey from idea to growth.
            </p>
        </div>
    </section>

    {{-- Service detail blocks --}}
    <section class="border-t border-line">
        <div class="mx-auto max-w-7xl divide-y divide-line px-5 sm:px-8">
            @foreach ([
                [
                    'no' => '01',
                    'title' => 'Web Development',
                    'lead' => 'Build your digital foundation.',
                    'body' => 'Best web development services in Abuja, Nigeria & Seattle. We create powerful, scalable websites and web applications that drive business growth.',
                    'tech' => ['Laravel', 'PHP', 'React', 'Next.js', 'Node.js', 'TypeScript', 'Tailwind CSS', 'WordPress', 'And many more'],
                    'items' => ['Custom website development', 'E-commerce solutions', 'Progressive Web Apps (PWA)', 'API integration & development', 'CMS development (WordPress, Strapi)', 'Performance optimization'],
                ],
                [
                    'no' => '02',
                    'title' => 'Mobile App Development',
                    'lead' => 'Reach users everywhere.',
                    'body' => 'Expert mobile app development in Abuja and Nigeria. Native and cross-platform mobile solutions that engage users and deliver exceptional experiences.',
                    'tech' => ['React Native', 'Flutter', 'Dart', 'Swift', 'Kotlin', 'Firebase', 'Expo', 'And many more'],
                    'items' => ['iOS app development', 'Android app development', 'Cross-platform development', 'App Store optimization', 'Push notifications', 'Offline functionality'],
                ],
                [
                    'no' => '03',
                    'title' => 'Digital Marketing',
                    'lead' => 'Amplify your brand.',
                    'body' => 'Top digital marketing company in Abuja and Nigeria. Data-driven campaigns that increase visibility, generate leads, and drive conversions.',
                    'tech' => ['Google Ads', 'Meta Ads', 'LinkedIn Ads', 'TikTok Ads', 'HubSpot', 'Mailchimp', 'Google Tag Manager', 'And many more'],
                    'items' => ['Social media marketing', 'Content marketing', 'Email marketing campaigns', 'Pay-Per-Click (PPC) advertising', 'Brand strategy & positioning', 'Analytics & reporting'],
                ],
                [
                    'no' => '04',
                    'title' => 'SEO Optimization',
                    'lead' => 'Dominate search rankings.',
                    'body' => 'Strategic SEO services that improve your search rankings, drive organic traffic, and increase conversions for businesses in Abuja and Nigeria.',
                    'tech' => ['SEMrush', 'Ahrefs', 'Google Analytics', 'Search Console', 'Screaming Frog', 'Google Business Profile', 'Looker Studio', 'And many more'],
                    'items' => ['Technical SEO audits', 'Keyword research & strategy', 'On-page optimization', 'Link building', 'Local SEO', 'SEO content creation'],
                ],
                [
                    'no' => '05',
                    'title' => 'UI/UX Design',
                    'lead' => 'Design that converts.',
                    'body' => 'Beautiful, intuitive designs that captivate users and create memorable digital experiences that drive engagement and conversions.',
                    'tech' => ['Figma', 'FigJam', 'Adobe Illustrator', 'Adobe Photoshop', 'Framer', 'ProtoPie', 'And many more'],
                    'items' => ['User research & testing', 'Wireframing & prototyping', 'Visual design', 'Design systems', 'Responsive design', 'Accessibility design'],
                ],
                [
                    'no' => '06',
                    'title' => 'Digital Strategy & Publications',
                    'lead' => 'Strategic growth.',
                    'body' => 'Data-driven strategies and online publications across top blogs and media platforms that drive sustainable business growth.',
                    'tech' => ['Google Analytics', 'Looker Studio', 'Tableau', 'HubSpot', 'Hotjar', 'Mixpanel', 'Notion', 'And many more'],
                    'items' => ['Digital transformation strategy', 'Market research & analysis', 'Content strategy', 'Media publications', 'Growth hacking', 'Performance tracking'],
                ],
                [
                    'no' => '07',
                    'title' => 'Branding & Graphics',
                    'lead' => 'Identities and visuals that make your brand unmistakable everywhere it shows up.',
                    'body' => 'Logos, brand systems, campaign creative, print and motion. Every asset drawn from one coherent identity, ready for web, social and the real world.',
                    'tech' => ['Adobe Illustrator', 'Adobe Photoshop', 'Adobe InDesign', 'After Effects', 'Figma', 'Canva', 'And many more'],
                    'items' => ['Logo & identity design', 'Brand guidelines', 'Social & campaign creative', 'Print & packaging', 'Motion graphics'],
                ],
            ] as $service)
                <article class="grid gap-8 py-16 sm:py-20 lg:grid-cols-12">
                    <div class="reveal lg:col-span-5">
                        <p class="font-display text-6xl font-extrabold text-stroke">{{ $service['no'] }}</p>
                        <h2 class="mt-4 font-display text-3xl font-bold sm:text-4xl">{{ $service['title'] }}</h2>
                        <p class="mt-4 text-lg text-accent">{{ $service['lead'] }}</p>
                    </div>
                    <div class="reveal lg:col-span-4" style="--reveal-delay: .1s">
                        <p class="leading-relaxed text-muted">{{ $service['body'] }}</p>
                        @if ($service['tech'] !== [])
                            <p class="mt-8 text-[0.65rem] font-semibold uppercase tracking-[0.3em] text-muted">Technologies we use</p>
                            <ul class="mt-4 flex flex-wrap gap-2">
                                @foreach ($service['tech'] as $tool)
                                    <li @class([
                                        'rounded-full border px-3 py-1.5 text-xs font-medium',
                                        'border-line bg-panel text-bone/85' => ! $loop->last,
                                        'border-accent/30 bg-accent/5 text-accent' => $loop->last,
                                    ])>{{ $tool }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="reveal lg:col-span-3" style="--reveal-delay: .2s">
                        <ul class="space-y-3 text-sm">
                            @foreach ($service['items'] as $item)
                                <li class="flex gap-3 border-b border-line pb-3">
                                    <span class="text-accent" aria-hidden="true">&#10022;</span>
                                    <span class="text-bone/85">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- Why choose us --}}
    <section class="border-t border-line">
        <div class="mx-auto max-w-7xl px-5 py-24 sm:px-8 sm:py-32">
            <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-muted">Why Techibytes</p>
            <h2 class="reveal mt-4 max-w-2xl font-display text-[clamp(2rem,5vw,4rem)] font-extrabold">
                Why choose Techibytes Media?
            </h2>

            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['title' => 'Results-driven', 'desc' => 'We focus on delivering measurable results that impact your bottom line.'],
                    ['title' => 'Fast delivery', 'desc' => 'An agile development process ensures quick turnaround without compromising quality.'],
                    ['title' => 'Expert team', 'desc' => 'Experienced professionals with proven track records across industries.'],
                    ['title' => 'Cutting-edge tech', 'desc' => 'We use the latest technologies to keep you ahead of the competition.'],
                ] as $reason)
                    <div class="reveal rounded-2xl border border-line bg-panel p-7 transition-colors hover:border-accent/50" style="--reveal-delay: {{ ($loop->index) * 0.1 }}s">
                        <p class="font-display text-5xl font-extrabold text-stroke">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</p>
                        <h3 class="mt-6 font-display text-xl font-bold">{{ $reason['title'] }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-muted">{{ $reason['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="border-t border-line bg-panel">
        <div class="mx-auto max-w-7xl px-5 py-24 sm:px-8 sm:py-32">
            <div class="grid gap-12 lg:grid-cols-12">
                <div class="lg:col-span-5">
                    <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-muted">FAQ</p>
                    <h2 class="reveal mt-4 font-display text-[clamp(2rem,5vw,3.5rem)] font-extrabold">
                        Questions, answered
                    </h2>
                    <p class="reveal mt-6 max-w-sm leading-relaxed text-muted">
                        Something else on your mind?
                        <a href="{{ route('contact') }}" class="link-draw text-accent">Ask us directly</a> — we reply within 1 to 4 business days.
                    </p>
                </div>

                <div class="reveal lg:col-span-7" style="--reveal-delay: .15s">
                    <div class="divide-y divide-line border-y border-line">
                        @foreach ([
                            ['q' => 'How much does a project cost?', 'a' => 'It depends on scope. Marketing websites typically start smaller, while custom apps and platforms are quoted after a discovery call. Every project gets a fixed, itemised proposal before we begin — no surprise invoices.'],
                            ['q' => 'How long does a typical project take?', 'a' => 'A marketing website usually ships in 3–6 weeks. Mobile apps and custom platforms typically run 2–4 months depending on complexity. We work in weekly milestones so you always see progress.'],
                            ['q' => 'Do you work with clients outside Nigeria and the US?', 'a' => 'Yes. With teams in Abuja and Seattle we already work across time zones daily, and we serve clients wherever they are.'],
                            ['q' => 'Do you offer support after launch?', 'a' => 'Every build includes a post-launch support window, and most clients continue on a monthly care plan covering updates, security, backups and small improvements.'],
                            ['q' => 'Can you take over an existing website or app?', 'a' => 'Absolutely. We start with a technical audit, stabilise what is there, then agree a roadmap for improvements — no forced rebuilds unless the foundations genuinely require it.'],
                        ] as $faq)
                            <details class="group py-5">
                                <summary class="flex cursor-pointer list-none items-center justify-between gap-6 font-display text-lg font-bold [&::-webkit-details-marker]:hidden">
                                    {{ $faq['q'] }}
                                    <span class="shrink-0 text-2xl text-accent transition-transform group-open:rotate-45" aria-hidden="true">+</span>
                                </summary>
                                <p class="mt-4 max-w-xl leading-relaxed text-muted">{{ $faq['a'] }}</p>
                            </details>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="border-t border-line">
        <div class="mx-auto max-w-7xl px-5 py-24 text-center sm:px-8 sm:py-32">
            <h2 class="reveal font-display text-[clamp(2rem,5vw,4rem)] font-extrabold">
                Not sure where to start? <span class="text-accent">Talk to us.</span>
            </h2>
            <div class="reveal mt-8" style="--reveal-delay: .1s">
                <a href="{{ route('contact') }}" class="group inline-flex items-center gap-3 rounded-full bg-primary px-8 py-4 font-semibold text-white transition-transform hover:scale-105">
                    Book a free consultation
                    <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
                </a>
            </div>
        </div>
    </section>

</x-layout>

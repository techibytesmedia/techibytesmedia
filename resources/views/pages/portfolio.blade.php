<x-layout
    title="Our Work & Portfolio | Techibytes Media"
    description="Selected projects by Techibytes Media — websites, mobile apps, platforms and brands built for clients in Nigeria, the USA and beyond."
>

    {{-- Page hero --}}
    <section class="mx-auto max-w-7xl px-5 pt-36 pb-16 sm:px-8 sm:pt-44 sm:pb-20">
        <p class="reveal text-xs font-semibold uppercase tracking-[0.35em] text-accent">Portfolio</p>
        <h1 class="reveal mt-5 max-w-4xl font-display text-[clamp(2.5rem,7vw,5.5rem)] font-extrabold leading-[1.02]" style="--reveal-delay: .1s">
            Work that <span class="text-accent">works.</span>
        </h1>
        <p class="reveal mt-8 max-w-xl text-lg leading-relaxed text-muted" style="--reveal-delay: .2s">
            Explore our latest projects and see how we've helped businesses build their
            creative ideas into innovative products.
        </p>
    </section>

    {{-- Projects grid --}}
    <section class="border-t border-line">
        <div class="mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-28">
            <div class="grid gap-x-6 gap-y-16 md:grid-cols-2">
                @foreach ([
                    ['title' => 'Billswaka', 'sector' => 'Fintech', 'tags' => 'Mobile app · Web development', 'result' => 'Create virtual dollar cards and make payments with ease.', 'from' => '#dce9f4', 'to' => '#2f7fc4'],
                    ['title' => 'Scholarly', 'sector' => 'Education', 'tags' => 'Web development', 'result' => 'A leading educational technology company based in Nigeria with over 3m users.', 'from' => '#fdeade', 'to' => '#e07a2e'],
                    ['title' => 'Sendbit', 'sector' => 'Payments', 'tags' => 'App · Web development', 'result' => 'Accept payments around the globe through invoices, PayPal and international accounts (USD, GBP, EURO) — and swap crypto to naira and other local currencies.', 'from' => '#e0f0ea', 'to' => '#2fa886'],
                ] as $project)
                    <article @class(['group reveal', 'md:mt-20' => $loop->index % 2 === 1, 'md:-mt-20' => $loop->index % 2 === 0 && ! $loop->first])>
                        <div class="relative aspect-[4/3] overflow-hidden rounded-2xl border border-line">
                            <div
                                class="absolute inset-0 transition-transform duration-700 group-hover:scale-105"
                                style="background: radial-gradient(120% 120% at 20% 20%, {{ $project['to'] }}33 0%, transparent 55%), linear-gradient(135deg, {{ $project['from'] }} 0%, var(--color-panel) 70%)"
                            ></div>
                            <span class="absolute left-5 top-5 rounded-full border border-bone/20 bg-ink/40 px-4 py-1.5 text-xs font-medium uppercase tracking-widest backdrop-blur">
                                {{ $project['sector'] }}
                            </span>
                            <span class="absolute bottom-5 left-5 font-display text-6xl font-extrabold text-stroke opacity-60">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                        <div class="mt-5">
                            <div class="flex items-start justify-between gap-4">
                                <h2 class="font-display text-xl font-bold transition-colors group-hover:text-accent sm:text-2xl">{{ $project['title'] }}</h2>
                                <p class="shrink-0 pt-1 text-xs uppercase tracking-widest text-muted">{{ $project['tags'] }}</p>
                            </div>
                            <p class="mt-2 text-sm text-muted"><span class="text-accent">&#10022;</span> {{ $project['result'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="border-t border-line bg-panel">
        <div class="mx-auto max-w-7xl px-5 py-24 text-center sm:px-8 sm:py-32">
            <h2 class="reveal font-display text-[clamp(2rem,5vw,4rem)] font-extrabold">
                Your project could be <span class="text-accent">next.</span>
            </h2>
            <div class="reveal mt-8" style="--reveal-delay: .1s">
                <a href="{{ route('contact') }}" class="group inline-flex items-center gap-3 rounded-full bg-primary px-8 py-4 font-semibold text-white transition-transform hover:scale-105">
                    Start a project
                    <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
                </a>
            </div>
        </div>
    </section>

</x-layout>

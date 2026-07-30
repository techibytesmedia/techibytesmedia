@props([
    'eyebrow',
    'title',
    'summary',
    'effectiveDate',
    'sections' => [],
])

<section class="relative overflow-hidden border-b border-line pt-36 pb-16 sm:pt-44 sm:pb-20">
    <x-hero-grid />

    <div class="relative mx-auto max-w-5xl px-5 sm:px-8">
        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-accent">{{ $eyebrow }}</p>
        <h1 class="mt-5 max-w-4xl font-display text-4xl font-extrabold tracking-tight sm:text-6xl">{{ $title }}</h1>
        <p class="mt-6 max-w-3xl text-lg leading-relaxed text-muted">{{ $summary }}</p>
        <p class="mt-6 text-sm font-semibold text-bone">Effective date: {{ $effectiveDate }}</p>
    </div>
</section>

<section class="py-16 sm:py-20">
    <div class="mx-auto grid max-w-7xl gap-12 px-5 sm:px-8 lg:grid-cols-[16rem_minmax(0,1fr)]">
        <aside>
            <nav aria-label="{{ $title }} sections" class="rounded-2xl border border-line bg-panel p-6 lg:sticky lg:top-28">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-muted">On this page</p>
                <ol class="mt-5 space-y-3 text-sm">
                    @foreach ($sections as $section)
                        <li>
                            <a href="#{{ $section['id'] }}" class="text-muted transition-colors hover:text-accent">
                                {{ $section['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ol>
            </nav>
        </aside>

        <article data-testid="legal-content" class="min-w-0 space-y-12 text-base leading-8 text-bone/85">
            {{ $slot }}
        </article>
    </div>
</section>
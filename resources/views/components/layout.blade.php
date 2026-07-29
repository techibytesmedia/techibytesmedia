@props([
    'title' => 'Techibytes Media — Software Development & Digital Marketing Agency',
    'description' => 'Techibytes Media is a software development and digital marketing agency in Abuja, Nigeria and Seattle, USA. Web development, mobile apps, UI/UX design, SEO and branding.',
    'canonical' => null,
    'image' => null,
])

@php
    $siteUrl = rtrim((string) config('app.url'), '/');
    $canonicalUrl = $canonical ?? $siteUrl.(request()->getPathInfo() === '/' ? '/' : request()->getPathInfo());
    $socialImageUrl = $image ?? $siteUrl.'/images/logo/logo-background.png';
    $organizationId = $siteUrl.'/#organization';
    $websiteId = $siteUrl.'/#website';

    $structuredData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                '@id' => $organizationId,
                'name' => 'Techibytes Media',
                'legalName' => 'Techibytes Media LLC',
                'url' => $siteUrl.'/',
                'logo' => $siteUrl.'/images/logo/logo-background.png',
                'description' => 'A software development and digital marketing agency serving clients from Abuja, Nigeria and Seattle, USA.',
                'email' => 'info@techibytesmedia.com',
                'telephone' => '+2349031807262',
                'contactPoint' => [
                    [
                        '@type' => 'ContactPoint',
                        'telephone' => '+2349031807262',
                        'contactType' => 'customer service',
                        'areaServed' => 'NG',
                        'availableLanguage' => 'en',
                    ],
                    [
                        '@type' => 'ContactPoint',
                        'telephone' => '+12065786373',
                        'contactType' => 'customer service',
                        'areaServed' => 'US',
                        'availableLanguage' => 'en',
                    ],
                ],
                'sameAs' => [
                    'https://www.facebook.com/techibytesmedia',
                    'https://x.com/techibytes_hq',
                    'https://www.instagram.com/techibytes',
                    'https://www.linkedin.com/company/techibytesmedia',
                ],
                'address' => [
                    [
                        '@type' => 'PostalAddress',
                        'streetAddress' => 'Suite 303, 3rd Floor, Ammah Plaza, Near NAF Conference Center',
                        'addressLocality' => 'Abuja',
                        'addressCountry' => 'NG',
                    ],
                    [
                        '@type' => 'PostalAddress',
                        'streetAddress' => '600 1st Ave, Ste 102 #1105',
                        'addressLocality' => 'Seattle',
                        'addressRegion' => 'WA',
                        'postalCode' => '98104',
                        'addressCountry' => 'US',
                    ],
                ],
            ],
            [
                '@type' => 'WebSite',
                '@id' => $websiteId,
                'url' => $siteUrl.'/',
                'name' => 'Techibytes Media',
                'publisher' => ['@id' => $organizationId],
                'inLanguage' => 'en',
            ],
        ],
    ];
@endphp

<!doctype html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="author" content="Techibytes Media">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ $canonicalUrl }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:site_name" content="Techibytes Media">
    <meta property="og:locale" content="en_US">
    <meta property="og:image" content="{{ $socialImageUrl }}">
    <meta property="og:image:alt" content="Techibytes Media">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $socialImageUrl }}">
    <meta name="twitter:image:alt" content="Techibytes Media">

    <link rel="icon" href="{{ asset('favicon_io/favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">

    @if (request()->routeIs('home'))
        <script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @endif

    {{-- Dark mode is hidden for now; uncomment to re-enable the persisted theme (see also the theme-toggle button below) --}}
    {{--
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
    --}}

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="grain min-h-screen overflow-x-clip bg-ink font-sans text-bone antialiased">

    {{-- Header --}}
    <header id="site-header" class="fixed inset-x-0 top-0 z-50 transition-all duration-300">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-5 sm:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo/logo-2.png') }}" alt="Techibytes Media logo" class="h-10 w-10 dark:hidden">
                <img src="{{ asset('images/logo/logo-white-2.png') }}" alt="Techibytes Media logo" class="hidden h-10 w-10 dark:block">
                <span class="font-display text-xl font-extrabold tracking-tight">
                    Techibytes<span class="mx-0.5 text-accent">.</span><span class="text-muted">Media</span>
                </span>
            </a>

            <nav class="hidden items-center gap-8 text-sm font-medium lg:flex" aria-label="Primary">
                @foreach ([
                    'home' => 'Home',
                    'services' => 'Services',
                    'portfolio' => 'Work',
                    'graphics' => 'Graphics',
                    'contact' => 'Contact',
                ] as $routeName => $label)
                    <a
                        href="{{ route($routeName) }}"
                        @class([
                            'link-draw pb-0.5 transition-colors',
                            'text-accent' => request()->routeIs($routeName),
                            'text-bone/80 hover:text-bone' => ! request()->routeIs($routeName),
                        ])
                    >{{ $label }}</a>
                @endforeach
            </nav>

            <div class="flex items-center gap-3">
                <a
                    href="{{ route('contact') }}"
                    class="group hidden items-center gap-2 rounded-full bg-primary px-5 py-2.5 text-sm font-semibold text-white transition-transform hover:scale-105 sm:inline-flex"
                >
                    Start a project
                    <span class="transition-transform group-hover:translate-x-0.5">&rarr;</span>
                </a>

                {{-- Dark mode toggle, hidden for now; uncomment with the head theme script to re-enable --}}
                {{--
                <button
                    id="theme-toggle"
                    type="button"
                    class="flex h-11 w-11 items-center justify-center rounded-full border border-line text-bone transition-colors hover:border-accent/50 hover:text-accent"
                >
                    <span class="sr-only">Toggle dark mode</span>
                    <svg class="h-5 w-5 dark:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                    </svg>
                    <svg class="hidden h-5 w-5 dark:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                    </svg>
                </button>
                --}}

                <button
                    id="menu-toggle"
                    type="button"
                    aria-expanded="false"
                    aria-controls="mobile-menu"
                    class="flex h-11 w-11 flex-col items-center justify-center gap-1.5 rounded-full border border-line lg:hidden"
                >
                    <span class="sr-only">Toggle menu</span>
                    <span class="h-px w-5 bg-bone"></span>
                    <span class="h-px w-5 bg-bone"></span>
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div id="mobile-menu" class="relative hidden overflow-hidden border-t border-line bg-ink/95 backdrop-blur-xl lg:hidden">
            <x-hero-grid :show-boxes-on-mobile="true" />

            <nav class="relative flex flex-col gap-1 px-5 py-6" aria-label="Mobile">
                @foreach ([
                    'home' => 'Home',
                    'services' => 'Services',
                    'portfolio' => 'Work',
                    'graphics' => 'Graphics',
                    'contact' => 'Contact',
                ] as $routeName => $label)
                    <a
                        href="{{ route($routeName) }}"
                        @class([
                            'rounded-lg px-3 py-3 font-display text-2xl font-bold',
                            'text-accent' => request()->routeIs($routeName),
                            'text-bone' => ! request()->routeIs($routeName),
                        ])
                    >{{ $label }}</a>
                @endforeach
            </nav>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    {{-- Footer (navy panel with white logo variant) --}}
    <footer class="bg-primary text-white">
        <div class="mx-auto max-w-7xl px-5 pt-16 sm:px-8">
            <div class="grid gap-12 pb-16 md:grid-cols-12">
                <div class="md:col-span-5">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo/logo-white-2.png') }}" alt="Techibytes Media logo" class="h-11 w-11">
                        <span class="font-display text-2xl font-extrabold">
                            Techibytes<span class="mx-0.5 text-accent-soft">.</span><span class="text-white/60">Media</span>
                        </span>
                    </a>
                    <p class="mt-4 max-w-sm text-sm leading-relaxed text-white/60">
                        A software development &amp; digital marketing agency crafting websites, apps and brands
                        from Abuja to Seattle since 2020.
                    </p>
                    <div class="mt-6 flex gap-3">
                        @foreach ([
                            'Facebook' => 'https://www.facebook.com/techibytesmedia',
                            'X' => 'https://x.com/techibytes_hq',
                            'Instagram' => 'https://www.instagram.com/techibytesmedia',
                            'LinkedIn' => 'https://www.linkedin.com/company/techibytesmedia',
                        ] as $network => $url)
                            <a
                                href="{{ $url }}"
                                target="_blank"
                                rel="noopener"
                                class="flex h-10 items-center rounded-full border border-white/15 px-4 text-xs font-medium text-white/70 transition-colors hover:border-accent-soft hover:text-accent-soft"
                            >{{ $network }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="md:col-span-2">
                    <h3 class="text-xs font-semibold uppercase tracking-[0.2em] text-white/50">Pages</h3>
                    <ul class="mt-4 space-y-3 text-sm">
                        @foreach ([
                            'home' => 'Home',
                            'services' => 'Services',
                            'portfolio' => 'Work',
                            'graphics' => 'Graphics',
                            'contact' => 'Contact',
                        ] as $routeName => $label)
                            <li><a href="{{ route($routeName) }}" class="link-draw text-white/80 hover:text-white">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="md:col-span-2">
                    <h3 class="text-xs font-semibold uppercase tracking-[0.2em] text-white/50">Abuja</h3>
                    <p class="mt-4 text-sm leading-relaxed text-white/80">
                        Suite 303, 3rd Floor,<br>
                        Ammah Plaza, Near NAF<br>
                        Conference Center
                    </p>
                    <a href="tel:+2349031807262" class="link-draw mt-3 inline-block text-sm text-accent-soft">+234 903 180 7262</a>
                </div>

                <div class="md:col-span-3">
                    <h3 class="text-xs font-semibold uppercase tracking-[0.2em] text-white/50">Seattle</h3>
                    <p class="mt-4 text-sm leading-relaxed text-white/80">
                        600 1st Ave, Ste 102 #1105,<br>
                        Seattle, WA 98104
                    </p>
                    <div class="mt-3 flex flex-col items-start gap-2">
                        <a href="tel:+12065786373" class="link-draw text-sm text-accent-soft">+1 206 578 6373</a>
                        <a href="mailto:info@techibytesmedia.com" class="link-draw text-sm text-white/80">info@techibytesmedia.com</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-hidden border-t border-white/10 py-6 sm:py-8">
            <p
                data-testid="footer-wordmark"
                aria-hidden="true"
                class="w-full select-none whitespace-nowrap text-center font-display text-[clamp(1.5rem,8vw,8rem)] font-extrabold leading-none tracking-tight text-white/5"
            >
                TECHIBYTES MEDIA
            </p>
        </div>

        <div class="border-t border-white/10">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-1.5 px-4 py-5 text-center text-xs leading-relaxed text-white/50 sm:flex-row sm:gap-4 sm:px-8 sm:text-left">
                <p>&copy; {{ date('Y') }} Techibytes Media. All rights reserved.</p>
                <p>Abuja, Nigeria &mdash; Seattle, USA</p>
            </div>
        </div>
    </footer>

</body>
</html>

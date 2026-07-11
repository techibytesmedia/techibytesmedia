@props([
    'title' => 'Techibytes Media — Software Development & Digital Marketing Agency',
    'description' => 'Techibytes Media is a software development and digital marketing agency in Abuja, Nigeria and Seattle, USA. Web development, mobile apps, UI/UX design, SEO and branding.',
])

<!doctype html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="author" content="Techibytes Media">
    <meta name="robots" content="index, follow">

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:site_name" content="Techibytes Media">

    <link rel="icon" href="{{ asset('favicon_io/favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Instrument+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="grain min-h-screen overflow-x-clip bg-ink font-sans text-bone antialiased">

    {{-- Header --}}
    <header id="site-header" class="fixed inset-x-0 top-0 z-50 transition-all duration-300">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-5 sm:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo/logo-2.png') }}" alt="Techibytes Media logo" class="h-10 w-10">
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
        <div id="mobile-menu" class="hidden border-t border-line bg-ink/95 backdrop-blur-xl lg:hidden">
            <nav class="flex flex-col gap-1 px-5 py-6" aria-label="Mobile">
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
                            'X' => 'https://www.twitter.com/techibytesmedia',
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
                    <a href="mailto:info@techibytesmedia.com" class="link-draw mt-3 inline-block text-sm text-white/80">info@techibytesmedia.com</a>
                </div>
            </div>
        </div>

        <div class="overflow-hidden border-t border-white/10 py-6">
            <p class="select-none whitespace-nowrap text-center font-display text-[clamp(3rem,10vw,8rem)] font-extrabold leading-none text-white/5">
                TECHIBYTES MEDIA
            </p>
        </div>

        <div class="border-t border-white/10">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 px-5 py-5 text-xs text-white/50 sm:flex-row sm:px-8">
                <p>&copy; {{ date('Y') }} Techibytes Media. All rights reserved.</p>
                <p>Abuja, Nigeria &mdash; Seattle, USA</p>
            </div>
        </div>
    </footer>

</body>
</html>

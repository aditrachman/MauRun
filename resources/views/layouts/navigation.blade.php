<nav id="navbar" class="fixed top-0 left-0 right-0 z-50">
    {{-- Solid background — fades in on scroll --}}
    <div id="nav-bg" class="absolute inset-0 bg-canvas shadow-sm transition-opacity duration-500 opacity-0"></div>
    {{-- Sunset stripe — fades in on scroll --}}
    <div id="nav-stripe" class="relative h-0.5 bg-gradient-to-r from-primary via-sunshine-500 to-cream transition-opacity duration-500 opacity-0"></div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo (text for transparent, image for solid) --}}
            <a href="{{ url('/') }}" class="shrink-0 flex items-center">
                <img src="{{ asset('assets/logo.png') }}" alt="Mau Run" class="h-12 w-auto">
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden md:flex items-center gap-1">
                <a href="{{ route('public.events') }}" class="nav-link px-3 py-2 text-sm font-medium rounded-md transition">Events</a>

                {{-- Kategori Dropdown --}}
                <div class="relative group">
                    <button class="nav-link px-3 py-2 text-sm font-medium rounded-md transition flex items-center gap-1">
                        Kategori
                        <svg class="w-3 h-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="absolute left-0 top-full mt-1 w-48 bg-canvas border border-hairline-soft rounded-lg shadow-card opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 py-2 z-50">
                        <a href="{{ route('public.events', ['event_type_slug' => '5k']) }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">5K</a>
                        <a href="{{ route('public.events', ['event_type_slug' => '10k']) }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">10K</a>
                        <a href="{{ route('public.events', ['event_type_slug' => 'half_maraton']) }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">Half Maraton</a>
                        <a href="{{ route('public.events', ['event_type_slug' => 'full_maraton']) }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">Full Maraton</a>
                        <a href="{{ route('public.events', ['event_type_slug' => '3k']) }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">Fun Run / 3K</a>
                    </div>
                </div>

                {{-- Kota Dropdown --}}
                <div class="relative group">
                    <button class="nav-link px-3 py-2 text-sm font-medium rounded-md transition flex items-center gap-1">
                        Kota
                        <svg class="w-3 h-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="absolute left-0 top-full mt-1 w-48 bg-canvas border border-hairline-soft rounded-lg shadow-card opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 py-2 z-50">
                        <a href="{{ route('public.events', ['city_name' => 'Jakarta']) }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">Jakarta</a>
                        <a href="{{ route('public.events', ['city_name' => 'Yogyakarta']) }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">Yogyakarta</a>
                        <a href="{{ route('public.events', ['city_name' => 'Bandung']) }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">Bandung</a>
                        <a href="{{ route('public.events', ['city_name' => 'Surabaya']) }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">Surabaya</a>
                        <a href="{{ route('public.events', ['city_name' => 'Bali']) }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">Bali</a>
                        <a href="{{ route('public.events', ['city_name' => 'Semarang']) }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">Semarang</a>
                    </div>
                </div>

                @auth
                    <a href="{{ route('public.my-events') }}" class="nav-link px-3 py-2 text-sm font-medium rounded-md transition">My Events</a>
                    <a href="{{ route('profile.edit') }}" class="nav-link px-3 py-2 text-sm font-medium rounded-md transition">Profile</a>
                    @if(auth()->user()->is_admin)
                        {{-- Admin Dropdown --}}
                        <div class="relative group">
                            <button class="nav-link px-3 py-2 text-sm font-medium rounded-md transition flex items-center gap-1">
                                Admin
                                <svg class="w-3 h-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div class="absolute left-0 top-full mt-1 w-56 bg-canvas border border-hairline-soft rounded-lg shadow-card opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 py-2 z-50">
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">Dashboard</a>
                                <a href="{{ route('admin.events.index') }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">Manage Events</a>
                                <a href="{{ route('admin.events.create') }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">+ Buat Event</a>
                                <hr class="my-1 border-hairline-soft">
                                <a href="{{ route('admin.event-types.index') }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">Jenis Event</a>
                                <a href="{{ route('admin.cities.index') }}" class="block px-4 py-2 text-sm text-charcoal hover:text-ink hover:bg-surface transition">Kota</a>
                            </div>
                        </div>
                    @endif
                @endauth
            </div>

            {{-- Right side actions --}}
            <div class="flex items-center gap-3">
                @auth
                    <span id="user-name" class="text-sm hidden md:inline nav-text-muted">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="nav-btn-solid text-sm font-medium px-4 py-2 rounded-md transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link text-sm font-medium transition">Login</a>
                    <a href="{{ route('register') }}" class="nav-btn-solid text-sm font-medium px-4 py-2 rounded-md transition">Register</a>
                @endauth

                {{-- Mobile menu toggle --}}
                <button type="button" id="mobile-menu-toggle" class="md:hidden p-2 nav-link" aria-label="Toggle menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Nav --}}
        <div id="mobile-menu" class="hidden md:hidden pb-4 pt-4">
            <div class="flex flex-col gap-2">
                <a href="{{ route('public.events') }}" class="nav-link px-3 py-2 text-sm font-medium rounded-md transition">Events</a>

                <details class="group">
                    <summary class="nav-link px-3 py-2 text-sm font-medium rounded-md transition cursor-pointer list-none flex items-center justify-between">
                        Kategori
                        <svg class="w-3 h-3 group-open:rotate-180 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <div class="ml-4 mt-1 flex flex-col gap-1">
                        <a href="{{ route('public.events', ['event_type_slug' => '3k']) }}" class="nav-link-mobile px-3 py-1.5 text-sm transition">Fun Run / 3K</a>
                        <a href="{{ route('public.events', ['event_type_slug' => '5k']) }}" class="nav-link-mobile px-3 py-1.5 text-sm transition">5K</a>
                        <a href="{{ route('public.events', ['event_type_slug' => '10k']) }}" class="nav-link-mobile px-3 py-1.5 text-sm transition">10K</a>
                        <a href="{{ route('public.events', ['event_type_slug' => 'half_maraton']) }}" class="nav-link-mobile px-3 py-1.5 text-sm transition">Half Maraton</a>
                        <a href="{{ route('public.events', ['event_type_slug' => 'full_maraton']) }}" class="nav-link-mobile px-3 py-1.5 text-sm transition">Full Maraton</a>
                    </div>
                </details>

                <details class="group">
                    <summary class="nav-link px-3 py-2 text-sm font-medium rounded-md transition cursor-pointer list-none flex items-center justify-between">
                        Kota
                        <svg class="w-3 h-3 group-open:rotate-180 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <div class="ml-4 mt-1 flex flex-col gap-1">
                        <a href="{{ route('public.events', ['city_name' => 'Jakarta']) }}" class="nav-link-mobile px-3 py-1.5 text-sm transition">Jakarta</a>
                        <a href="{{ route('public.events', ['city_name' => 'Yogyakarta']) }}" class="nav-link-mobile px-3 py-1.5 text-sm transition">Yogyakarta</a>
                        <a href="{{ route('public.events', ['city_name' => 'Bandung']) }}" class="nav-link-mobile px-3 py-1.5 text-sm transition">Bandung</a>
                        <a href="{{ route('public.events', ['city_name' => 'Surabaya']) }}" class="nav-link-mobile px-3 py-1.5 text-sm transition">Surabaya</a>
                        <a href="{{ route('public.events', ['city_name' => 'Bali']) }}" class="nav-link-mobile px-3 py-1.5 text-sm transition">Bali</a>
                        <a href="{{ route('public.events', ['city_name' => 'Semarang']) }}" class="nav-link-mobile px-3 py-1.5 text-sm transition">Semarang</a>
                    </div>
                </details>

                @auth
                    <a href="{{ route('public.my-events') }}" class="nav-link px-3 py-2 text-sm font-medium rounded-md transition">My Events</a>
                    <a href="{{ route('profile.edit') }}" class="nav-link px-3 py-2 text-sm font-medium rounded-md transition">Profile</a>
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="nav-link px-3 py-2 text-sm font-medium rounded-md transition">Dashboard</a>
                        <a href="{{ route('admin.events.index') }}" class="nav-link px-3 py-2 text-sm font-medium rounded-md transition">Manage Events</a>
                        <a href="{{ route('admin.event-types.index') }}" class="nav-link px-3 py-2 text-sm font-medium rounded-md transition">Jenis Event</a>
                        <a href="{{ route('admin.cities.index') }}" class="nav-link px-3 py-2 text-sm font-medium rounded-md transition">Kota</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-toggle')?.addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });


</script>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mau Run') — {{ config('app.name', 'Mau Run') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,400&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-canvas text-ink">

    {{-- Navigation --}}
    @include('layouts.navigation')

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="max-w-5xl mx-auto mt-20 px-6">
            <div class="bg-cream border border-beige-deep text-ink px-5 py-3 rounded-lg text-sm flex items-center gap-3" role="alert">
                <span class="text-primary">✓</span>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-5xl mx-auto mt-20 px-6">
            <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-3 rounded-lg text-sm flex items-center gap-3" role="alert">
                <span>✕</span>
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif

    @isset($header)
        <header class="border-b border-hairline-soft bg-canvas pt-16">
            <div class="max-w-5xl mx-auto py-6 px-6">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main class="pt-16">
        {{ $slot }}
    </main>

    {{-- Sunset Stripe Band — signature element, full-width multi-stop gradient --}}
    <div class="w-full" style="height: 6px; background: linear-gradient(to right, #CC5A00, #FF5A1F, #FF8C33, #FFB366, #FFD700, #FFF8F0);"></div>

    {{-- Footer --}}
    <footer class="bg-ink text-on-dark">
        <div class="max-w-5xl mx-auto px-6 py-10">
            <div class="flex flex-col md:flex-row items-start justify-between gap-8">
                {{-- Brand --}}
                <div class="flex flex-col gap-3">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/logo.png') }}" alt="Mau Run" class="h-12 w-auto">
                    </a>
                    <p class="text-xs text-white/40 max-w-xs leading-relaxed">
                        Platform pendaftaran event lari Indonesia — dari 3K sampai Full Marathon.
                    </p>
                </div>

                {{-- Links --}}
                <div class="flex gap-12">
                    <div class="flex flex-col gap-2">
                        <p class="text-[10px] font-semibold text-white/30 uppercase tracking-widest mb-1">Jelajahi</p>
                        <a href="{{ route('public.events') }}" class="text-xs text-primary hover:text-sunshine-300 transition">Semua Event</a>
                        @auth
                        <a href="{{ route('public.my-events') }}" class="text-xs text-primary hover:text-sunshine-300 transition">Event Saya</a>
                        @endauth
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-[10px] font-semibold text-white/30 uppercase tracking-widest mb-1">Akun</p>
                        @auth
                        <a href="{{ route('profile.edit') }}" class="text-xs text-primary hover:text-sunshine-300 transition">Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-xs text-primary hover:text-sunshine-300 transition text-left">Keluar</button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="text-xs text-primary hover:text-sunshine-300 transition">Masuk</a>
                        <a href="{{ route('register') }}" class="text-xs text-primary hover:text-sunshine-300 transition">Daftar</a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-2">
                <p class="text-[11px] text-white/25">© {{ date('Y') }} Mau Run</p>
                <p class="text-[11px] text-white/25">Muhammad Aditya Rachman — 2405040018</p>
            </div>
        </div>
    </footer>

    {{-- Transparent nav scroll behavior --}}
    <script>
    (function() {
        const nav = document.getElementById('navbar');
        if (!nav) return;
        const bg = document.getElementById('nav-bg');
        const stripe = document.getElementById('nav-stripe');

        function updateNav() {
            const hero = document.querySelector('.hero-section');
            if (hero && window.scrollY < 80) {
                nav.classList.remove('nav-scrolled');
                bg?.classList.remove('opacity-100');
                bg?.classList.add('opacity-0');
                stripe?.classList.remove('opacity-100');
                stripe?.classList.add('opacity-0');
            } else {
                nav.classList.add('nav-scrolled');
                bg?.classList.remove('opacity-0');
                bg?.classList.add('opacity-100');
                stripe?.classList.remove('opacity-0');
                stripe?.classList.add('opacity-100');
            }
        }

        window.addEventListener('scroll', updateNav, { passive: true });
        updateNav();
    })();
    </script>
</body>
</html>
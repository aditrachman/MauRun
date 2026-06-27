<x-app-layout>

    {{-- ═══════════════════════════════════════════
         HERO — Cinematic sunset, full-bleed
    ═══════════════════════════════════════════ --}}
     <div class="hero-section relative overflow-hidden -mt-16"
          style="min-height: 100vh; background: linear-gradient(135deg, #CC5A00 0%, #FF5A1F 40%, #FF8C33 70%, #FFB366 100%);">

        {{-- Background photo --}}
        <div class="absolute inset-0 bg-cover bg-center"
             style="background-image: url('{{ asset('assets/banner.png') }}'); opacity: 0.28;"></div>

        {{-- Atmospheric vignette bottom --}}
        <div class="absolute inset-x-0 bottom-0 h-48"
             style="background: linear-gradient(to top, rgba(10,10,10,0.5) 0%, transparent 100%);"></div>

        {{-- Grain texture overlay --}}
        <div class="absolute inset-0 opacity-20"
             style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"200\" height=\"200\"><filter id=\"n\"><feTurbulence type=\"fractalNoise\" baseFrequency=\"0.9\" numOctaves=\"4\"/><feColorMatrix type=\"saturate\" values=\"0\"/></filter><rect width=\"200\" height=\"200\" filter=\"url(%23n)\" opacity=\"0.4\"/></svg>');"></div>

        {{-- Content --}}
        <div class="relative max-w-5xl mx-auto px-6 flex flex-col justify-center" style="min-height: 100vh; padding-top: 80px; padding-bottom: 40px;">
            <div class="max-w-2xl">
                {{-- Eyebrow --}}
                <p class="text-[11px] font-semibold text-white/60 uppercase tracking-[1px] mb-2">#MauRun · Indonesia</p>

                {{-- Hero headline --}}
                <h1 class="font-display font-normal text-white leading-[1.05]" style="font-size: clamp(2.5rem, 6vw, 5.25rem); letter-spacing:-0.02em">
                    Lari.<br>
                    <span style="color: #FFD699;">Taklukan.</span><br>
                    <span style="opacity: 0.6; font-style: italic;">Menang.</span>
                </h1>

                {{-- Subtitle --}}
                <p class="mt-4 text-white/75 max-w-md text-lg">
                    Platform pendaftaran event lari Indonesia — dari 3K sampai Full Marathon.
                </p>

                {{-- CTA buttons --}}
                <div class="flex flex-wrap gap-2 mt-4">
                    <a href="{{ route('public.events') }}"
                       class="inline-flex items-center gap-2 bg-ink text-on-dark font-medium px-6 py-3 rounded-md transition-all hover:bg-charcoal text-sm">
                        Lihat Semua Event
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    @auth
                        <a href="{{ route('public.my-events') }}"
                           class="inline-flex items-center gap-2 border border-white/30 text-white font-medium px-6 py-3 rounded-md transition-all hover:bg-white/10 text-sm backdrop-blur-sm">
                            Event Saya
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center gap-2 border border-white/30 text-white font-medium px-6 py-3 rounded-md transition-all hover:bg-white/10 text-sm backdrop-blur-sm">
                            Daftar Gratis
                        </a>
                    @endauth
                </div>

                {{-- Stat strip --}}
                <div class="flex flex-wrap gap-6 mt-6 pt-4">
                    <div>
                        <p class="font-display text-white leading-none" style="font-size: 32px; letter-spacing:-0.5px">50+</p>
                        <p class="text-[13px] text-white/50 mt-0.5 uppercase tracking-wider">Event Aktif</p>
                    </div>
                    <div>
                        <p class="font-display text-white leading-none" style="font-size: 32px; letter-spacing:-0.5px">10K+</p>
                        <p class="text-[13px] text-white/50 mt-0.5 uppercase tracking-wider">Pelari Terdaftar</p>
                    </div>
                    <div>
                        <p class="font-display text-white leading-none" style="font-size: 32px; letter-spacing:-0.5px">30+</p>
                        <p class="text-[13px] text-white/50 mt-0.5 uppercase tracking-wider">Kota</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════
         FEATURED EVENTS
    ═══════════════════════════════════════════ --}}
    <div class="max-w-5xl mx-auto px-6 py-section-lg">

        {{-- Section header --}}
        <div class="flex items-end justify-between mb-6">
            <div>
                <p class="text-[11px] font-semibold text-primary uppercase tracking-[1px] mb-1">Terbaru</p>
                <h2 class="font-display text-[36px] text-ink leading-tight">
                    Event Pilihan
                </h2>
            </div>
            <a href="{{ route('public.events') }}"
               class="text-xs text-primary hover:text-primary-deep font-medium transition flex items-center gap-1 pb-1">
                Semua event
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>

        @if(isset($events) && $events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                    <div class="group bg-canvas rounded-xl border border-hairline-soft overflow-hidden card-lift">
                        {{-- Image cover — clickable --}}
                        <a href="{{ route('public.show-event', $event) }}" class="block h-48 relative overflow-hidden group">
                            @if($event->image)
                                <img src="{{ asset('assets/' . $event->image) }}" alt="{{ $event->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-sunshine-500 to-primary"></div>
                            @endif
                            <div class="absolute inset-0 event-card-overlay"></div>
                            <div class="absolute top-4 left-4">
                                <span class="glass-badge">{{ $event->eventType->name }}</span>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="glass-badge bg-white/10 border-white/10">{{ $event->city->name }}</span>
                            </div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <h3 class="font-display text-xl text-white font-normal leading-snug drop-shadow-lg">{{ $event->name }}</h3>
                            </div>
                        </a>
                        {{-- Body --}}
                        <div class="p-5">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-steel">📅 {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</span>
                                <span class="text-primary font-semibold">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="mt-3 flex items-center justify-between">
                                <span class="text-sm text-steel">👥 Sisa {{ $event->quota - ($event->registrations_count ?? 0) }} / {{ $event->quota }}</span>
                                <a href="{{ route('public.show-event', $event) }}" class="text-primary hover:text-primary-deep text-sm font-medium transition">
                                    Detail →
                                </a>
                            </div>
                            <div class="mt-4 flex gap-2">
                                @if(($event->quota - ($event->registrations_count ?? 0)) > 0)
                                    @auth
                                        <a href="{{ route('public.register-form', $event) }}" class="flex-1 text-center bg-primary hover:bg-primary-deep text-on-dark text-sm font-medium py-2.5 rounded-md transition shadow-sm">
                                            Daftar →
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="flex-1 text-center bg-surface text-charcoal text-sm font-medium py-2.5 rounded-md transition border border-hairline-soft hover:bg-primary/5 hover:border-primary hover:text-primary">
                                            Login untuk Daftar
                                        </a>
                                    @endauth
                                @else
                                    <span class="flex-1 text-center bg-surface text-steel text-sm font-medium py-2.5 rounded-md border border-hairline-soft cursor-not-allowed">
                                        🔴 Penuh
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-cream rounded-xl border border-beige-deep">
                <p class="text-5xl mb-4">🏃</p>
                <p class="font-display text-lg text-ink font-normal mb-1">Belum ada event tersedia</p>
                <p class="text-sm text-steel">Pantau terus — event baru segera hadir.</p>
            </div>
        @endif
    </div>

    {{-- ═══════════════════════════════════════════
         SPONSOR / PARTNER LOGOS
    ═══════════════════════════════════════════ --}}
    <div class="py-8">
        <div class="max-w-5xl mx-auto px-6">
            <p class="text-[11px] font-semibold text-stone uppercase tracking-[1px] text-center mb-4">Didukung Oleh</p>
            <div class="grid grid-cols-3 md:grid-cols-6 gap-4 items-center">
                @foreach(['2', '3', '4', '5', '6', '7'] as $num)
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('assets/support-' . $num . '.png') }}"
                             alt="Partner"
                             class="h-24 w-auto object-contain opacity-40 hover:opacity-70 transition duration-300 grayscale hover:grayscale-0">
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════
         WHY MAU RUN — Cream section, editorial
    ═══════════════════════════════════════════ --}}
    <div class="bg-cream border-b border-beige-deep py-section-lg">
        <div class="max-w-5xl mx-auto px-6">

            <div class="max-w-xl mb-8">
                <p class="text-[11px] font-semibold text-primary uppercase tracking-[1px] mb-2">Kenapa Mau Run</p>
                <h2 class="font-display text-[36px] text-ink leading-tight">
                    Dirancang untuk<br>
                    <span style="font-style: italic;">setiap pelari.</span>
                </h2>
                <p class="text-sm md:text-base text-steel leading-relaxed mt-4 max-w-lg">
                    Dari pemula sampai pelari pro — Mau Run bikin kamu gampang nemuin event lari, 
                    daftar dalam hitungan menit, dan jadi bagian dari komunitas lari Indonesia.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Feature 1 --}}
                <div class="bg-canvas rounded-lg border border-hairline-soft p-5 group hover:border-primary/30 hover:shadow-card transition-all">
                    <div class="w-9 h-9 rounded-lg bg-cream border border-beige-deep flex items-center justify-center mb-3 text-base">
                        📱
                    </div>
                    <h3 class="font-display text-lg text-ink font-normal mb-1">Mudah Daftar</h3>
                    <p class="text-xs text-steel leading-relaxed">
                        Daftar dalam hitungan menit langsung dari gadget kamu — tanpa ribet, tanpa antrian.
                    </p>
                </div>

                {{-- Feature 2 --}}
                <div class="bg-canvas rounded-lg border border-hairline-soft p-5 group hover:border-primary/30 hover:shadow-card transition-all">
                    <div class="w-9 h-9 rounded-lg bg-cream border border-beige-deep flex items-center justify-center mb-3 text-base">
                        🏅
                    </div>
                    <h3 class="font-display text-lg text-ink font-normal mb-1">Banyak Pilihan</h3>
                    <p class="text-xs text-steel leading-relaxed">
                        Dari 3K fun run sampai Full Marathon 42K — ada kategori untuk semua level pelari.
                    </p>
                </div>

                {{-- Feature 3 --}}
                <div class="bg-canvas rounded-lg border border-hairline-soft p-5 group hover:border-primary/30 hover:shadow-card transition-all">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center mb-3 text-base"
                         style="background: #FF5A1F; border-radius: 8px;">
                        <span>💰</span>
                    </div>
                    <h3 class="font-display text-lg text-ink font-normal mb-1">Harga Bersahabat</h3>
                    <p class="text-xs text-steel leading-relaxed">
                        Gunakan kode diskon <span class="font-semibold text-primary">D-10</span>, <span class="font-semibold text-primary">D-20</span>, atau <span class="font-semibold text-primary">D-50</span> saat checkout.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════
         CTA BANNER — Bottom page CTA
    ═══════════════════════════════════════════ --}}
    <div class="max-w-5xl mx-auto px-6 py-section-lg">
        <div class="rounded-lg overflow-hidden relative"
             style="background: linear-gradient(135deg, #0A0A0A 0%, #1a1a1a 100%); padding: 40px 36px;">

            {{-- Background texture --}}
            <div class="absolute inset-0 opacity-10"
                 style="background: radial-gradient(ellipse 80% 60% at 100% 50%, #FF5A1F, transparent);"></div>

            <div class="relative flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                <div class="max-w-md">
                    <p class="text-[11px] font-semibold text-primary uppercase tracking-[1px] mb-2">Mulai Sekarang</p>
                    <h2 class="font-display text-[28px] text-white leading-tight">
                        Event berikutnya menantimu.
                    </h2>
                    <p class="text-xs text-white/50 mt-2 leading-relaxed">
                        Ribuan pelari sudah bergabung. Temukan event di kotamu.
                    </p>
                </div>
                <div class="flex flex-wrap gap-2 shrink-0">
                    <a href="{{ route('public.events') }}"
                       class="inline-flex items-center gap-2 font-medium px-5 py-2.5 rounded-md text-sm transition-all bg-primary hover:bg-primary-deep text-on-dark">
                        Lihat Event Sekarang
                        <svg width="12" height="12" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    @guest
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center gap-2 border border-white/20 text-white font-medium px-5 py-2.5 rounded-md text-sm transition-all hover:bg-white/10">
                            Buat Akun
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
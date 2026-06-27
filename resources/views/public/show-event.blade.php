<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 pt-4 pb-8">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-xs font-semibold text-primary uppercase tracking-[1.5px]">Detail Event</p>
                <h2 class="font-display text-2xl md:text-3xl text-ink font-normal leading-tight mt-1">{{ $event->name }}</h2>
            </div>
            <a href="{{ route('public.events') }}" class="text-primary hover:text-primary-deep text-sm font-medium transition shrink-0">← Kembali</a>
        </div>
        <div class="bg-canvas rounded-xl border border-hairline-soft overflow-hidden shadow-card">
            {{-- Image hero header --}}
            @if($event->image)
                <div class="h-72 relative overflow-hidden">
                    <img src="{{ asset('assets/' . $event->image) }}" alt="{{ $event->name }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <span class="glass-badge inline-block mb-3">{{ $event->eventType->name }}</span>
                        <h1 class="font-display text-3xl md:text-4xl text-white font-normal leading-tight drop-shadow-lg">{{ $event->name }}</h1>
                    </div>
                </div>
            @else
                <div class="bg-gradient-to-r from-sunshine-500 to-primary p-8">
                    <span class="inline-block bg-black/20 text-on-dark text-xs font-semibold px-4 py-1.5 rounded-full uppercase tracking-wide mb-3">{{ $event->eventType->name }}</span>
                    <h1 class="font-display text-3xl text-on-dark font-normal leading-tight">{{ $event->name }}</h1>
                </div>
            @endif

            {{-- Content --}}
            <div class="p-6 space-y-5">
                {{-- Info grid --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-cream rounded-md p-4 border border-beige-deep">
                        <p class="text-xs text-steel uppercase tracking-wide font-medium">Kota</p>
                        <p class="text-ink font-medium mt-1">{{ $event->city->name }}</p>
                    </div>
                    <div class="bg-cream rounded-md p-4 border border-beige-deep">
                        <p class="text-xs text-steel uppercase tracking-wide font-medium">Tanggal</p>
                        <p class="text-ink font-medium mt-1">{{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</p>
                    </div>
                    <div class="bg-cream rounded-md p-4 border border-beige-deep">
                        <p class="text-xs text-steel uppercase tracking-wide font-medium">Harga</p>
                        <p class="text-primary font-semibold text-xl mt-1">Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-cream rounded-md p-4 border border-beige-deep">
                        <p class="text-xs text-steel uppercase tracking-wide font-medium">Kuota</p>
                        <p class="text-ink font-medium mt-1">{{ $event->quota - ($event->registrations_count ?? 0) }} / {{ $event->quota }} tersisa</p>
                    </div>
                </div>

                {{-- Social proof + countdown --}}
                @php
                    $daysLeftFloat = \Carbon\Carbon::parse($event->date)->diffInDays(now(), false);
                    $daysLeft = (int) ceil($daysLeftFloat);
                @endphp
                <div class="flex flex-wrap items-center gap-x-6 gap-y-2 bg-cream rounded-md p-4 border border-beige-deep">
                    @if($daysLeft > 0)
                        <div class="flex items-center gap-2">
                            <span class="text-lg">📅</span>
                            <span class="text-sm text-charcoal">
                                @if($daysLeft == 1)
                                    <span class="text-primary font-semibold">Besok!</span>
                                @else
                                    Tinggal <span class="text-primary font-semibold">{{ $daysLeft }}</span> hari lagi
                                @endif
                            </span>
                        </div>
                    @endif
                    <div class="flex items-center gap-2">
                        <span class="text-lg">🏃</span>
                        <span class="text-sm text-charcoal">
                            <span class="text-primary font-semibold">{{ $event->registrations_count }}</span> dari 
                            <span class="font-semibold">{{ $event->quota }}</span> peserta sudah mendaftar
                        </span>
                    </div>
                </div>

                {{-- Description --}}
                @if($event->description)
                    <div class="bg-cream rounded-md p-4 border border-beige-deep">
                        <p class="text-xs text-steel uppercase tracking-wide font-medium mb-2">Deskripsi</p>
                        <p class="text-charcoal text-sm leading-relaxed">{{ $event->description }}</p>
                    </div>
                @endif

                {{-- CTA --}}
                <div class="pt-2">
                    @if(($event->quota - ($event->registrations_count ?? 0)) > 0)
                        @auth
                            <a href="{{ route('public.register-form', $event) }}" class="block w-full text-center bg-primary hover:bg-primary-deep text-on-dark text-sm font-medium py-3.5 rounded-md transition">
                                Daftar Sekarang →
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="block w-full text-center bg-ink hover:bg-charcoal text-on-dark text-sm font-medium py-3.5 rounded-md transition">
                                Login untuk Mendaftar
                            </a>
                        @endauth
                    @else
                        <div class="block w-full text-center bg-surface text-steel py-3.5 rounded-md text-sm font-medium border border-hairline-soft">
                            Kuota Penuh
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

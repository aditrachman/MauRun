<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 pt-6 pb-8">
        <div class="mb-6 border-b border-hairline-soft pb-5">
            <p class="text-xs font-semibold text-primary uppercase tracking-[1.5px]">Peserta</p>
            <h2 class="font-display text-2xl md:text-3xl text-ink font-normal leading-tight mt-1">Event Saya</h2>
        </div>
        @if($registrations->count() > 0)
            <div class="space-y-4">
                @foreach($registrations as $reg)
                    <div class="bg-canvas rounded-lg border border-hairline-soft p-6 hover:shadow-card transition">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <h3 class="font-display text-xl text-ink font-normal">{{ $reg->event->name }}</h3>
                                <div class="flex flex-wrap gap-3 text-sm text-steel mt-2">
                                    <span>🏃 {{ $reg->event->eventType->name }}</span>
                                    <span>📍 {{ $reg->event->city->name }}</span>
                                    <span>📅 {{ \Carbon\Carbon::parse($reg->event->date)->format('d F Y') }}</span>
                                </div>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="text-xs text-steel uppercase tracking-wide">Total</p>
                                <p class="text-xl font-semibold text-primary">Rp {{ number_format($reg->final_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-hairline-soft grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
                            <div>
                                <p class="text-xs text-steel uppercase tracking-wide">Nama</p>
                                <p class="text-charcoal font-medium mt-0.5">{{ $reg->full_name }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-steel uppercase tracking-wide">Email</p>
                                <p class="text-charcoal font-medium mt-0.5">{{ $reg->email }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-steel uppercase tracking-wide">Jersey</p>
                                <p class="text-charcoal font-medium mt-0.5">{{ $reg->jersey_size }}</p>
                            </div>
                            @if($reg->coupon_code)
                            <div>
                                <p class="text-xs text-steel uppercase tracking-wide">Kupon</p>
                                <p class="text-charcoal font-medium mt-0.5">{{ $reg->coupon_code }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-cream rounded-lg border border-beige-deep">
                <p class="text-4xl mb-4">🏃‍♂️</p>
                <p class="text-charcoal text-lg mb-2">Belum ada pendaftaran event</p>
                <p class="text-steel text-sm mb-6">Yuk daftar event lari sekarang juga!</p>
                <a href="{{ route('public.events') }}" class="inline-block bg-primary hover:bg-primary-deep text-on-dark text-sm font-medium px-6 py-3 rounded-md transition">
                    Lihat Events →
                </a>
            </div>
        @endif
    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 pt-4 pb-8">
        {{-- Heading + Filter — Mistral cohesive section --}}
        <div class="mb-6 border-b border-hairline-soft pb-5">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-5">
                <div>
                    <p class="text-xs font-semibold text-primary uppercase tracking-[1.5px]">Event</p>
                    <h2 class="font-display text-2xl md:text-3xl text-ink font-normal leading-tight mt-1">Semua Event Lari</h2>
                </div>
                @if(request()->filled('event_type_id') || request()->filled('city_id'))
                    <a href="{{ route('public.events') }}" class="text-sm text-steel hover:text-charcoal transition shrink-0 underline underline-offset-2">Reset filter</a>
                @endif
            </div>
            <form method="GET" class="flex flex-wrap gap-3 items-end">
                <div>
                    <label class="block text-[11px] font-medium text-charcoal mb-1.5 uppercase tracking-[1px]">Jenis</label>
                    <select name="event_type_id" class="w-40 rounded-md border-hairline-strong bg-canvas text-sm text-ink focus:border-primary focus:ring-primary">
                        <option value="">Semua</option>
                        @foreach($eventTypes as $t)
                            <option value="{{ $t->id }}" {{ request('event_type_id') == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-charcoal mb-1.5 uppercase tracking-[1px]">Kota</label>
                    <select name="city_id" class="w-40 rounded-md border-hairline-strong bg-canvas text-sm text-ink focus:border-primary focus:ring-primary">
                        <option value="">Semua Kota</option>
                        @foreach($cities as $c)
                            <option value="{{ $c->id }}" {{ request('city_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-primary hover:bg-primary-deep text-on-dark text-sm font-medium px-5 py-2.5 rounded-md transition shadow-sm">
                    Filter
                </button>
            </form>
        </div>

        {{-- Event Grid --}}
        @if($events->count() > 0)
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
                                <span class="text-sm text-steel">👥 Sisa {{ $event->quota - $event->registrations_count }} / {{ $event->quota }}</span>
                                <a href="{{ route('public.show-event', $event) }}" class="text-primary hover:text-primary-deep text-sm font-medium transition">
                                    Detail →
                                </a>
                            </div>
                            <div class="mt-4 flex gap-2">
                                @if(($event->quota - $event->registrations_count) > 0)
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
                <p class="text-5xl mb-4">🏃‍♂️</p>
                <p class="text-charcoal text-lg">Tidak ada event yang cocok dengan filter kamu.</p>
            </div>
        @endif
    </div>
</x-app-layout>

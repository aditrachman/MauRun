<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 pt-4 pb-8">
        {{-- Success banner --}}
        <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4 mb-6 flex items-center gap-3">
            <span class="text-2xl">✅</span>
            <div>
                <p class="text-emerald-800 font-semibold text-sm">Pendaftaran Berhasil!</p>
                <p class="text-emerald-600 text-xs mt-0.5">Status pembayaran: <strong class="text-emerald-700">LUNAS</strong></p>
            </div>
        </div>

        {{-- Invoice card --}}
        <div class="bg-cream border border-beige-deep rounded-lg p-6 md:p-8">
            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-beige-deep pb-5 mb-5">
                <div>
                    <p class="text-xs font-semibold text-primary uppercase tracking-[1.5px]">Invoice</p>
                    <h2 class="font-display text-2xl text-ink font-normal mt-1">Struk Pendaftaran</h2>
                </div>
                <div class="text-right">
                    <p class="text-xs text-steel">No. Registrasi</p>
                    <p class="text-sm font-semibold text-ink font-mono">#REG-{{ str_pad($registration->id, 4, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>

            {{-- Event info --}}
            <div class="bg-canvas border border-beige-deep rounded-md p-4 mb-5">
                <h3 class="font-display text-lg text-ink font-normal">{{ $registration->event->name }}</h3>
                <div class="grid grid-cols-2 gap-y-2 gap-x-4 mt-3 text-sm">
                    <div>
                        <span class="text-steel">Jenis</span>
                        <p class="text-charcoal font-medium">{{ $registration->event->eventType->name }}</p>
                    </div>
                    <div>
                        <span class="text-steel">Tanggal</span>
                        <p class="text-charcoal font-medium">{{ \Carbon\Carbon::parse($registration->event->date)->isoFormat('D MMMM YYYY') }}</p>
                    </div>
                    <div>
                        <span class="text-steel">Kota</span>
                        <p class="text-charcoal font-medium">{{ $registration->event->city->name }}</p>
                    </div>
                    <div>
                        <span class="text-steel">Kuota Tersisa</span>
                        <p class="text-charcoal font-medium">{{ $registration->event->remainingQuota() }} peserta</p>
                    </div>
                </div>
            </div>

            {{-- Participant data --}}
            <div class="mb-5">
                <p class="text-xs font-semibold text-primary uppercase tracking-[1.5px] mb-3">Data Peserta</p>
                <div class="grid grid-cols-2 gap-y-2.5 gap-x-4 text-sm">
                    <div>
                        <span class="text-steel">NIK</span>
                        <p class="text-charcoal font-medium">{{ $registration->nik }}</p>
                    </div>
                    <div>
                        <span class="text-steel">Nama Lengkap</span>
                        <p class="text-charcoal font-medium">{{ $registration->full_name }}</p>
                    </div>
                    <div>
                        <span class="text-steel">Email</span>
                        <p class="text-charcoal font-medium">{{ $registration->email }}</p>
                    </div>
                    <div>
                        <span class="text-steel">No. HP</span>
                        <p class="text-charcoal font-medium">{{ $registration->phone }}</p>
                    </div>
                    <div>
                        <span class="text-steel">Jenis Kelamin</span>
                        <p class="text-charcoal font-medium">{{ $registration->gender }}</p>
                    </div>
                    <div>
                        <span class="text-steel">Ukuran Jersey</span>
                        <p class="text-charcoal font-medium">{{ $registration->jersey_size }}</p>
                    </div>
                    @if($registration->coupon_code)
                    <div class="col-span-2">
                        <span class="text-steel">Kode Kupon</span>
                        <p class="text-charcoal font-medium">{{ $registration->coupon_code }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Payment summary --}}
            <div class="border-t border-beige-deep pt-4">
                <div class="flex justify-between items-center mb-2 text-sm">
                    <span class="text-steel">Harga Tiket</span>
                    <span class="text-charcoal">Rp {{ number_format($registration->event->price, 0, ',', '.') }}</span>
                </div>
                @if($registration->coupon_code && $registration->final_price < $registration->event->price)
                <div class="flex justify-between items-center mb-2 text-sm">
                    <span class="text-steel">Diskon ({{ $registration->coupon_code }})</span>
                    <span class="text-primary">-Rp {{ number_format($registration->event->price - $registration->final_price, 0, ',', '.') }}</span>
                </div>
                @endif
                <div class="flex justify-between items-center pt-3 border-t border-beige-deep mt-3">
                    <span class="text-ink font-semibold">Total Bayar</span>
                    <span class="text-primary font-bold text-xl">Rp {{ number_format($registration->final_price, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Payment status badge --}}
            <div class="mt-6 bg-emerald-50 border border-emerald-200 rounded-md p-3 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="text-emerald-600 font-medium text-sm">Status Pembayaran</span>
                </div>
                <span class="bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full">✅ LUNAS</span>
            </div>

            {{-- Actions --}}
            <div class="mt-6 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('public.my-events') }}"
                    class="flex-1 text-center bg-ink hover:bg-charcoal text-on-dark text-sm font-medium py-3 rounded-md transition">
                    ← Event Saya
                </a>
                <button onclick="window.print()"
                    class="flex-1 text-center border border-hairline-strong text-charcoal hover:bg-canvas text-sm font-medium py-3 rounded-md transition">
                    🖨 Cetak Struk
                </button>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 pt-4 pb-8">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-xs font-semibold text-primary uppercase tracking-[1.5px]">Pendaftaran</p>
                <h2 class="font-display text-2xl md:text-3xl text-ink font-normal leading-tight mt-1">Daftar Event</h2>
            </div>
            <a href="{{ route('public.show-event', $event) }}" class="text-primary hover:text-primary-deep text-sm font-medium transition shrink-0">← Kembali</a>
        </div>
        {{-- Cream form panel — Mistral contact-form-panel style --}}
        <div class="bg-cream border border-beige-deep rounded-lg p-6 md:p-8">
            <div class="mb-6">
                <h3 class="font-display text-xl text-ink font-normal">{{ $event->name }}</h3>
                <p class="text-steel text-sm mt-1">Rp {{ number_format($event->price, 0, ',', '.') }} · {{ $event->eventType->name }} · {{ $event->city->name }}</p>
            </div>

            <form method="POST" action="{{ route('public.register-store', $event) }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Nama Lengkap <span class="text-primary">*</span></label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" required
                        class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                    @error('full_name') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Email <span class="text-primary">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                    @error('email') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">No. HP <span class="text-primary">*</span></label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required
                        class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                    @error('phone') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Jenis Kelamin <span class="text-primary">*</span></label>
                    <select name="gender" required
                        class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                        <option value="">Pilih</option>
                        <option value="Laki-Laki" {{ old('gender') === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="Perempuan" {{ old('gender') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Ukuran Jersey <span class="text-primary">*</span></label>
                    <select name="jersey_size" required
                        class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                        <option value="">Pilih Ukuran</option>
                        @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                            <option value="{{ $size }}" {{ old('jersey_size') === $size ? 'selected' : '' }}>{{ $size }}</option>
                        @endforeach
                    </select>
                    @error('jersey_size') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Kode Kupon</label>
                    <input type="text" name="coupon_code" value="{{ old('coupon_code') }}" placeholder="D-10 / D-20 / D-50"
                        class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                    <p class="text-xs text-steel mt-1">Kode <strong class="text-charcoal">D-10</strong> (potong 10rb), <strong class="text-charcoal">D-20</strong> (20rb), atau <strong class="text-charcoal">D-50</strong> (50rb)</p>
                    @error('coupon_code') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Price summary --}}
                <div class="bg-canvas border border-beige-deep rounded-md p-4">
                    <p class="text-sm text-steel">Total harga: <span class="font-semibold text-primary text-lg">Rp {{ number_format($event->price, 0, ',', '.') }}</span></p>
                    <p class="text-xs text-steel mt-1">* Harga final akan disesuaikan jika menggunakan kode kupon.</p>
                </div>

                <button type="submit" class="w-full bg-ink hover:bg-charcoal text-on-dark text-sm font-medium py-3.5 rounded-md transition">
                    Konfirmasi Pendaftaran →
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

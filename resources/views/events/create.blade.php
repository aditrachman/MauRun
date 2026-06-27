<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 pt-4 pb-8">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-xs font-semibold text-primary uppercase tracking-[1.5px]">Admin</p>
                <h2 class="font-display text-2xl md:text-3xl text-ink font-normal leading-tight mt-1">Buat Event Baru</h2>
            </div>
            <a href="{{ route('admin.events.index') }}" class="text-primary hover:text-primary-deep text-sm font-medium transition shrink-0">← Kembali</a>
        </div>
        <div class="bg-cream border border-beige-deep rounded-lg p-6 md:p-8">
            <form method="POST" action="{{ route('admin.events.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Nama Event <span class="text-primary">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                    @error('name') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Jenis Event <span class="text-primary">*</span></label>
                    <select name="event_type_id" required
                        class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                        <option value="">Pilih</option>
                        @foreach($eventTypes as $type)
                            <option value="{{ $type->id }}" {{ old('event_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('event_type_id') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Tanggal <span class="text-primary">*</span></label>
                        <input type="date" name="date" value="{{ old('date') }}" required
                            class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                        @error('date') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Kota <span class="text-primary">*</span></label>
                        <select name="city_id" required
                            class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                            <option value="">Pilih</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Harga (Rp) <span class="text-primary">*</span></label>
                        <input type="number" name="price" value="{{ old('price') }}" required min="0"
                            class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                        @error('price') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Kuota Peserta <span class="text-primary">*</span></label>
                        <input type="number" name="quota" value="{{ old('quota') }}" required min="1"
                            class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                        @error('quota') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">{{ old('description') }}</textarea>
                    @error('description') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Path Gambar</label>
                    <input type="text" name="image" value="{{ old('image') }}" placeholder="events/nama-file.webp"
                        class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                    <p class="text-xs text-steel mt-1">Relatif terhadap <code class="text-primary">public/assets/</code></p>
                    @error('image') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full bg-ink hover:bg-charcoal text-on-dark text-sm font-medium py-3 rounded-md transition">
                    Buat Event →
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

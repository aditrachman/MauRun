<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 pt-4 pb-8">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-xs font-semibold text-primary uppercase tracking-[1.5px]">Admin</p>
                <h2 class="font-display text-2xl md:text-3xl text-ink font-normal leading-tight mt-1">Edit Event</h2>
            </div>
            <a href="{{ route('admin.events.index') }}" class="text-primary hover:text-primary-deep text-sm font-medium transition shrink-0">← Kembali</a>
        </div>
        <div class="bg-cream border border-beige-deep rounded-lg p-6 md:p-8">
            <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data" class="space-y-4">
                @csrf @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Nama Event <span class="text-primary">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $event->name) }}" required
                        class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                    @error('name') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Jenis Event <span class="text-primary">*</span></label>
                    <select name="event_type_id" required
                        class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                        @foreach($eventTypes as $type)
                            <option value="{{ $type->id }}" {{ old('event_type_id', $event->event_type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('event_type_id') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Tanggal <span class="text-primary">*</span></label>
                        <input type="date" name="date" value="{{ old('date', $event->date) }}" required
                            class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                        @error('date') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Kota <span class="text-primary">*</span></label>
                        <select name="city_id" required
                            class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id', $event->city_id) == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Harga (Rp) <span class="text-primary">*</span></label>
                        <input type="number" name="price" value="{{ old('price', $event->price) }}" required min="0"
                            class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                        @error('price') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Kuota <span class="text-primary">*</span></label>
                        <input type="number" name="quota" value="{{ old('quota', $event->quota) }}" required min="1"
                            class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">
                        @error('quota') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary">{{ old('description', $event->description) }}</textarea>
                    @error('description') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Gambar Event</label>
                    @if($event->image)
                        <div class="mb-3">
                            <img src="{{ asset('assets/' . $event->image) }}" alt="{{ $event->name }}" class="h-28 w-auto rounded-lg border border-beige-deep object-cover shadow-xs">
                        </div>
                    @endif
                    <div class="custom-file-wrapper relative">
                        <input type="file" name="image" id="image-input" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="hidden">
                        <label for="image-input" class="flex items-center gap-3 w-full rounded-md border border-dashed border-beige-deep bg-canvas px-4 py-3 cursor-pointer hover:border-primary hover:bg-primary/5 transition group">
                            <span class="flex items-center justify-center w-10 h-10 rounded-lg bg-primary/10 text-primary group-hover:bg-primary group-hover:text-on-dark transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </span>
                            <span class="flex-1 min-w-0">
                                <span class="file-label block text-sm font-medium text-charcoal">Ganti Gambar</span>
                                <span class="file-name block text-xs text-steel truncate mt-0.5">Klik untuk upload file baru</span>
                            </span>
                            <span class="text-xs font-medium text-primary border border-primary/30 rounded-md px-3 py-1 group-hover:bg-primary group-hover:text-on-dark transition">Browse</span>
                        </label>
                    </div>
                    <p class="text-xs text-steel mt-2">Format: <strong class="text-charcoal">JPG, PNG, WEBP</strong> · Maks: <strong class="text-charcoal">2 MB</strong>. Kosongkan jika tidak ingin ganti.</p>
                    @error('image') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <script>
                    document.getElementById('image-input')?.addEventListener('change', function(e) {
                        const wrapper = this.closest('.custom-file-wrapper');
                        const label = wrapper.querySelector('.file-label');
                        const name = wrapper.querySelector('.file-name');
                        if (this.files && this.files[0]) {
                            label.textContent = this.files[0].name;
                            name.textContent = (this.files[0].size / 1024).toFixed(1) + ' KB';
                        } else {
                            label.textContent = 'Ganti Gambar';
                            name.textContent = 'Klik untuk upload file baru';
                        }
                    });
                </script>

                <button type="submit" class="w-full bg-ink hover:bg-charcoal text-on-dark text-sm font-medium py-3 rounded-md transition">
                    Update Event →
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-xl mx-auto px-4 pt-4 pb-8">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-xs font-semibold text-primary uppercase tracking-[1.5px]">Master Data</p>
                <h2 class="font-display text-2xl md:text-3xl text-ink font-normal leading-tight mt-1">Tambah Jenis Event</h2>
            </div>
            <a href="{{ route('admin.event-types.index') }}" class="text-primary hover:text-primary-deep text-sm font-medium transition shrink-0">← Kembali</a>
        </div>
        <div class="bg-cream border border-beige-deep rounded-lg p-6 md:p-8">
            <form method="POST" action="{{ route('admin.event-types.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Nama <span class="text-primary">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary"
                        placeholder="Contoh: 5K, 10K, Half Maraton">
                    @error('name') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Slug <span class="text-primary">*</span></label>
                    <input type="text" name="slug" value="{{ old('slug') }}" required
                        class="w-full rounded-md border-hairline-strong bg-canvas text-sm text-ink px-3 py-2.5 focus:border-primary focus:ring-primary"
                        placeholder="Contoh: 5k, 10k, half_maraton">
                    <p class="text-xs text-steel mt-1">Slug digunakan sebagai identifier unik. Gunakan huruf kecil dan underscore.</p>
                    @error('slug') <p class="text-primary text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="w-full bg-ink hover:bg-charcoal text-on-dark text-sm font-medium py-3 rounded-md transition">
                    Simpan →
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

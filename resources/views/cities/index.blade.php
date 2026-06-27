<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 pt-4 pb-8">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-xs font-semibold text-primary uppercase tracking-[1.5px]">Master Data</p>
                <h2 class="font-display text-2xl md:text-3xl text-ink font-normal leading-tight mt-1">Kota</h2>
            </div>
            <a href="{{ route('admin.cities.create') }}" class="bg-primary hover:bg-primary-deep text-on-dark text-sm font-medium px-5 py-2.5 rounded-md transition shrink-0">
                + Kota Baru
            </a>
        </div>

        <div class="bg-canvas rounded-lg border border-hairline-soft overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-hairline-soft text-left text-xs text-steel uppercase tracking-wide">
                        <th class="p-4 font-medium">Nama Kota</th>
                        <th class="p-4 font-medium">Jumlah Event</th>
                        <th class="p-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-hairline-soft">
                    @foreach($cities as $city)
                        <tr class="hover:bg-surface transition">
                            <td class="p-4 font-medium text-charcoal">{{ $city->name }}</td>
                            <td class="p-4 text-charcoal">{{ $city->events_count }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.cities.edit', $city) }}" class="text-primary hover:text-primary-deep text-xs font-medium transition">Edit</a>
                                    <form method="POST" action="{{ route('admin.cities.destroy', $city) }}" onsubmit="return confirm('Yakin hapus?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs font-medium transition text-red-500 hover:text-red-700">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

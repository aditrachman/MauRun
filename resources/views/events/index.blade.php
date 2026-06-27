<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 pt-4 pb-8">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-xs font-semibold text-primary uppercase tracking-[1.5px]">Admin</p>
                <h2 class="font-display text-2xl md:text-3xl text-ink font-normal leading-tight mt-1">Manajemen Event</h2>
            </div>
            <a href="{{ route('admin.events.create') }}" class="bg-primary hover:bg-primary-deep text-on-dark text-sm font-medium px-5 py-2.5 rounded-md transition shrink-0">
                + Event Baru
            </a>
        </div>

        <div class="bg-canvas rounded-lg border border-hairline-soft overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-hairline-soft text-left text-xs text-steel uppercase tracking-wide">
                        <th class="p-4 font-medium">Nama</th>
                        <th class="p-4 font-medium hidden md:table-cell">Tipe</th>
                        <th class="p-4 font-medium hidden md:table-cell">Kota</th>
                        <th class="p-4 font-medium hidden lg:table-cell">Tanggal</th>
                        <th class="p-4 font-medium">Harga</th>
                        <th class="p-4 font-medium">Kuota</th>
                        <th class="p-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-hairline-soft">
                    @foreach($events as $event)
                        <tr class="hover:bg-surface transition">
                            <td class="p-4 font-medium text-charcoal">{{ $event->name }}</td>
                            <td class="p-4 hidden md:table-cell">
                                <span class="bg-cream-deeper text-charcoal text-xs font-medium px-2.5 py-1 rounded-full">{{ $event->eventType->name }}</span>
                            </td>
                            <td class="p-4 hidden md:table-cell text-steel">{{ $event->city->name }}</td>
                            <td class="p-4 hidden lg:table-cell text-steel">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</td>
                            <td class="p-4 text-charcoal">Rp {{ number_format($event->price, 0, ',', '.') }}</td>
                            <td class="p-4 text-charcoal">{{ $event->registrations_count }} / {{ $event->quota }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.events.edit', $event) }}" class="text-primary hover:text-primary-deep text-xs font-medium transition">Edit</a>
                                    <form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Yakin hapus event ini? Semua pendaftaran akan ikut terhapus!')" class="inline">
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

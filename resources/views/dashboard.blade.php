<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 pt-4 pb-8">
        {{-- Header inline --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-xs font-semibold text-primary uppercase tracking-[1.5px]">Admin</p>
                <h2 class="font-display text-2xl md:text-3xl text-ink font-normal leading-tight mt-1">Dashboard</h2>
            </div>
            <a href="{{ route('admin.events.create') }}" class="bg-primary hover:bg-primary-deep text-on-dark text-sm font-medium px-5 py-2.5 rounded-md transition shrink-0">
                + Event Baru
            </a>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
            <div class="bg-cream border border-beige-deep rounded-lg p-5">
                <p class="text-xs text-steel uppercase tracking-wide font-medium">Total Event</p>
                <p class="font-display text-4xl text-ink font-normal mt-1">{{ $events->count() }}</p>
            </div>
            <div class="bg-cream border border-beige-deep rounded-lg p-5">
                <p class="text-xs text-steel uppercase tracking-wide font-medium">Total Pendaftar</p>
                <p class="font-display text-4xl text-ink font-normal mt-1">{{ $totalPeserta }}</p>
            </div>
            <div class="bg-cream border border-beige-deep rounded-lg p-5">
                <p class="text-xs text-steel uppercase tracking-wide font-medium">Event Aktif</p>
                <p class="font-display text-4xl text-primary font-normal mt-1">{{ $events->where('date', '>=', now())->count() }}</p>
            </div>
        </div>

        {{-- Events table --}}
        <div class="bg-canvas rounded-lg border border-hairline-soft overflow-hidden">
            <div class="p-5 border-b border-hairline-soft">
                <h3 class="font-sans text-base font-medium text-ink">Daftar Event</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-hairline-soft text-left text-xs text-steel uppercase tracking-wide">
                            <th class="p-4 font-medium">Nama Event</th>
                            <th class="p-4 font-medium hidden md:table-cell">Tipe</th>
                            <th class="p-4 font-medium hidden md:table-cell">Kota</th>
                            <th class="p-4 font-medium hidden lg:table-cell">Tanggal</th>
                            <th class="p-4 font-medium">Pendaftar</th>
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
                                <td class="p-4 text-charcoal">{{ $event->registrations_count }} / {{ $event->quota }}</td>
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.events.edit', $event) }}" class="text-primary hover:text-primary-deep text-xs font-medium transition">Edit</a>
                                        <form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Hapus event ini?')" class="inline">
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
    </div>
</x-app-layout>

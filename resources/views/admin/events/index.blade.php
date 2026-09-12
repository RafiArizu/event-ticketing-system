<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event | Admin Event Organizer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-[100dvh] bg-[#fff9f3] text-[#2c221e] antialiased">
<div class="min-h-[100dvh]">
    @include('components.admin-sidebar')
    <main class="admin-shell-content min-w-0 lg:ml-[248px] lg:max-h-[100dvh] lg:overflow-y-auto">
        <div class="mx-auto max-w-[1400px] px-5 py-6 sm:px-7 lg:px-12 lg:py-9">
            <header class="border-b border-[#eadfd6] pb-7">
                <p class="font-mono text-[11px] font-semibold uppercase tracking-[.18em] text-[#f4511e]">Workspace / event</p>
                <h1 class="mt-2 font-['Outfit'] text-4xl font-extrabold tracking-[-.055em] sm:text-5xl">Kelola event</h1>
                <p class="mt-3 text-sm leading-6 text-[#756861]">Pantau event dan status publikasi dari satu ruang kerja.</p>
                @if(session('status'))<p class="mt-5 border border-[#b9d8c6] bg-[#edf3ec] px-4 py-3 text-sm text-[#287a54]">{{ session('status') }}</p>@endif
            </header>

            <section class="grid gap-3 py-7 sm:grid-cols-2 lg:grid-cols-4" aria-label="Ringkasan event">
                @foreach([
                    ['Draft', $statusCounts->get('draft', 0), 'text-[#956400]'],
                    ['Published', $statusCounts->get('published', 0), 'text-[#287a54]'],
                    ['Cancelled', $statusCounts->get('cancelled', 0), 'text-[#b33a2b]'],
                    ['Completed', $statusCounts->get('completed', 0), 'text-[#5f4b8b]'],
                ] as $metric)
                    <div class="flex min-h-20 items-center justify-between border-y border-[#eadfd6] bg-white px-5 py-3"><span class="text-xs uppercase tracking-[.12em] text-[#756861]">{{ $metric[0] }}</span><strong class="font-['Outfit'] text-3xl font-bold {{ $metric[2] }}">{{ $metric[1] }}</strong></div>
                @endforeach
            </section>

            <section aria-labelledby="event-list-title">
                <div class="mb-4 flex items-end justify-between gap-4"><div><p class="font-mono text-[10px] font-semibold uppercase tracking-[.18em] text-[#f4511e]">Daftar event</p><h2 id="event-list-title" class="mt-1 font-['Outfit'] text-2xl font-bold">Event terbaru</h2></div><a href="{{ route('admin.events.create') }}" class="inline-flex min-h-11 items-center justify-center rounded-[5px] bg-[#f4511e] px-5 text-sm font-bold text-[#fff9f3] hover:bg-[#d94216]">+ Buat event</a></div>
                <div class="overflow-x-auto border-y border-[#eadfd6] bg-white">
                    <table class="w-full min-w-[760px] text-left text-sm"><caption class="sr-only">Daftar event admin</caption><thead class="border-b border-[#eadfd6] bg-[#fff0e9] text-[10px] uppercase tracking-[.14em] text-[#756861]"><tr><th class="px-5 py-3">Event</th><th class="px-5 py-3">Vendor</th><th class="px-5 py-3">Tanggal</th><th class="px-5 py-3">Status</th><th class="px-5 py-3"><span class="sr-only">Aksi</span></th></tr></thead>
                    <tbody class="divide-y divide-[#eadfd6]">
                    @forelse($events as $event)
                        <tr class="hover:bg-[#fff9f3]"><td class="px-5 py-4"><p class="font-semibold">{{ $event->title }}</p><p class="mt-0.5 text-xs text-[#756861]">{{ $event->category?->name ?? 'Tanpa kategori' }}</p></td><td class="px-5 py-4 text-[#756861]">{{ $event->vendor?->organization_name ?? '-' }}</td><td class="px-5 py-4 text-[#756861]">{{ $event->event_date?->format('d M Y') ?? '-' }}</td><td class="px-5 py-4"><span class="rounded-full {{ $event->status === 'published' ? 'bg-[#edf3ec] text-[#287a54]' : 'bg-[#fbf3db] text-[#956400]' }} px-2.5 py-1 text-[10px] font-bold uppercase tracking-[.08em]">{{ $event->status }}</span></td><td class="px-5 py-4 text-right"><div class="flex items-center justify-end gap-4"><a href="{{ route('admin.events.show', $event) }}" class="font-semibold text-[#a9361f] underline decoration-[#f8c1ae] underline-offset-4">Detail</a><a href="{{ route('admin.events.edit', $event) }}" class="font-semibold text-[#756861] underline decoration-[#eadfd6] underline-offset-4">Edit</a><form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Hapus event ini?')">@csrf @method('DELETE')<button type="submit" class="font-semibold text-[#b33d38] underline decoration-[#efb5b0] underline-offset-4">Hapus</button></form></div></td></tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-12 text-center text-[#756861]">Belum ada event.</td></tr>
                    @endforelse
                    </tbody></table>
                </div>
                @if($events->hasPages())<div class="mt-5">{{ $events->links() }}</div>@endif
            </section>
            <footer class="mt-10 border-t border-[#eadfd6] pt-5 text-xs text-[#9f8f87]">Admin Event Organizer <span class="mx-2">/</span> Event <span class="mx-2">/</span> v0.1</footer>
        </div>
    </main>
</div>
</body>
</html>

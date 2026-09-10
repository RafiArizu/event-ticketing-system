<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event | Admin Event Organizer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .event-metrics { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:12px; padding:28px 0; }
        .event-metric { min-height:80px; display:flex; align-items:center; justify-content:space-between; padding:12px 20px; }
        @media (max-width:640px) { .event-metrics { grid-template-columns:1fr; gap:8px; } .event-metric { min-height:72px; } }
    </style>
</head>
<body class="min-h-[100dvh] bg-[#fff9f3] text-[#2c221e] antialiased">
<div class="min-h-[100dvh]">
    @include('components.admin-sidebar')
    <main class="admin-shell-content min-w-0 lg:ml-[248px] lg:max-h-[100dvh] lg:overflow-y-auto">
        <div class="mx-auto max-w-[1400px] px-5 py-6 sm:px-7 lg:px-12 lg:py-9">
            <header class="border-b border-[#eadfd6] pb-7"><div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between"><div><p class="font-mono text-[11px] font-semibold uppercase tracking-[.18em] text-[#f4511e]">Workspace / event</p><h1 class="mt-2 font-['Outfit'] text-4xl font-extrabold tracking-[-.055em] sm:text-5xl">Kelola event</h1><p class="mt-3 max-w-[65ch] text-sm leading-6 text-[#756861]">Pantau event, status publikasi, dan booking dari satu ruang kerja.</p></div><button type="button" class="inline-flex min-h-11 items-center justify-center rounded-[5px] bg-[#f4511e] px-5 text-sm font-bold text-[#fff9f3] hover:bg-[#d94216]">+ Buat event</button></div></header>
            <section class="event-metrics" aria-label="Ringkasan event"><div class="event-metric border-y border-[#eadfd6] bg-white"><p class="text-xs uppercase tracking-[.12em] text-[#756861]">Total event</p><p class="font-['Outfit'] text-3xl font-bold">12</p></div><div class="event-metric border-y border-[#eadfd6] bg-white"><p class="text-xs uppercase tracking-[.12em] text-[#756861]">Published</p><p class="font-['Outfit'] text-3xl font-bold text-[#287a54]">08</p></div><div class="event-metric border-y border-[#eadfd6] bg-white"><p class="text-xs uppercase tracking-[.12em] text-[#756861]">Draft</p><p class="font-['Outfit'] text-3xl font-bold text-[#956400]">04</p></div></section>
            <section aria-labelledby="event-list-title"><div class="mb-4 flex items-end justify-between gap-4"><div><p class="font-mono text-[10px] font-semibold uppercase tracking-[.18em] text-[#f4511e]">Daftar event</p><h2 id="event-list-title" class="mt-1 font-['Outfit'] text-2xl font-bold">Event terbaru</h2></div><span class="font-mono text-xs text-[#756861]">12 event</span></div><div class="overflow-x-auto border-y border-[#eadfd6] bg-white"><table class="w-full min-w-[760px] text-left text-sm"><caption class="sr-only">Daftar event admin</caption><thead class="border-b border-[#eadfd6] bg-[#fff0e9] text-[10px] uppercase tracking-[.14em] text-[#756861]"><tr><th class="px-5 py-3">Event</th><th class="px-5 py-3">Tanggal</th><th class="px-5 py-3">Booking</th><th class="px-5 py-3">Status</th><th class="px-5 py-3"><span class="sr-only">Aksi</span></th></tr></thead><tbody class="divide-y divide-[#eadfd6]"><tr class="hover:bg-[#fff9f3]"><td class="px-5 py-4"><p class="font-semibold">Otaku Matsuri 2026</p><p class="mt-0.5 text-xs text-[#756861]">Anime convention</p></td><td class="px-5 py-4 text-[#756861]">28 Sep 2026</td><td class="px-5 py-4 font-semibold">842</td><td class="px-5 py-4"><span class="rounded-full bg-[#edf3ec] px-2.5 py-1 text-[10px] font-bold uppercase tracking-[.08em] text-[#287a54]">Published</span></td><td class="px-5 py-4 text-right"><a href="{{ route('admin.events.show', 'otaku-matsuri-2026') }}" class="font-semibold text-[#a9361f] underline decoration-[#f8c1ae] underline-offset-4">Lihat detail</a></td></tr><tr class="hover:bg-[#fff9f3]"><td class="px-5 py-4"><p class="font-semibold">Comic Frontier Mini</p><p class="mt-0.5 text-xs text-[#756861]">Pop culture market</p></td><td class="px-5 py-4 text-[#756861]">04 Okt 2026</td><td class="px-5 py-4 font-semibold">176</td><td class="px-5 py-4"><span class="rounded-full bg-[#fbf3db] px-2.5 py-1 text-[10px] font-bold uppercase tracking-[.08em] text-[#956400]">Draft</span></td><td class="px-5 py-4 text-right"><a href="{{ route('admin.events.show', 'comic-frontier-mini') }}" class="font-semibold text-[#a9361f] underline decoration-[#f8c1ae] underline-offset-4">Lihat detail</a></td></tr></tbody></table></div></section>
            <footer class="mt-10 border-t border-[#eadfd6] pt-5 text-xs text-[#9f8f87]">Admin Event Organizer <span class="mx-2">/</span> Event <span class="mx-2">/</span> v0.1</footer>
        </div>
    </main>
</div>
</body>
</html>

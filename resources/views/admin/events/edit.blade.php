<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit {{ $event['name'] }} | Event</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-[100dvh] bg-[#fff9f3] text-[#2c221e] antialiased">
<div class="min-h-[100dvh]">
    @include('components.admin-sidebar')
    <main class="admin-shell-content min-w-0 lg:ml-[248px] lg:max-h-[100dvh] lg:overflow-y-auto">
        <div class="mx-auto max-w-[900px] px-5 py-6 sm:px-7 lg:px-12 lg:py-9">
            <a href="{{ route('admin.events.show', $slug) }}" class="inline-flex min-h-11 items-center gap-2 text-sm font-semibold text-[#a9361f] hover:text-[#762817]"><svg aria-hidden="true" viewBox="0 0 24 24" class="h-4 w-4 fill-none stroke-current" stroke-width="1.8"><path d="m15 5-7 7 7 7"/></svg>Kembali ke detail event</a>
            <header class="mt-7 border-b border-[#eadfd6] pb-7">
                <p class="font-mono text-[11px] font-semibold uppercase tracking-[.18em] text-[#f4511e]">Event / edit</p>
                <h1 class="mt-2 font-['Outfit'] text-4xl font-extrabold tracking-[-.055em] sm:text-5xl">Edit event</h1>
                <p class="mt-3 text-sm leading-6 text-[#756861]">Perbarui informasi dasar event sebelum disimpan.</p>
            </header>
            <form method="POST" action="#" class="mt-8 border border-[#eadfd6] bg-white px-5 py-6 sm:px-7">
                @csrf
                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="sm:col-span-2"><label for="name" class="text-sm font-semibold">Nama event</label><input id="name" name="name" type="text" value="{{ $event['name'] }}" class="mt-2 min-h-11 w-full rounded-[5px] border border-[#eadfd6] bg-[#fff9f3] px-3 text-sm focus:border-[#f4511e] focus:ring-0" required></div>
                    <div><label for="category" class="text-sm font-semibold">Kategori</label><input id="category" name="category" type="text" value="{{ $event['category'] }}" class="mt-2 min-h-11 w-full rounded-[5px] border border-[#eadfd6] bg-[#fff9f3] px-3 text-sm focus:border-[#f4511e] focus:ring-0" required></div>
                    <div><label for="status" class="text-sm font-semibold">Status</label><select id="status" name="status" class="mt-2 min-h-11 w-full rounded-[5px] border border-[#eadfd6] bg-[#fff9f3] px-3 text-sm focus:border-[#f4511e] focus:ring-0"><option @selected($event['status'] === 'Draft')>Draft</option><option @selected($event['status'] === 'Published')>Published</option></select></div>
                    <div><label for="date" class="text-sm font-semibold">Tanggal</label><input id="date" name="date" type="date" value="{{ $event['date'] }}" class="mt-2 min-h-11 w-full rounded-[5px] border border-[#eadfd6] bg-[#fff9f3] px-3 text-sm focus:border-[#f4511e] focus:ring-0" required></div>
                    <div><label for="time" class="text-sm font-semibold">Waktu mulai</label><input id="time" name="time" type="time" value="{{ $event['time'] }}" class="mt-2 min-h-11 w-full rounded-[5px] border border-[#eadfd6] bg-[#fff9f3] px-3 text-sm focus:border-[#f4511e] focus:ring-0" required></div>
                    <div class="sm:col-span-2"><label for="venue" class="text-sm font-semibold">Lokasi</label><input id="venue" name="venue" type="text" value="{{ $event['venue'] }}" class="mt-2 min-h-11 w-full rounded-[5px] border border-[#eadfd6] bg-[#fff9f3] px-3 text-sm focus:border-[#f4511e] focus:ring-0" required></div>
                    <div class="sm:col-span-2"><label for="description" class="text-sm font-semibold">Deskripsi</label><textarea id="description" name="description" rows="5" class="mt-2 w-full rounded-[5px] border border-[#eadfd6] bg-[#fff9f3] px-3 py-3 text-sm leading-6 focus:border-[#f4511e] focus:ring-0" required>{{ $event['description'] }}</textarea></div>
                </div>
                <div class="mt-8 flex flex-col-reverse gap-3 border-t border-[#eadfd6] pt-6 sm:flex-row sm:justify-end"><a href="{{ route('admin.events.show', $slug) }}" class="inline-flex min-h-11 items-center justify-center rounded-[5px] border border-[#eadfd6] px-5 text-sm font-bold text-[#756861] hover:bg-[#fff0e9]">Batal</a><button type="submit" class="inline-flex min-h-11 items-center justify-center rounded-[5px] bg-[#f4511e] px-5 text-sm font-bold text-[#fff9f3] hover:bg-[#d94216]">Simpan perubahan</button></div>
            </form>
            <footer class="mt-10 border-t border-[#eadfd6] pt-5 text-xs text-[#9f8f87]">Admin Event Organizer <span class="mx-2">/</span> Edit event <span class="mx-2">/</span> v0.1</footer>
        </div>
    </main>
</div>
</body>
</html>

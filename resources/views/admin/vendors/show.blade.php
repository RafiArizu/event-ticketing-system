<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $vendor['name'] }} | Vendor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-[100dvh] bg-[#fff9f3] text-[#2c221e] antialiased">
<div class="min-h-[100dvh]">
    @include('components.admin-sidebar')

    <main class="admin-shell-content min-w-0 lg:ml-[248px] lg:max-h-[100dvh] lg:overflow-y-auto">
        <div class="mx-auto max-w-[1100px] px-5 py-6 sm:px-7 lg:px-12 lg:py-9">
            <a href="{{ route('admin.vendors') }}" class="inline-flex min-h-11 items-center gap-2 text-sm font-semibold text-[#a9361f] hover:text-[#762817]"><svg aria-hidden="true" viewBox="0 0 24 24" class="h-4 w-4 fill-none stroke-current" stroke-width="1.8"><path d="m15 5-7 7 7 7"/></svg>Kembali ke pengajuan vendor</a>
            <header class="mt-7 border-b border-[#eadfd6] pb-7">
                <p class="font-mono text-[11px] font-semibold uppercase tracking-[.18em] text-[#f4511e]">Vendor / detail pengajuan</p>
                <div class="mt-3 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between"><div class="flex items-center gap-4"><span class="grid h-14 w-14 place-items-center rounded-[6px] bg-[#f8c1ae] font-['Outfit'] text-xl font-extrabold text-[#762817]">{{ $vendor['initials'] }}</span><div><h1 class="font-['Outfit'] text-4xl font-extrabold tracking-[-.055em]">{{ $vendor['name'] }}</h1><p class="mt-1 text-sm text-[#756861]">{{ $vendor['type'] }}</p></div></div><span class="w-fit rounded-full bg-[#fbf3db] px-3 py-1.5 text-[10px] font-bold uppercase tracking-[.08em] text-[#956400]">Pending</span></div>
                <p class="mt-5 text-sm text-[#756861]">Diajukan {{ $vendor['submitted'] }}</p>
            </header>
            <section class="grid gap-8 py-8 lg:grid-cols-[minmax(0,1fr)_300px]" aria-label="Detail pengajuan vendor">
                <article class="border border-[#eadfd6] bg-white"><div class="border-b border-[#eadfd6] px-6 py-5"><p class="font-mono text-[10px] font-semibold uppercase tracking-[.14em] text-[#9f8f87]">Profil organisasi</p><h2 class="mt-1 font-['Outfit'] text-2xl font-bold">Data yang dikirim</h2></div><dl class="divide-y divide-[#eadfd6] px-6"><div class="flex flex-col gap-1 py-5 sm:flex-row sm:items-center sm:justify-between sm:gap-6"><dt class="text-sm text-[#756861]">Nama organisasi</dt><dd class="text-sm font-semibold sm:text-right">{{ $vendor['name'] }}</dd></div><div class="flex flex-col gap-1 py-5 sm:flex-row sm:items-center sm:justify-between sm:gap-6"><dt class="text-sm text-[#756861]">Email akun</dt><dd class="text-sm font-medium sm:text-right">{{ $vendor['email'] }}</dd></div><div class="flex flex-col gap-1 py-5 sm:flex-row sm:items-center sm:justify-between sm:gap-6"><dt class="text-sm text-[#756861]">Nomor telepon</dt><dd class="text-sm font-medium sm:text-right">{{ $vendor['phone'] }}</dd></div><div class="flex flex-col gap-1 py-5 sm:flex-row sm:items-center sm:justify-between sm:gap-6"><dt class="text-sm text-[#756861]">Alamat</dt><dd class="max-w-[28rem] text-sm font-medium sm:text-right">{{ $vendor['address'] }}</dd></div></dl><div class="border-t border-[#eadfd6] px-6 py-6"><p class="font-mono text-[10px] font-semibold uppercase tracking-[.14em] text-[#9f8f87]">Deskripsi organisasi</p><p class="mt-3 max-w-[65ch] text-sm leading-6 text-[#756861]">{{ $vendor['description'] }}</p></div></article>
                <aside class="self-start border border-[#eadfd6] bg-white"><div class="border-b border-[#d16b54]/50 bg-[#a9361f] px-6 py-5 text-[#fff9f3]"><p class="font-mono text-[10px] font-semibold uppercase tracking-[.14em] text-[#f3b09e]">Keputusan admin</p><p class="mt-2 text-sm leading-6 text-[#f7d5cc]">Vendor pending belum punya akses ke workspace vendor.</p></div><div class="space-y-3 px-6 py-6"><button type="button" style="background-color:#287a54;color:#fff9f3" class="min-h-11 w-full rounded-[5px] px-4 text-sm font-bold hover:bg-[#1f6544]">Approve vendor</button><button type="button" style="margin-top:12px;border-color:#b33d38;color:#b33d38" class="min-h-11 w-full rounded-[5px] border bg-white px-4 text-sm font-bold hover:bg-[#fff0e9]">Tolak pengajuan</button><p class="pt-2 text-xs leading-5 text-[#9f8f87]">Keputusan hanya dapat dilakukan oleh admin dan akan mengubah status pengajuan.</p></div></aside>
            </section>
            <footer class="border-t border-[#eadfd6] pt-5 text-xs text-[#9f8f87]">Admin Event Organizer <span class="mx-2">/</span> Vendor detail <span class="mx-2">/</span> v0.1</footer>
        </div>
    </main>
</div>
</body>
</html>

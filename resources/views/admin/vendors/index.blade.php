<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor | Admin Event Organizer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-[100dvh] bg-[#fff9f3] text-[#2c221e] antialiased">
<div class="min-h-[100dvh]">
    @include('components.admin-sidebar')

    <main class="admin-shell-content min-w-0 lg:ml-[248px] lg:max-h-[100dvh] lg:overflow-y-auto">
        <div class="mx-auto max-w-[1400px] px-5 py-6 sm:px-7 lg:px-12 lg:py-9">
            <header class="border-b border-[#eadfd6] pb-7">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex min-h-11 items-center gap-2 text-sm font-semibold text-[#a9361f] hover:text-[#762817]">
                    <svg aria-hidden="true" viewBox="0 0 24 24" class="h-4 w-4 fill-none stroke-current" stroke-width="1.8"><path d="m15 5-7 7 7 7"/></svg>
                    Kembali ke dashboard
                </a>
                    <div class="mt-7 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="font-mono text-[11px] font-semibold uppercase tracking-[.18em] text-[#f4511e]">Workspace / vendor</p>
                        <h1 class="mt-2 font-['Outfit'] text-4xl font-extrabold tracking-[-.055em] sm:text-5xl">Verifikasi vendor</h1>
                        <p class="mt-3 max-w-[65ch] text-sm leading-6 text-[#756861]">Tinjau pengajuan organisasi sebelum akses vendor dibuka.</p>
                    </div>
                    <div class="flex items-baseline gap-2 border-l-2 border-[#f4511e] pl-4"><span class="font-['Outfit'] text-3xl font-extrabold">{{ $pendingCount }}</span><span class="text-sm text-[#756861]">menunggu tinjauan</span></div>
                </div>
            </header>

            <section class="py-7" aria-label="Filter vendor">
                <form class="grid gap-3 md:grid-cols-[minmax(0,1fr)_180px_auto]" method="GET" action="{{ route('admin.vendors') }}">
                    <label class="sr-only" for="vendor-search">Cari vendor</label>
                    <div class="relative"><svg aria-hidden="true" viewBox="0 0 24 24" class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 fill-none stroke-[#756861]" stroke-width="1.8"><circle cx="10.8" cy="10.8" r="6.8"/><path d="m16 16 4.2 4.2"/></svg><input id="vendor-search" name="q" type="search" placeholder="Cari nama organisasi atau email" class="min-h-12 w-full rounded-[5px] border border-[#eadfd6] bg-white pl-12 pr-4 text-sm text-[#2c221e] placeholder:text-[#9f8f87] focus:border-[#f4511e] focus:ring-0"></div>
                    <label class="sr-only" for="vendor-status">Filter status</label>
                    <select id="vendor-status" name="status" class="min-h-12 rounded-[5px] border border-[#eadfd6] bg-white px-4 text-sm text-[#2c221e] focus:border-[#f4511e] focus:ring-0"><option value="" @selected($status === '')>Semua status</option><option value="pending" @selected($status === 'pending')>Pending</option><option value="approved" @selected($status === 'approved')>Approved</option><option value="rejected" @selected($status === 'rejected')>Rejected</option></select>
                    <button type="submit" class="min-h-12 rounded-[5px] bg-[#f4511e] px-5 text-sm font-bold text-[#fff9f3] hover:bg-[#d94216]">Terapkan filter</button>
                </form>
            </section>

            <section class="w-full" aria-label="Daftar vendor">
                <article class="w-full">
                    <div class="mb-4 flex items-end justify-between gap-4"><div><p class="font-mono text-[10px] font-semibold uppercase tracking-[.18em] text-[#f4511e]">Antrian verifikasi</p><h2 class="mt-1 font-['Outfit'] text-2xl font-bold">Pengajuan terbaru</h2></div><span class="font-mono text-xs text-[#756861]">{{ $vendors->count() }} item</span></div>
                    <div class="overflow-x-auto border-y border-[#eadfd6] bg-white">
                        <table class="w-full min-w-[670px] text-left text-sm"><caption class="sr-only">Daftar pengajuan vendor</caption><thead class="border-b border-[#eadfd6] bg-[#fff0e9] text-[10px] uppercase tracking-[.14em] text-[#756861]"><tr><th scope="col" class="px-5 py-3 font-semibold">Organisasi</th><th scope="col" class="px-5 py-3 font-semibold">Kontak</th><th scope="col" class="px-5 py-3 font-semibold">Diajukan</th><th scope="col" class="px-5 py-3 font-semibold">Status</th><th scope="col" class="px-5 py-3 font-semibold"><span class="sr-only">Aksi</span></th></tr></thead><tbody class="divide-y divide-[#eadfd6]">
                        @forelse ($vendors as $vendor)
                            <tr class="hover:bg-[#fff9f3]"><td class="px-5 py-4"><div class="flex items-center gap-3"><span class="grid h-10 w-10 place-items-center rounded-[5px] bg-[#f8c1ae] font-['Outfit'] font-bold text-[#762817]">{{ strtoupper(substr($vendor->organization_name, 0, 2)) }}</span><div><p class="font-semibold">{{ $vendor->organization_name }}</p><p class="mt-0.5 text-xs text-[#756861]">{{ $vendor->user?->name ?? 'Pemilik belum terhubung' }}</p></div></div></td><td class="px-5 py-4 text-[#756861]">{{ $vendor->user?->email ?? '—' }}</td><td class="px-5 py-4 text-[#756861]">{{ $vendor->created_at?->format('d M Y') ?? '—' }}</td><td class="px-5 py-4"><span class="rounded-full px-2.5 py-1 text-[10px] font-bold uppercase tracking-[.08em] {{ $vendor->status === 'approved' ? 'bg-[#e7f3eb] text-[#287a54]' : ($vendor->status === 'rejected' ? 'bg-[#fbe8e6] text-[#b33d38]' : 'bg-[#fbf3db] text-[#956400]') }}">{{ ucfirst($vendor->status) }}</span></td><td class="px-5 py-4 text-right"><a href="{{ route('admin.vendors') }}" class="font-semibold text-[#a9361f] underline decoration-[#f8c1ae] underline-offset-4">Review</a></td></tr>
                        @empty
                            <tr><td colspan="5" class="px-5 py-12 text-center text-sm text-[#756861]">Belum ada vendor yang sesuai filter.</td></tr>
                        @endforelse
                        </tbody></table>
                    </div>
                </article>

            </section>
            <footer class="mt-10 border-t border-[#eadfd6] pt-5 text-xs text-[#9f8f87]">Admin Event Organizer <span class="mx-2">/</span> Vendor verification <span class="mx-2">/</span> v0.1</footer>
        </div>
    </main>
</div>
</body>
</html>

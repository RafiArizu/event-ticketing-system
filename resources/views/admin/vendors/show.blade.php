<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $vendor->organization_name }} | Vendor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-[100dvh] bg-[#fff9f3] text-[#2c221e] antialiased">
    @include('components.admin-sidebar')

    <main class="admin-shell-content min-w-0 lg:ml-[248px]">
        <div class="mx-auto max-w-[1400px] px-5 py-6 sm:px-7 lg:px-12 lg:py-9">
            <a href="{{ route('admin.vendors') }}" class="inline-flex min-h-11 items-center gap-2 text-sm font-semibold text-[#a9361f] hover:text-[#762817]">
                <svg aria-hidden="true" viewBox="0 0 24 24" class="h-4 w-4 fill-none stroke-current" stroke-width="1.8"><path d="m15 5-7 7 7 7"/></svg>
                Kembali ke vendor
            </a>

            <header class="mt-7 border-b border-[#eadfd6] pb-7">
                <p class="font-mono text-[11px] font-semibold uppercase tracking-[.18em] text-[#f4511e]">Workspace / vendor / detail</p>
                <div class="mt-4 flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <span class="grid h-14 w-14 place-items-center rounded-[5px] bg-[#f8c1ae] font-['Outfit'] text-xl font-bold text-[#762817]">{{ strtoupper(substr($vendor->organization_name, 0, 2)) }}</span>
                        <div><h1 class="font-['Outfit'] text-4xl font-extrabold tracking-[-.055em] sm:text-5xl">{{ $vendor->organization_name }}</h1><p class="mt-1 text-sm text-[#756861]">{{ $vendor->user?->name ?? 'Pemilik belum terhubung' }}</p></div>
                    </div>
                    <span class="w-fit rounded-full px-3 py-1.5 text-[10px] font-bold uppercase tracking-[.08em] {{ $vendor->status === 'approved' ? 'bg-[#e7f3eb] text-[#287a54]' : ($vendor->status === 'rejected' ? 'bg-[#fbe8e6] text-[#b33d38]' : 'bg-[#fbf3db] text-[#956400]') }}">{{ ucfirst($vendor->status) }}</span>
                </div>
            </header>

            <section class="grid gap-8 py-8 md:grid-cols-[minmax(0,1.25fr)_minmax(260px,.75fr)]" aria-label="Detail vendor">
                <article class="border-y border-[#eadfd6] bg-white">
                    <div class="border-b border-[#eadfd6] bg-[#fff0e9] px-5 py-4"><p class="font-mono text-[10px] font-semibold uppercase tracking-[.16em] text-[#f4511e]">Profil organisasi</p></div>
                    <dl class="divide-y divide-[#eadfd6] text-sm">
                        <div class="grid gap-1 px-5 py-4 sm:grid-cols-[150px_1fr]"><dt class="text-[#756861]">Deskripsi</dt><dd class="leading-6">{{ $vendor->description ?: 'Belum ada deskripsi.' }}</dd></div>
                        <div class="grid gap-1 px-5 py-4 sm:grid-cols-[150px_1fr]"><dt class="text-[#756861]">Alamat</dt><dd>{{ $vendor->address ?: 'Belum ada alamat.' }}</dd></div>
                        <div class="grid gap-1 px-5 py-4 sm:grid-cols-[150px_1fr]"><dt class="text-[#756861]">Telepon</dt><dd>{{ $vendor->phone ?: '—' }}</dd></div>
                        <div class="grid gap-1 px-5 py-4 sm:grid-cols-[150px_1fr]"><dt class="text-[#756861]">Sosial media</dt><dd class="space-y-1"><div>Instagram: {{ $vendor->instagram ?: '-' }}</div><div>Facebook: {{ $vendor->facebook ?: '-' }}</div><div>X (Twitter): {{ $vendor->{'x_(twitter)'} ?: '-' }}</div></dd></div>
                    </dl>
                </article>

                <aside class="border-y border-[#eadfd6] bg-white">
                    <div class="border-b border-[#eadfd6] bg-[#fff0e9] px-5 py-4"><p class="font-mono text-[10px] font-semibold uppercase tracking-[.16em] text-[#f4511e]">Informasi pengajuan</p></div>
                    <dl class="divide-y divide-[#eadfd6] text-sm">
                        <div class="px-5 py-4"><dt class="text-[#756861]">Email pemilik</dt><dd class="mt-1 break-words font-semibold">{{ $vendor->user?->email ?? '—' }}</dd></div>
                        <div class="px-5 py-4"><dt class="text-[#756861]">Diajukan</dt><dd class="mt-1 font-semibold">{{ $vendor->created_at?->format('d M Y, H:i') ?? '—' }}</dd></div>
                        <div class="px-5 py-4"><dt class="text-[#756861]">Ditinjau</dt><dd class="mt-1 font-semibold">{{ $vendor->reviewed_at?->format('d M Y, H:i') ?? 'Belum ditinjau' }}</dd></div>
                        <div class="px-5 py-4"><dt class="text-[#756861]">Ditinjau oleh admin</dt><dd class="mt-1 font-semibold">{{ $vendor->reviewer?->name ?? 'Belum ditinjau' }}</dd></div>
                    </dl>
                </aside>
            </section>

            @if (session('status'))
                <p class="border border-[#b8ddc6] bg-[#e7f3eb] px-5 py-3 text-sm text-[#287a54]">{{ session('status') }}</p>
            @endif

            @if ($vendor->status === 'pending')
                <section class="mt-8 border border-[#eadfd6] bg-white p-5 sm:p-6" aria-label="Tindakan vendor">
                    <div class="mb-5 flex flex-col gap-1 border-b border-[#eadfd6] pb-4"><p class="font-mono text-[10px] font-semibold uppercase tracking-[.16em] text-[#f4511e]">Keputusan review</p><h2 class="font-['Outfit'] text-2xl font-bold">Tentukan status vendor</h2><p class="text-sm text-[#756861]">Periksa data di atas sebelum memberikan keputusan.</p></div>
                    <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_280px] lg:items-end">
                        <form method="POST" action="{{ route('admin.vendors.reject', $vendor) }}" class="space-y-3">
                            @csrf
                            <label for="rejection_reason" class="block text-sm font-semibold">Alasan penolakan * <span class="font-normal text-[#756861]">(wajib)</span></label>
                            <textarea id="rejection_reason" name="rejection_reason" rows="3" required minlength="10" maxlength="500" class="w-full rounded-[5px] border border-[#eadfd6] bg-[#fff9f3] px-4 py-3 text-sm focus:border-[#f4511e] focus:ring-0" placeholder="Tulis alasan penolakan (minimal 10 karakter)">{{ old('rejection_reason') }}</textarea>
                            @error('rejection_reason')
                                <p class="text-sm text-[#b33d38]">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="min-h-11 w-full rounded-[5px] border border-[#b33d38] px-5 text-sm font-bold text-[#b33d38] transition-colors hover:bg-[#fbe8e6]">Reject vendor</button>
                        </form>
                        <form method="POST" action="{{ route('admin.vendors.approve', $vendor) }}" class="flex h-full flex-col justify-end gap-3 border-t border-[#eadfd6] pt-5 lg:border-l lg:border-t-0 lg:pl-6 lg:pt-0">
                            @csrf
                            <p class="text-sm leading-6 text-[#756861]">Setujui vendor jika profil sudah lengkap dan sesuai.</p>
                            <button type="submit" class="min-h-11 w-full rounded-[5px] bg-[#f4511e] px-6 text-sm font-bold text-[#fff9f3] transition-colors hover:bg-[#d94216]">Approve vendor</button>
                        </form>
                    </div>
                </section>
            @endif

            <footer class="border-t border-[#eadfd6] pt-5 text-xs text-[#9f8f87]">Admin Event Organizer <span class="mx-2">/</span> Vendor verification <span class="mx-2">/</span> v0.1</footer>
        </div>
    </main>
</body>
</html>

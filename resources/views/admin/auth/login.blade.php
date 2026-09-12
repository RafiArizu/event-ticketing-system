<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Admin Event Organizer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-[100dvh] bg-[#fff9f3] text-[#2c221e] antialiased">
    <main class="grid min-h-[100dvh] lg:grid-cols-[minmax(280px,38%)_1fr]">
        <section class="flex flex-col justify-between bg-[#a9361f] px-7 py-8 text-[#fff9f3] sm:px-12 lg:px-14 lg:py-12">
            <div><div class="flex h-12 w-12 items-center justify-center rounded-[6px] bg-[#f4511e] font-['Outfit'] text-xl font-extrabold">AE</div><p class="mt-7 font-mono text-[10px] uppercase tracking-[.2em] text-[#ffc4b2]">Admin workspace</p><h1 class="mt-3 max-w-[11ch] font-['Outfit'] text-4xl font-extrabold leading-[.98] tracking-[-.05em] sm:text-5xl">Anime Event Organizer</h1></div>
            <p class="mt-16 max-w-[30ch] text-sm leading-6 text-[#f9cbbd]">Kelola event, vendor, booking, dan kategori dari satu ruang kerja.</p>
        </section>
        <section class="flex items-center px-6 py-10 sm:px-12 lg:px-20"><div class="w-full max-w-[440px]"><p class="font-mono text-[11px] font-semibold uppercase tracking-[.18em] text-[#f4511e]">Selamat datang kembali</p><h2 class="mt-3 font-['Outfit'] text-4xl font-extrabold tracking-[-.05em] sm:text-5xl">Masuk ke admin</h2><p class="mt-3 text-sm leading-6 text-[#756861]">Gunakan akun admin untuk melanjutkan ke dashboard.</p>
            @if($errors->any())<div class="mt-7 border border-[#efb5b0] bg-[#fff0e9] px-4 py-3 text-sm text-[#b33d38]">{{ $errors->first() }}</div>@endif
            <form method="POST" action="{{ route('admin.login.store') }}" class="mt-8 space-y-5">@csrf<div><label for="email" class="text-sm font-semibold">Email admin</label><input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus class="mt-2 min-h-12 w-full rounded-[5px] border border-[#eadfd6] bg-white px-3 text-sm focus:border-[#f4511e] focus:outline-none focus:ring-2 focus:ring-[#f8c1ae]"></div><div><label for="password" class="text-sm font-semibold">Password</label><div class="relative mt-2"><input id="password" name="password" type="password" autocomplete="current-password" required class="min-h-12 w-full rounded-[5px] border border-[#eadfd6] bg-white px-3 pr-12 text-sm focus:border-[#f4511e] focus:outline-none focus:ring-2 focus:ring-[#f8c1ae]"><button type="button" id="toggle-password" aria-label="Tampilkan password" class="absolute inset-y-0 right-0 inline-flex w-12 items-center justify-center text-[#756861] hover:text-[#a9361f]"><svg id="eye-icon" aria-hidden="true" viewBox="0 0 24 24" class="h-5 w-5 fill-none stroke-current" stroke-width="1.8"><path d="M2.5 12s3.2-5 9.5-5 9.5 5 9.5 5-3.2 5-9.5 5-9.5-5-9.5-5Z"/><circle cx="12" cy="12" r="2.2"/></svg></button></div></div><label class="flex min-h-11 cursor-pointer items-center gap-3 text-sm text-[#756861]"><input type="checkbox" name="remember" value="1" class="h-4 w-4 accent-[#f4511e]">Ingat saya</label><button type="submit" class="inline-flex min-h-12 w-full items-center justify-center rounded-[5px] bg-[#f4511e] px-5 text-sm font-bold text-[#fff9f3] hover:bg-[#d94216]">Masuk ke dashboard</button></form>
            <p class="mt-8 border-t border-[#eadfd6] pt-5 text-xs text-[#9f8f87]">Admin Event Organizer <span class="mx-2">/</span> v0.1</p></div></section>
    </main>
    <script>const passwordInput=document.getElementById('password');const togglePassword=document.getElementById('toggle-password');togglePassword?.addEventListener('click',()=>{const visible=passwordInput.type==='text';passwordInput.type=visible?'password':'text';togglePassword.setAttribute('aria-label',visible?'Tampilkan password':'Sembunyikan password');});</script>
</body>
</html>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin login — Anime Event Organizer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{font-family:'Plus Jakarta Sans',sans-serif;color:#2c221e;background:#fff9f3;--orange:#f4511e;--terracotta:#a9361f;--line:#eadfd6;--muted:#756861}
        *{box-sizing:border-box}body{margin:0;min-height:100dvh;display:grid;place-items:center;padding:24px;background:#fff9f3}.card{width:min(100%,430px);padding:36px;background:#fffdf9;border:1px solid var(--line);box-shadow:0 20px 50px rgba(118,40,23,.12)}.mark{width:44px;height:44px;display:grid;place-items:center;border-radius:9px;background:var(--terracotta);color:#fff9f3;font-family:Outfit,sans-serif;font-weight:800;letter-spacing:-.08em}.eyebrow{margin:24px 0 7px;color:var(--muted);font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase}h1{margin:0;font-family:Outfit,sans-serif;font-size:2rem;letter-spacing:-.05em;line-height:1.05}.intro{margin:10px 0 28px;color:var(--muted);font-size:.88rem;line-height:1.6}.alert{margin-bottom:18px;padding:12px 14px;border:1px solid #efc7c2;border-radius:7px;background:#fff3f1;color:#b33d38;font-size:.82rem}.field{display:grid;gap:7px;margin-bottom:17px}label{font-size:.8rem;font-weight:700}input{width:100%;min-height:46px;border:1px solid var(--line);border-radius:7px;padding:11px 12px;background:#fff9f3;color:#2c221e;font:inherit}input:focus{outline:2px solid #f7b49f;outline-offset:2px;border-color:var(--orange)}input.invalid{border-color:#b33d38}.error{margin:0;color:#b33d38;font-size:.76rem}button{width:100%;min-height:46px;margin-top:4px;border:0;border-radius:7px;background:var(--orange);color:#fff9f3;font:inherit;font-weight:700;cursor:pointer;transition:background .2s cubic-bezier(.16,1,.3,1),transform .2s cubic-bezier(.16,1,.3,1)}button:hover{background:#d94317;transform:translateY(-1px)}.footer{margin:24px 0 0;color:#8b7d75;text-align:center;font-size:.72rem}:focus-visible{outline:2px solid var(--orange);outline-offset:3px}@media(prefers-reduced-motion:reduce){*{transition-duration:.01ms!important}}@media(max-width:480px){body{padding:16px}.card{padding:28px 22px}}
    </style>
</head>
<body>
<main class="card" aria-labelledby="login-title"><div class="mark" aria-hidden="true">AE</div><p class="eyebrow">Restricted workspace</p><h1 id="login-title">Masuk sebagai admin</h1><p class="intro">Kelola event, vendor, booking, dan tiket dari satu tempat.</p>
    @if ($errors->any())<div class="alert" role="alert">{{ $errors->first() }}</div>@endif
    <form method="POST" action="{{ url('/admin/auth') }}">
        @csrf
        <div class="field"><label for="email">Email admin</label><input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" required autofocus class="@error('email') invalid @enderror">@error('email')<p class="error">{{ $message }}</p>@enderror</div>
        <div class="field"><label for="password">Password</label><input id="password" name="password" type="password" autocomplete="current-password" required class="@error('password') invalid @enderror">@error('password')<p class="error">{{ $message }}</p>@enderror</div>
        <button type="submit">Masuk ke dashboard</button>
    </form><p class="footer">Anime Event Organizer · Admin area</p>
</main>
</body>
</html>

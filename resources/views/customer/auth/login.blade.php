<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk Customer — Anime Event</title>
    <style>body{margin:0;min-height:100vh;display:grid;place-items:center;background:#fff9f3;color:#2b211e;font-family:system-ui,sans-serif}.card{width:min(420px,calc(100% - 36px));padding:32px;border:1px solid #eaded5;background:#fff}.brand{font-weight:800;color:#ad351e}h1{margin:18px 0 6px;font-size:2rem}p{color:#766b66}label{display:grid;gap:7px;margin-top:16px;font-weight:600}input{padding:12px;border:1px solid #d8cdc5;font:inherit}button{width:100%;margin-top:24px;padding:13px;border:0;background:#f4511e;color:#fff;font:inherit;font-weight:700;cursor:pointer}.error{color:#b42318;font-size:.9rem}.row{display:flex;gap:8px;align-items:center;margin-top:14px;font-size:.9rem}a{color:#ad351e}</style>
</head>
<body>
<main class="card">
    <div class="brand">ANIME EVENT</div>
    <h1>Masuk sebagai customer</h1>
    <p>Kelola booking dan tiket event kamu.</p>
    <form method="POST" action="{{ route('customer.login.store') }}">
        @csrf
        <label>Email<input type="email" name="email" value="{{ old('email') }}" required autofocus></label>
        @error('email')<p class="error">{{ $message }}</p>@enderror
        <label>Kata sandi<input type="password" name="password" required></label>
        <label class="row"><input type="checkbox" name="remember" value="1"> Ingat saya</label>
        <button type="submit">Masuk</button>
    </form>
    <p>Belum punya akun? <a href="{{ route('customer.register') }}">Daftar customer</a></p>
</main>
</body>
</html>

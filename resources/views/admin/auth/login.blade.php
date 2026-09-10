<form method="POST" action="{{ route('admin.login.store') }}">
    @csrf

    <input type="email" name="email" value="{{ old('email') }}" required>
    @error('email') <p>{{ $message }}</p> @enderror

    <input type="password" name="password" required>

    <label>
        <input type="checkbox" name="remember" value="1">
        Ingat saya
    </label>

    <button type="submit">Masuk</button>
</form>
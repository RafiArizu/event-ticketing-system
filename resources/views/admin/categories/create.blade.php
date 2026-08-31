@extends('admin.layouts.app')
@section('content')
<div class="topbar"><div><p class="eyebrow">Taxonomy</p><h1>Tambah kategori</h1><p class="lede">Gunakan nama singkat yang mudah dipahami customer.</p></div><a class="button secondary" href="{{ url('/admin/categories') }}">Kembali</a></div>
<section class="panel section"><div class="panel-body"><form method="POST" action="#">@csrf<div class="form-grid"><div class="field"><label for="name">Nama kategori</label><input id="name" name="name" value="{{ old('name') }}" placeholder="Anime Festival" required></div><div class="field"><label for="slug">Slug</label><input id="slug" name="slug" value="{{ old('slug') }}" placeholder="anime-festival" required><small>Dipakai pada URL dan filter.</small></div></div><div class="actions"><a class="button secondary" href="{{ url('/admin/categories') }}">Batal</a><button class="button" type="submit">Simpan kategori</button></div></form></div></section>
@endsection

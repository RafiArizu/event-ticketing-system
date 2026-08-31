@extends('admin.layouts.app')
@section('content')
<div class="topbar"><div><p class="eyebrow">Taxonomy</p><h1>Edit kategori</h1><p class="lede">Perubahan nama akan terlihat di halaman event customer.</p></div><a class="button secondary" href="{{ url('/admin/categories') }}">Kembali</a></div>
<section class="panel section"><div class="panel-body"><form method="POST" action="#">@csrf @method('PUT')<div class="form-grid"><div class="field"><label for="name">Nama kategori</label><input id="name" name="name" value="{{ old('name', $category->name ?? '') }}" required></div><div class="field"><label for="slug">Slug</label><input id="slug" name="slug" value="{{ old('slug', $category->slug ?? '') }}" required></div></div><div class="actions"><a class="button secondary" href="{{ url('/admin/categories') }}">Batal</a><button class="button" type="submit">Simpan perubahan</button></div></form></div></section>
@endsection

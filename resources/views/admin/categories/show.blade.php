@extends('admin.layouts.app')
@section('content')
<div class="topbar"><div><p class="eyebrow">Category detail</p><h1>{{ $category->name ?? 'Category detail' }}</h1><p class="lede">Ringkasan event yang memakai kategori ini.</p></div><a class="button secondary" href="{{ url('/admin/categories') }}">Kembali</a></div>
<section class="panel section"><div class="panel-body"><p class="eyebrow">Slug</p><p class="mono">{{ $category->slug ?? '—' }}</p><p class="eyebrow" style="margin-top:24px">Event</p><p>{{ $category->events_count ?? ($category->events->count() ?? 0) }} event terhubung</p></div></section>
@endsection

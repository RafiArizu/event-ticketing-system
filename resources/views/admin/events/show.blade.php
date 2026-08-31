@extends('admin.layouts.app')
@section('content')
<div class="topbar"><div><p class="eyebrow">Event detail</p><h1>{{ $event->title ?? 'Event detail' }}</h1><p class="lede">Review informasi event, vendor, dan status publikasinya.</p></div><a class="button secondary" href="{{ url('/admin/events') }}">Kembali</a></div>
<section class="panel section"><div class="panel-body"><div class="form-grid"><div><p class="eyebrow">Vendor</p><p>{{ $event->vendor->name ?? '—' }}</p></div><div><p class="eyebrow">Status</p><span class="badge warning">{{ ucfirst($event->status ?? 'draft') }}</span></div><div><p class="eyebrow">Tanggal</p><p>{{ optional($event->event_date ?? null)->format('d M Y') ?? '—' }}</p></div><div><p class="eyebrow">Venue</p><p>{{ $event->venue_name ?? '—' }}</p></div></div></div></section>
@endsection

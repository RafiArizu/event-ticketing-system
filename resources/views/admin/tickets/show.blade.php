@extends('admin.layouts.app')
@section('content')
<div class="topbar"><div><p class="eyebrow">Ticket detail</p><h1>{{ $ticket->name ?? 'Ticket detail' }}</h1><p class="lede">Harga, quota, dan periode penjualan ticket.</p></div><a class="button secondary" href="{{ url('/admin/tickets') }}">Kembali</a></div>
<section class="panel section"><div class="panel-body"><div class="form-grid"><div><p class="eyebrow">Event</p><p>{{ $ticket->ticketCategory->event->title ?? '—' }}</p></div><div><p class="eyebrow">Price</p><p class="stat-value">Rp {{ isset($ticket) ? number_format($ticket->price, 0, ',', '.') : '—' }}</p></div><div><p class="eyebrow">Sold / quota</p><p class="mono">{{ $ticket->sold ?? 0 }} / {{ $ticket->quota ?? 0 }}</p></div><div><p class="eyebrow">Sales period</p><p>{{ optional($ticket->sales_start ?? null)->format('d M Y') ?? '—' }} – {{ optional($ticket->sales_end ?? null)->format('d M Y') ?? '—' }}</p></div></div></div></section>
@endsection

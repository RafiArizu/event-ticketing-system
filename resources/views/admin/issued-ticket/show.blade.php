@extends('admin.layouts.app')
@section('content')
<div class="topbar"><div><p class="eyebrow">Issued ticket detail</p><h1 class="mono">{{ $issuedTicket->ticket_code ?? 'Ticket detail' }}</h1><p class="lede">Status individual ticket dan waktu check-in.</p></div><a class="button secondary" href="{{ url('/admin/issued-ticket') }}">Kembali</a></div>
<section class="panel section"><div class="panel-body"><div class="form-grid"><div><p class="eyebrow">Booking</p><p class="mono">{{ $issuedTicket->bookingItem->booking->booking_code ?? '—' }}</p></div><div><p class="eyebrow">Status</p><span class="badge success">{{ ucfirst($issuedTicket->status ?? 'active') }}</span></div><div><p class="eyebrow">Used at</p><p>{{ optional($issuedTicket->used_at ?? null)->format('d M Y, H:i') ?? 'Belum check-in' }}</p></div></div></div></section>
@endsection

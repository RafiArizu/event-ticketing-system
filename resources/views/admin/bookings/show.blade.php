@extends('admin.layouts.app')
@section('content')
<div class="topbar"><div><p class="eyebrow">Booking detail</p><h1 class="mono">{{ $booking->booking_code ?? 'Booking detail' }}</h1><p class="lede">Detail transaksi, customer, dan status pembayaran.</p></div><a class="button secondary" href="{{ url('/admin/bookings') }}">Kembali</a></div>
<section class="panel section"><div class="panel-body"><div class="form-grid"><div><p class="eyebrow">Customer</p><p>{{ $booking->user->name ?? '—' }}</p></div><div><p class="eyebrow">Total</p><p class="stat-value">Rp {{ isset($booking) ? number_format($booking->total_amount, 0, ',', '.') : '—' }}</p></div><div><p class="eyebrow">Payment</p><span class="badge success">{{ ucfirst($booking->payment_status ?? 'unpaid') }}</span></div><div><p class="eyebrow">Status</p><span class="badge neutral">{{ ucfirst($booking->status ?? 'pending') }}</span></div></div></div></section>
@endsection

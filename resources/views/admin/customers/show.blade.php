@extends('admin.layouts.app')
@section('content')
<div class="topbar"><div><p class="eyebrow">Customer detail</p><h1>{{ $customer->name ?? 'Customer detail' }}</h1><p class="lede">Profil akun dan ringkasan booking customer.</p></div><a class="button secondary" href="{{ url('/admin/customers') }}">Kembali</a></div>
<section class="panel section"><div class="panel-body"><div class="form-grid"><div><p class="eyebrow">Email</p><p>{{ $customer->email ?? '—' }}</p></div><div><p class="eyebrow">Total booking</p><p class="stat-value">{{ $customer->bookings_count ?? ($customer->bookings->count() ?? 0) }}</p></div></div></div></section>
@endsection

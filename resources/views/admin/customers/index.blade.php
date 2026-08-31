@extends('admin.layouts.app')
@section('content')
<div class="topbar"><div><p class="eyebrow">People</p><h1>Customers</h1><p class="lede">Lihat akun customer dan aktivitas booking mereka.</p></div></div>
<section class="panel section"><div class="panel-head"><h2>Customer accounts</h2></div>@if(isset($customers) && $customers->count())<div class="table-wrap"><table class="table"><thead><tr><th>Nama</th><th>Email</th><th>Booking</th><th></th></tr></thead><tbody>@foreach($customers as $customer)<tr><td><strong>{{ $customer->name }}</strong></td><td>{{ $customer->email }}</td><td>{{ $customer->bookings_count ?? $customer->bookings->count() }}</td><td><a class="button secondary" href="{{ url('/admin/customers/'.$customer->id) }}">Lihat</a></td></tr>@endforeach</tbody></table></div>@else<div class="empty"><strong>Belum ada customer.</strong><span>Akun customer yang terdaftar akan muncul di sini.</span></div>@endif</section>
@endsection

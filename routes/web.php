<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.auth.login');
});

Route::view('/customer/home', 'customer.home.index')->name('customer.home');

Route::view('/admin/auth', 'admin.Auth.login')->name('admin.login');

// Preview routes: these expose the Blade UI directly until auth/controllers are wired.
Route::prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'admin.dashboard.index')->name('dashboard');
    Route::view('/events', 'admin.events.index')->name('events.index');
    Route::redirect('/events/create', '/admin/events')->name('events.create');
    Route::view('/events/{event}', 'admin.events.show')->name('events.show');
    Route::view('/vendor', 'admin.vendor.index')->name('vendors.index');
    Route::view('/customers', 'admin.customers.index')->name('customers.index');
    Route::view('/customers/{customer}', 'admin.customers.show')->name('customers.show');
    Route::view('/categories', 'admin.categories.index')->name('categories.index');
    Route::view('/categories/create', 'admin.categories.create')->name('categories.create');
    Route::view('/categories/{category}', 'admin.categories.show')->name('categories.show');
    Route::view('/categories/{category}/edit', 'admin.categories.edit')->name('categories.edit');
    Route::view('/bookings', 'admin.bookings.index')->name('bookings.index');
    Route::view('/bookings/{booking}', 'admin.bookings.show')->name('bookings.show');
    Route::view('/tickets', 'admin.tickets.index')->name('tickets.index');
    Route::view('/tickets/{ticket}', 'admin.tickets.show')->name('tickets.show');
    Route::view('/issued-ticket', 'admin.issued-ticket.index')->name('issued-tickets.index');
    Route::view('/issued-ticket/{issuedTicket}', 'admin.issued-ticket.show')->name('issued-tickets.show');
});

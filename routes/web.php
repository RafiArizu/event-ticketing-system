<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Customer\CustomerLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.auth.login');
});



// ------ Routes Admin -------   

Route::view('/admin/auth', 'admin.auth.login')->name('admin.auth.login');

Route::redirect('/login', '/admin/login')->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLogin'])
            ->name('login');

        Route::post('/login', [AdminLoginController::class, 'login'])
            ->name('login.store');
    });

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::view('/dashboard', 'admin.dashboard.index')
            ->name('dashboard');

        Route::post('/logout', [AdminLoginController::class, 'logout'])
            ->name('logout');
    });
});


Route::view('/admin/dashboard', 'admin.dashboard.index')->name('admin.dashboard');

Route::view('/admin/events', 'admin.events.index')->name('admin.events');

Route::get('/admin/bookings', function (\Illuminate\Http\Request $request) {
        $bookings = [
            ['code' => 'BK-2609028', 'buyer' => 'Nadya Prameswari', 'email' => 'nadya.prameswari@mail.id', 'event' => 'Otaku Matsuri 2026', 'tickets' => 2, 'total' => 'Rp680.000', 'payment' => 'Paid', 'status' => 'Confirmed', 'booked_at' => '02 Sep 2026, 14:32'],
            ['code' => 'BK-2609027', 'buyer' => 'Bagas Wicaksono', 'email' => 'bagas.wicaksono@mail.id', 'event' => 'Comic Frontier Mini', 'tickets' => 1, 'total' => 'Rp245.000', 'payment' => 'Pending', 'status' => 'Pending', 'booked_at' => '02 Sep 2026, 12:08'],
            ['code' => 'BK-2609021', 'buyer' => 'Mira Kurniawan', 'email' => 'mira.kurniawan@mail.id', 'event' => 'Otaku Matsuri 2026', 'tickets' => 3, 'total' => 'Rp1.020.000', 'payment' => 'Paid', 'status' => 'Cancelled', 'booked_at' => '01 Sep 2026, 19:44'],
        ];
        $query = strtolower($request->string('q')->toString());
        $event = $request->string('event')->toString();
        $payment = $request->string('payment')->toString();
        $status = $request->string('status')->toString();
        $bookings = array_values(array_filter($bookings, fn (array $item) => ($query === '' || str_contains(strtolower(implode(' ', $item)), $query)) && ($event === '' || $item['event'] === $event) && ($payment === '' || $item['payment'] === $payment) && ($status === '' || $item['status'] === $status)));
        return view('admin.bookings.index', ['bookings' => $bookings, 'query' => $query, 'event' => $event, 'payment' => $payment, 'status' => $status]);
    })->name('admin.bookings');

    Route::get('/admin/bookings/{booking}', function (string $booking) {
        $bookings = [
            'BK-2609028' => ['code' => 'BK-2609028', 'buyer' => 'Nadya Prameswari', 'email' => 'nadya.prameswari@mail.id', 'phone' => '+62 812 4456 3091', 'event' => 'Otaku Matsuri 2026', 'event_date' => '28 September 2026', 'tickets' => [['name' => 'Regular Pass', 'code' => 'TKT-OM26-8F2K', 'qty' => 2, 'total' => 'Rp680.000']], 'total' => 'Rp680.000', 'payment' => 'Paid', 'status' => 'Confirmed', 'reference' => 'MID-OM26-9281', 'booked_at' => '02 September 2026, 14:32 WIB', 'can_cancel' => false],
            'BK-2609027' => ['code' => 'BK-2609027', 'buyer' => 'Bagas Wicaksono', 'email' => 'bagas.wicaksono@mail.id', 'phone' => '+62 857 2210 7784', 'event' => 'Comic Frontier Mini', 'event_date' => '04 Oktober 2026', 'tickets' => [['name' => 'Early Bird', 'code' => 'TKT-CF26-2Q9M', 'qty' => 1, 'total' => 'Rp245.000']], 'total' => 'Rp245.000', 'payment' => 'Pending', 'status' => 'Pending', 'reference' => 'Menunggu pembayaran', 'booked_at' => '02 September 2026, 12:08 WIB', 'can_cancel' => true],
        ];
        abort_unless(isset($bookings[$booking]), 404);
        return view('admin.bookings.show', ['booking' => $bookings[$booking]]);
    })->name('admin.bookings.show');

    Route::post('/admin/bookings/{booking}/cancel', function (\Illuminate\Http\Request $request, string $booking) {
        abort_unless(in_array($booking, ['BK-2609027'], true), 403, 'Booking ini tidak dapat dibatalkan oleh admin event.');
        $request->validate(['reason' => ['required', 'string', 'min:10', 'max:500']]);
        logger()->notice('Admin booking cancellation requested', ['booking' => $booking, 'admin_id' => $request->user()->id, 'reason' => $request->string('reason')->toString(), 'at' => now()->toIso8601String()]);
        return redirect()->route('admin.bookings.show', $booking)->with('status', 'Permintaan cancel tercatat di audit log. Status akan diproses sesuai kebijakan pembayaran.');
    })->name('admin.bookings.cancel');




    Route::middleware('guest')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //     ->name('register');

    // Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AdminLoginController::class, 'create'])
        ->name('login');

    Route::post('login', [AdminLoginController::class, 'store']);

    Route::get('forgot-password', [AdminLoginController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [AdminLoginController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [AdminLoginController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [AdminLoginController::class, 'store'])
        ->name('password.store');

    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
});

Route::get('/admin/events/{event}', function (string $event) {
        $events = [
            'otaku-matsuri-2026' => [
                'code' => 'EV-260928', 'name' => 'Otaku Matsuri 2026', 'category' => 'Anime convention',
                'date' => '28 September 2026', 'time' => '09:00–21:00 WIB', 'venue' => 'ICE BSD City, Tangerang',
                'status' => 'Published', 'tickets' => '1.240', 'bookings' => '842',
                'description' => 'Perayaan komunitas anime dengan panggung utama, artist alley, dan area showcase kreator lokal.',
            ],
            'comic-frontier-mini' => [
                'code' => 'EV-261004', 'name' => 'Comic Frontier Mini', 'category' => 'Pop culture market',
                'date' => '04 Oktober 2026', 'time' => '10:00–18:00 WIB', 'venue' => 'Hall 3, JIExpo Kemayoran',
                'status' => 'Draft', 'tickets' => '480', 'bookings' => '176',
                'description' => 'Pasar kreator skala intim untuk komik, ilustrasi, merchandise, dan komunitas pop culture.',
            ],
        ];

        abort_unless(isset($events[$event]), 404);

        return view('dashboard.event.show', ['event' => $events[$event]]);
    })->name('admin.events.show');


    Route::get('/admin/events/{event}/edit', function (string $event) {
        $events = [
            'otaku-matsuri-2026' => ['code' => 'EV-260928', 'name' => 'Otaku Matsuri 2026', 'category' => 'Anime convention', 'date' => '2026-09-28', 'time' => '09:00', 'venue' => 'ICE BSD City, Tangerang', 'status' => 'Published', 'description' => 'Perayaan komunitas anime dengan panggung utama, artist alley, dan area showcase kreator lokal.'],
            'comic-frontier-mini' => ['code' => 'EV-261004', 'name' => 'Comic Frontier Mini', 'category' => 'Pop culture market', 'date' => '2026-10-04', 'time' => '10:00', 'venue' => 'Hall 3, JIExpo Kemayoran', 'status' => 'Draft', 'description' => 'Pasar kreator skala intim untuk komik, ilustrasi, merchandise, dan komunitas pop culture.'],
        ];
        abort_unless(isset($events[$event]), 404);
        return view('dashboard.event.edit', ['event' => $events[$event], 'slug' => $event]);
    })->name('admin.events.edit');


    Route::get('/admin/events/{event}', function (string $event) {
        $events = [
            'otaku-matsuri-2026' => [
                'code' => 'EV-260928', 'name' => 'Otaku Matsuri 2026', 'category' => 'Anime convention',
                'date' => '28 September 2026', 'time' => '09:00–21:00 WIB', 'venue' => 'ICE BSD City, Tangerang',
                'status' => 'Published', 'tickets' => '1.240', 'bookings' => '842',
                'description' => 'Perayaan komunitas anime dengan panggung utama, artist alley, dan area showcase kreator lokal.',
            ],
            'comic-frontier-mini' => [
                'code' => 'EV-261004', 'name' => 'Comic Frontier Mini', 'category' => 'Pop culture market',
                'date' => '04 Oktober 2026', 'time' => '10:00–18:00 WIB', 'venue' => 'Hall 3, JIExpo Kemayoran',
                'status' => 'Draft', 'tickets' => '480', 'bookings' => '176',
                'description' => 'Pasar kreator skala intim untuk komik, ilustrasi, merchandise, dan komunitas pop culture.',
            ],
        ];

        abort_unless(isset($events[$event]), 404);

        return view('admin.events.show', ['event' => $events[$event]]);
})->name('admin.events.show');


Route::get('/admin/vendors', [VendorController::class, 'index'])
    ->name('admin.vendors');

Route::get('/admin/vendors/{vendor}', [VendorController::class, 'show'])
    ->name('admin.vendors.show');

Route::post('/admin/vendors/{vendor}/approve', [VendorController::class, 'approve'])
    ->name('admin.vendors.approve');

Route::post('/admin/vendors/{vendor}/reject', [VendorController::class, 'reject'])
    ->name('admin.vendors.reject');


// ------ Routes Customer -------    
Route::prefix('customer')->name('customer.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [CustomerLoginController::class, 'createLogin'])->name('login');
        Route::post('/login', [CustomerLoginController::class, 'login'])->name('login.store');
        Route::get('/register', [CustomerLoginController::class, 'createRegister'])->name('register');
        Route::post('/register', [CustomerLoginController::class, 'register'])->name('register.store');
    });

    Route::middleware(['auth', 'role:customer'])->group(function () {
        Route::view('/home', 'customer.home.index')->name('home');
        Route::post('/logout', [CustomerLoginController::class, 'logout'])->name('logout');
    });
});

// Preview routes: these expose the Blade UI directly until auth/controllers are wired.
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::view('/dashboard', 'admin.dashboard.index')->name('dashboard');
//     Route::view('/events', 'admin.events.index')->name('events.index');
//     Route::redirect('/events/create', '/admin/events')->name('events.create');
//     Route::view('/events/{event}', 'admin.events.show')->name('events.show');
//     Route::view('/vendor', 'admin.vendor.index')->name('vendors.index');
//     Route::view('/customers', 'admin.customers.index')->name('customers.index');
//     Route::view('/customers/{customer}', 'admin.customers.show')->name('customers.show');
//     Route::view('/categories', 'admin.categories.index')->name('categories.index');
//     Route::view('/categories/create', 'admin.categories.create')->name('categories.create');
//     Route::view('/categories/{category}', 'admin.categories.show')->name('categories.show');
//     Route::view('/categories/{category}/edit', 'admin.categories.edit')->name('categories.edit');
//     Route::view('/bookings', 'admin.bookings.index')->name('bookings.index');
//     Route::view('/bookings/{booking}', 'admin.bookings.show')->name('bookings.show');
//     Route::view('/tickets', 'admin.tickets.index')->name('tickets.index');
//     Route::view('/tickets/{ticket}', 'admin.tickets.show')->name('tickets.show');
//     Route::view('/issued-ticket', 'admin.issued-ticket.index')->name('issued-tickets.index');
//     Route::view('/issued-ticket/{issuedTicket}', 'admin.issued-ticket.show')->name('issued-tickets.show');
// });

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Booking;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\TableController as AdminTableController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Halaman Umum (Frontend)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

// Booking
Route::get('/booking', function () {
    return view('booking');
});

Route::post('/booking', function (Request $r) {
    $r->validate([
        'nama'    => 'required',
        'tanggal' => 'required|date',
        'waktu'   => 'required',
        'jumlah'  => 'required|integer|min:1',
    ]);

    Booking::create([
        'nama'    => $r->nama,
        'tanggal' => $r->tanggal,
        'waktu'   => $r->waktu,
        'jumlah'  => $r->jumlah,
        'catatan' => $r->catatan,
    ]);

    return back()->with('success', 'Reservasi berhasil dikirim! Terima kasih.');
});

// Contact
Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact', function (Request $r) {
    $r->validate([
        'nama'  => 'required',
        'email' => 'required|email',
        'pesan' => 'required',
    ]);

    return back()->with('success', 'Pesan terkirim! Kami akan menghubungi Anda.');
});

/**
 * Halaman Menu (dinamis dari database)
 */
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

Route::get('/about', function () {
    return view('about');
});

/*
|--------------------------------------------------------------------------
| ROUTE SELF-ORDERING CUSTOMER
|--------------------------------------------------------------------------
*/

/**
 * Route default /order → mengarahkan ke meja M01
 */
Route::get('/order', function () {
    return redirect()->route('order.menu', ['kode_meja' => 'M01']);
})->name('order.default');

/**
 * Customer scan QR → /order/meja/{kode_meja}
 * OrderController menangani seluruh flow cart + checkout
 */
Route::get('/order/meja/{kode_meja}', [OrderController::class, 'showMenu'])->name('order.menu');
Route::post('/order/add', [OrderController::class, 'addToCart'])->name('order.add');
Route::get('/order/cart', [OrderController::class, 'cart'])->name('order.cart');
Route::post('/order/cart/update', [OrderController::class, 'updateCart'])->name('order.cart.update');
Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::get('/order/thankyou/{orderId}', [OrderController::class, 'thankyou'])->name('order.thankyou');

/*
|--------------------------------------------------------------------------
| PROFILE (bawaan Breeze)
|--------------------------------------------------------------------------
| Ini yang tadi hilang, yang bikin error "Route [profile.edit] not defined"
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTENTIKASI (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| DASHBOARD SETELAH LOGIN
|--------------------------------------------------------------------------
| Setelah login → /dashboard → redirect ke admin orders
*/
Route::get('/dashboard', function () {
    return redirect()->route('admin.orders.index');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ROUTE ADMIN (HANYA SETELAH LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Pesanan
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Menu
    Route::get('/menus', [AdminMenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/create', [AdminMenuController::class, 'create'])->name('menus.create');
    Route::post('/menus', [AdminMenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/{id}/edit', [AdminMenuController::class, 'edit'])->name('menus.edit');
    Route::post('/menus/{id}', [AdminMenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{id}', [AdminMenuController::class, 'destroy'])->name('menus.destroy');

    // Meja
    Route::get('/tables', [AdminTableController::class, 'index'])->name('tables.index');
    Route::get('/tables/create', [AdminTableController::class, 'create'])->name('tables.create');
    Route::post('/tables', [AdminTableController::class, 'store'])->name('tables.store');
    Route::delete('/tables/{id}', [AdminTableController::class, 'destroy'])->name('tables.destroy');
});

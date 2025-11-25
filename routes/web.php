<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Booking;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\TableController as AdminTableController;

/*
|--------------------------------------------------------------------------
| Halaman Umum (Frontend)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

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
 * Menggunakan MenuController@index
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
 * (bisa diubah sesuai kebutuhan)
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
| ROUTE ADMIN
|--------------------------------------------------------------------------
| (Nanti bisa ditambah middleware auth kalau sudah ada login)
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // Pesanan (order) - kasir/dapur
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Menu - kelola menu & upload gambar
    Route::get('/menus', [AdminMenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/create', [AdminMenuController::class, 'create'])->name('menus.create');
    Route::post('/menus', [AdminMenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/{id}/edit', [AdminMenuController::class, 'edit'])->name('menus.edit');
    Route::post('/menus/{id}', [AdminMenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{id}', [AdminMenuController::class, 'destroy'])->name('menus.destroy');

    // Tables - kelola meja & QR
    Route::get('/tables', [AdminTableController::class, 'index'])->name('tables.index');
    Route::get('/tables/create', [AdminTableController::class, 'create'])->name('tables.create');
    Route::post('/tables', [AdminTableController::class, 'store'])->name('tables.store');
    Route::delete('/tables/{id}', [AdminTableController::class, 'destroy'])->name('tables.destroy');
});

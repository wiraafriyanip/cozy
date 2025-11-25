<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\menu;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    // Customer buka halaman order via QR (kode meja)
    public function showMenu($kode_meja)
    {
        $table = Table::where('kode_meja', $kode_meja)->firstOrFail();
        $menus = menu::where('is_available', true)->get();

        // simpan table_id di session untuk keranjang
        session(['cart_table_id' => $table->id]);

        return view('order.index', compact('table', 'menus'));
    }

    // Tambah ke keranjang
    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'jumlah'  => 'required|integer|min:1',
        ]);

        $menu = menu::findOrFail($request->menu_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['jumlah'] += $request->jumlah;
        } else {
            $cart[$menu->id] = [
                'menu_id' => $menu->id,
                'nama'    => $menu->nama_menu,
                'harga'   => $menu->harga,
                'jumlah'  => $request->jumlah,
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Menu berhasil ditambahkan ke keranjang.');
    }

    // Lihat keranjang
    public function cart()
    {
        $cart = session('cart', []);
        $tableId = session('cart_table_id');
        $table = $tableId ? Table::find($tableId) : null;

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        return view('order.cart', compact('cart', 'total', 'table'));
    }

    // Update jumlah item di keranjang
    public function updateCart(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array',
        ]);

        $cart = session('cart', []);

        foreach ($request->quantities as $menuId => $qty) {
            if (isset($cart[$menuId])) {
                $qty = (int) $qty;
                if ($qty <= 0) {
                    unset($cart[$menuId]);
                } else {
                    $cart[$menuId]['jumlah'] = $qty;
                }
            }
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    // Checkout → buat order di DB
    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        $tableId = session('cart_table_id');

        if (!$tableId || empty($cart)) {
            return redirect()->route('order.cart')->with('error', 'Keranjang kosong atau meja tidak valid.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        $order = Order::create([
            'table_id'    => $tableId,
            'status'      => 'baru',
            'total_harga' => $total,
            'metode_bayar'=> null,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'menu_id'      => $item['menu_id'],
                'jumlah'       => $item['jumlah'],
                'harga_satuan' => $item['harga'],
                'subtotal'     => $item['harga'] * $item['jumlah'],
            ]);
        }

        // kosongkan keranjang
        session()->forget(['cart', 'cart_table_id']);

        return redirect()->route('order.thankyou', $order->id);
    }

    public function thankyou($orderId)
{
    $order = Order::with('table', 'items.menu')->findOrFail($orderId);
    return view('order.thankyou', compact('order'));
}
}

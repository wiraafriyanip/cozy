<?php

namespace App\Http\Controllers;

use App\Models\Menu;   // atau menu
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Lihat isi cart
    public function index()
    {
        $cart = session('cart', []);

        $total = collect($cart)->sum(function ($item) {
            return $item['harga'] * $item['qty'];
        });

        return view('cart.index', compact('cart', 'total'));
    }

    // Tambah item ke cart
    public function add(Request $request, Menu $menu)
    {
        $request->validate([
            'qty' => ['nullable', 'integer', 'min:1'],
        ]);

        $qty = $request->input('qty', 1);

        $cart = session('cart', []);

        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['qty'] += $qty;
        } else {
            $cart[$menu->id] = [
                'menu_id' => $menu->id,
                'nama'    => $menu->nama_menu,
                'harga'   => $menu->harga,
                'qty'     => $qty,
                'gambar'  => $menu->gambar,
            ];
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang.');
    }

    // Update qty / hapus item (1 form untuk dua aksi)
    public function update(Request $request)
    {
        $cart = session('cart', []);

        // Jika user menekan tombol Hapus (remove_id terisi)
        if ($request->filled('remove_id')) {
            $removeId = (int) $request->input('remove_id');
            unset($cart[$removeId]);

            session(['cart' => $cart]);

            return redirect()->route('cart.index')->with('success', 'Item dihapus dari keranjang.');
        }

        // Kalau bukan hapus, berarti update qty
        $quantities = $request->input('quantities', []);

        foreach ($quantities as $menuId => $qty) {
            $qty = (int) $qty;

            if ($qty <= 0) {
                unset($cart[$menuId]);
            } else {
                if (isset($cart[$menuId])) {
                    $cart[$menuId]['qty'] = $qty;
                }
            }
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    // Checkout: simpan ke orders + order_items
    public function checkout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('menu.index')->with('error', 'Keranjang masih kosong.');
        }

        // Hitung total
        $total = collect($cart)->sum(function ($item) {
            return $item['harga'] * $item['qty'];
        });

        // Jika kamu sudah menyimpan table_id di session (saat scan QR),
        // bisa ambil di sini. Kalau tidak, biarkan null atau sesuaikan kebutuhan.
        $tableId = session('table_id'); // optional

        DB::beginTransaction();

        try {
            $order = Order::create([
                'table_id'     => $tableId,    // boleh null kalau migrasi-nya nullable
                'status'       => 'baru',
                'total_harga'  => $total,
                'metode_bayar' => null,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'menu_id'      => $item['menu_id'],
                    'jumlah'       => $item['qty'],
                    'harga_satuan' => $item['harga'],
                    'subtotal'     => $item['harga'] * $item['qty'],
                ]);
            }

            DB::commit();

            // bersihkan cart
            session()->forget('cart');

            // arahkan ke halaman terima kasih yang sudah ada
            return redirect()->route('order.thankyou', $order->id);

        } catch (\Throwable $e) {
            DB::rollBack();

            // Untuk debug sementara bisa dd($e->getMessage());
            return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat proses checkout.');
        }
    }
}

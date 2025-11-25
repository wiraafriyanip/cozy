<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('table', 'items.menu')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status'       => 'required|in:baru,diproses,siap,selesai,batal',
            'metode_bayar' => 'nullable|string|max:50',
        ]);

        $order = Order::findOrFail($id);

        // update status
        $order->status = $validated['status'];

        // jika sudah selesai, simpan metode bayar
        if ($validated['status'] === 'selesai') {
            $order->metode_bayar = $validated['metode_bayar'] ?: $order->metode_bayar;
        }

        $order->save();

        return back()->with('success', 'Status pesanan diperbarui.');
    }
}

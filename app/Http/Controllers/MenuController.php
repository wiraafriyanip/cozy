<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\menu;

class MenuController extends Controller
{
    /**
     * Halaman daftar menu umum (/menu)
     * - Menarik data menu dari tabel menus
     * - Opsional: baca kode meja dari query string ?meja=M01
     *   untuk setting session cart_table_id (dipakai saat checkout)
     */
    public function index(Request $request)
    {
        $table = null;

        // Kalau URL seperti: /menu?meja=M01
        if ($request->filled('meja')) {
            $table = Table::where('kode_meja', $request->meja)->first();

            if ($table) {
                session(['cart_table_id' => $table->id]);
            }
        } else {
            // Kalau sebelumnya sudah pernah scan QR, ambil dari session
            $tableId = session('cart_table_id');
            $table   = $tableId ? Table::find($tableId) : null;
        }

        // Ambil semua menu yang tersedia
        $menus = menu::where('is_available', true)->get();

        return view('menu', compact('menus', 'table'));
    }
}

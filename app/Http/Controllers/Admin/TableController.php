<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        return view('admin.tables.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.tables.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_meja' => 'required|unique:tables,kode_meja',
        ]);

        Table::create([
            'kode_meja'    => $request->kode_meja,
            'qrcode_token' => Str::uuid(), // token unik untuk QR
        ]);

        return redirect()->route('admin.tables.index')->with('success','Meja berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        $table->delete();

        return back()->with('success','Meja berhasil dihapus.');
    }
}

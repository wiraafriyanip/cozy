<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required',
            'kategori'  => 'nullable',
            'harga'     => 'required|numeric|min:0',
            'deskripsi' => 'nullable',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            // simpan ke storage/app/public/menus
            $gambarPath = $request->file('gambar')->store('menus', 'public');
        }

        menu::create([
            'nama_menu'    => $request->nama_menu,
            'kategori'     => $request->kategori,
            'harga'        => $request->harga,
            'deskripsi'    => $request->deskripsi,
            'gambar'       => $gambarPath,
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()->route('admin.menus.index')->with('success','Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $menu = menu::findOrFail($id);
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_menu' => 'required',
            'kategori'  => 'nullable',
            'harga'     => 'required|numeric|min:0',
            'deskripsi' => 'nullable',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $menu = menu::findOrFail($id);

        $gambarPath = $menu->gambar;

        if ($request->hasFile('gambar')) {
            // hapus gambar lama jika ada
            if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
                Storage::disk('public')->delete($gambarPath);
            }

            $gambarPath = $request->file('gambar')->store('menus', 'public');
        }

        $menu->update([
            'nama_menu'    => $request->nama_menu,
            'kategori'     => $request->kategori,
            'harga'        => $request->harga,
            'deskripsi'    => $request->deskripsi,
            'gambar'       => $gambarPath,
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()->route('admin.menus.index')->with('success','Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $menu = menu::findOrFail($id);

        if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
            Storage::disk('public')->delete($menu->gambar);
        }

        $menu->delete();

        return back()->with('success','Menu berhasil dihapus.');
    }
}

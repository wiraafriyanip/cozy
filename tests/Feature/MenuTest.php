<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Menu;

class MenuTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function menu_page_can_be_opened()
    {
        // Buat 1 data menu di database testing
        Menu::create([
            'nama_menu'    => 'Kopi Susu',
            'kategori'     => 'Minuman',
            'harga'        => 15000,
            'deskripsi'    => 'Kopi susu hangat',
            'gambar'       => null,
            'is_available' => 1,
        ]);

        // Akses halaman /menu
        $response = $this->get(route('menu.index')); // sama dengan GET /menu

        // Pastikan halaman bisa dibuka
        $response->assertStatus(200);
        // Optional: cek teksnya muncul
        $response->assertSee('Kopi Susu');
    }
}

<?php

namespace Tests\Feature;
use App\Models\Table;
use App\Models\Menu;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;



class OrderFlowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    /** @test */
public function user_can_see_menu_in_order_page()
{
    // 1. Buat meja
    $table = Table::create([
        'kode_meja'    => 'M01',
        'qrcode_token' => 'dummy-token-m01',
        // tambahkan kolom lain yang NOT NULL di migration tables kamu, misal:
        // 'status'      => 'tersedia',
        // 'nama_meja'   => 'Meja 1',
    ]);

    // 2. Buat menu
    Menu::create([
        'nama_menu'    => 'Kopi Susu',
        'kategori'     => 'Minuman',
        'harga'        => 15000,
        'deskripsi'    => 'Kopi susu hangat',
        'gambar'       => null,
        'is_available' => 1,
    ]);

    // 3. Buka halaman order untuk meja tersebut
    $response = $this->get(route('order.menu', [
        'kode_meja' => $table->kode_meja,
    ]));

    // 4. Pastikan halaman tampil dan teks menu ada
    $response->assertStatus(200);
    $response->assertSee('Kopi Susu');
}

}

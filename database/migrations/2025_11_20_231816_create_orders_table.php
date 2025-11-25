<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_id')->constrained('tables');
            $table->string('status')->default('baru'); // baru, diproses, siap, selesai, batal
            $table->decimal('total_harga', 10, 2)->default(0);
            $table->string('metode_bayar')->nullable(); // tunai, qris, dll
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

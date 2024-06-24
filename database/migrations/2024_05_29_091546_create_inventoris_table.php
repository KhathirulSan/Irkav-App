<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventoris', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_Barang');
            $table->enum('Kategori', ['Perlengkapan Umum', 'Perlengkapan Lomba', 'Perlengkapan Lainnya']);
            $table->integer('Jumlah_Barang');
            $table->enum('Status', ['Baik', 'Rusak', 'Hilang'])->default('Baik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventoris');
    }
};

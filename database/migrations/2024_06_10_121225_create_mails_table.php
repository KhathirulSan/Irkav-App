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
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->string('Jenis_Surat');
            $table->integer('No_Surat')->unique();
            $table->date('Tanggal_Surat');
            $table->string('Perihal');
            $table->string('File');
            $table->enum('Status', ['Diterima', 'Ditolak', 'Belum Dibaca'])->default('Belum Dibaca');
            $table->string('Alasan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mails');
    }
};

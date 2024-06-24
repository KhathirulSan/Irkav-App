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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            //Logika untuk menghapus user dengan member yang terhubung secara otomatis jika pada user terhapus
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('Nama_Anggota');
            $table->string('Jenis_Kelamin');
            $table->integer('Usia');
            $table->enum('Jabatan', ['Ketua', 'Anggota', 'Sekretaris', 'Bendahara']);
            $table->enum('Status_Pekerjaan', ['Pelajar', 'Bekerja', 'Tidak Bekerja']);
            $table->enum('Status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};

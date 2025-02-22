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
        Schema::create('registrasi_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('siswa_nis'); // Pastikan tipe datanya sesuai dengan NIS di tabel siswa
            $table->foreign('siswa_nis')->references('nis')->on('siswa')->onDelete('cascade');
            $table->enum('jenis_pendaftaran', ['Siswa Baru', 'Pindahan']); // Jenis pendaftaran
            $table->date('tanggal_masuk');
            $table->string('no_ijazah')->nullable(); // No ijazah SMP
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrasi_siswa');
    }
};

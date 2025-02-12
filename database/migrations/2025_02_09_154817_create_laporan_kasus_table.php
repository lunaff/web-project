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
        Schema::create('laporan_kasus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kdsiswa');
            $table->foreign('kdsiswa')->references('id')->on('siswa')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal');
            $table->text('kasus'); // Bisa menyimpan deskripsi lebih panjang
            $table->string('bukti')->nullable(); // Path file bukti (foto/video)
            $table->string('tindak_lanjut', 100); // Bisa diisi lebih panjang
            $table->enum('status', ['penanganan_walas', 'penanganan_kesiswaan', 'selesai'])
                ->default('penanganan_kesiswaan');
            $table->boolean('dampingan_bk')->default(false); // true = Ya, false = Tidak
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->string('tahun_ajaran', 30); // Format: 2023/2024
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kasus');
    }
};

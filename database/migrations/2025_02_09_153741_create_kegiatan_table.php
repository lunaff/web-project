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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // Tanggal kegiatan
            $table->string('nama'); // Nama kegiatan
            $table->string('penyelenggara'); // Penyelenggara kegiatan
            $table->string('dokumentasi')->nullable(); // Path file foto dokumentasi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};

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
        Schema::create('kunjungan_rumah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idKasus')->constrained('laporan_kasus')->onDelete('cascade');
            $table->date('tanggal');
            $table->text('solusi')->nullable();
            $table->string('surat')->nullable();
            $table->string('dokumentasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan_rumah');
    }
};

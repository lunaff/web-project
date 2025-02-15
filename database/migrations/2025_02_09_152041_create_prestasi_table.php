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
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); 
            $table->enum('jenis', ['akademik', 'non-akademik']);
            $table->text('deskripsi')->nullable(); // Deskripsi prestasi
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade'); 
            $table->date('tanggal_dokumentasi')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};

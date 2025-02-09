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
        Schema::create('track_record', function (Blueprint $table) {
            $table->id();
            Schema::create('track_record', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('siswa_id');
                $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
                $table->timestamps();
            });

            // Tabel pivot untuk track_record dan pelanggaran (Many-to-Many)
            Schema::create('track_record_pelanggaran', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('track_record_id');
                $table->unsignedBigInteger('pelanggaran_id');
                $table->foreign('track_record_id')->references('id')->on('track_record')->onDelete('cascade');
                $table->foreign('pelanggaran_id')->references('id')->on('pelanggaran')->onDelete('cascade');
            });

            // Tabel pivot untuk track_record dan laporan_kasus (Many-to-Many)
            Schema::create('track_record_laporan_kasus', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('track_record_id');
                $table->unsignedBigInteger('laporan_kasus_id');
                $table->foreign('track_record_id')->references('id')->on('track_record')->onDelete('cascade');
                $table->foreign('laporan_kasus_id')->references('id')->on('laporan_kasus')->onDelete('cascade');
            });
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_record');
    }
};

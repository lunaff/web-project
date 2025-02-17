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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(true);
            $table->string('nis')->unique();
            $table->unsignedBigInteger('kdkelas')->nullable();
            $table->unsignedBigInteger('kdkompetensi')->nullable();
            $table->string('nama_lengkap', 50);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->string('alamat', 300);
            $table->enum('agama', ['Islam', 'Katolik', 'Protestan', 'Buddha', 'Hindu', 'Lainnya']);
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            $table->string('no_hp', 20);
            $table->string('email')->unique();
            $table->string('nisn', 50);
            $table->enum('jk', ['L', 'P']);
            $table->string('tahun_masuk', 50);
            $table->string('nama_ayah', 50);
            $table->string('nama_ibu', 50);
            $table->string('alamat_ortu', 300);
            $table->string('no_ortu', 20);
            $table->string('nama_sekolah_asal', 100);
            $table->string('alamat_sekolah', 300);
            $table->string('tahun_lulus', 50);
            $table->string('riwayat_penyakit', 50)->nullable();
            $table->string('alergi', 50)->nullable();
            $table->string('prestasi_akademik', 300)->nullable();
            $table->string('prestasi_non_akademik', 300)->nullable();
            $table->string('ekstrakurikuler', 50)->nullable();
            $table->string('biografi', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};

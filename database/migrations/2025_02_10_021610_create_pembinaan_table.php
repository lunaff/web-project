<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pembinaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kasus')->constrained('laporan_kasus')->onDelete('cascade');
            $table->foreignId('id_guru')->constrained('guru')->onDelete('cascade');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->integer('durasi')->nullable();
            $table->enum('status', ['Kasus Baru', 'Dalam Pembinaan', 'Kasus Selesai'])->default('kasus baru');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembinaan');
    }
};


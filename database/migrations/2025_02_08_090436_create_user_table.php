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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('level', [
                'admin', 'osis',
                'kesiswaan', 'bk', 'operator'
            ])->default('kesiswaan');
            $table->string('guru_nip')->nullable();
            $table->foreign('guru_nip')->references('nip')->on('guru')->onDelete('cascade');
            $table->string('siswa_nis')->nullable();
            $table->foreign('siswa_nis')->references('nis')->on('siswa')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
